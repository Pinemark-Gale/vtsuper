<?php

namespace App\Http\Controllers;

use App\Models\ActivityDetail;
use App\Models\SubmissionAnswerFITB;
use App\Models\SubmissionAnswerMC;
use App\Models\SubmissionAnswerSA;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.submission.submissions', [
            'activities' => ActivityDetail::whereHas('submissions', function (Builder $query) {
                    $query->where('user_id', '=', auth()->user()->id);
                 })->with(['author', 'resource', 'questions'])
                ->orderby('name')->get()
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ActivityDetail $activityDetail)
    {
        return view('models.submission.submission-create', [
            'activityDetail' => $activityDetail
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'activity_detail_id' => ['required', 'int', 'exists:App\Models\ActivityDetail,id'],
            'module' => ['required', 'array'],
            'module.*.type' => ['required', 'string', 'exists:App\Models\ActivityAnswerType,type'],
            'module.*.question' => ['required', 'string'],
            'module.*.answer' => ['required', 'array'],
            'module.*.answer.*' => ['required', 'string'],
            'module.*.placement' => ['array'],
            'module.*.placement.*' =>  ['string', 'max:3'],
            'module.*.correct' => ['array'],
            'module.*.correct.*' => ['boolean'],
            'module.*.selected' => ['string', 'max:3']
        ]);
        
        foreach ($request->module as $module) {
            $submission = ActivityDetail::create([
                'activity_detail_id' => $request->activity_detail_id,
                'user_id' => Auth::user()->id,
                'question' => $module->question,
                'type' => $module->type
            ]);
            
            switch($module['type']) {
                case "Fill in the Blank":
                    $submissionFITB = SubmissionAnswerFITB::create([
                        'submission_id' => $submission->id,
                        'response' => $module['answer'][0]
                    ]);
                    break;
                case "Multiple Choice":
                    foreach ($module['answer'] as $index => $answer) {
                        if ($module->selected == $module['placement'][$index]) {
                            $selected = 1;
                        } else {
                            $selected = 0;
                        }
                        $submissionMC = SubmissionAnswerMC::create([
                            'submission_id' => $submission->id,
                            'placement' => $module['placement'][$index],
                            'response' => $module['answer'][$index],
                            'correct' => $module['correct'][$index],
                            'selected' => $selected
                        ]);
                    };
                    break;
                case "Short Answer":
                    $activityAnswerSA = SubmissionAnswerSA::create([
                        'submission_id' => $submission->id,
                        'response' => $module['answer'][0]
                    ]);
                    break;
                default:
                    return redirect()
                    ->back()
                    ->with(
                        config('session.system_message'), 
                        'Please contact the system administrator and give the following message: Module type ' . $module['type'] . ' cannot be found and got past system validation.'
                    );
            }
        };

        return redirect(route('submission'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityDetail  $activityDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityDetail $activityDetail)
    {
        return view('models.activity.activity', [
            'activityDetail' => $activityDetail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityDetail  $activityDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityDetail $activityDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActivityDetail  $activityDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivityDetail $activityDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityDetail  $activityDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityDetail $activityDetail)
    {
        //
    }

    /**
     * Search function that returns same index view
     * with select where statement.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'search_term' => ['required', 'string'],
        ]);

        return view('models.activity.activities', [
            'activities' => ActivityDetail::where('name', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('minutes_to_complete', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('created_at', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('updated_at', 'LIKE', '%'.$request->search_term.'%')
            ->orderby('name')->get()
        ]);
    }
}
