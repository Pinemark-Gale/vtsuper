<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ActivityDetail;
use App\Models\Resource;
use App\Models\ActivityQuestion;
use App\Models\ActivityAnswer;
use App\Models\ActivityAnswerType;
use App\Models\ActivityAnswerFITB;
use App\Models\ActivityAnswerMC;
use App\Models\ActivityAnswerSA;
use Illuminate\Support\Facades\Auth;



class AdminActivityController extends Controller
{
    /**
     * Display a listing of the activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.activity.admin.activities', [
            'activities' => ActivityDetail::all()
        ]);
    }

    /**
     * Show the form for creating a new activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.activity.admin.activity-create', [
            'resources' => Resource::all(),
        ]);
    }

    /**
     * Store a newly created activity in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'minutes_to_complete' => ['required', 'integer'],
            'resource_id' => ['required', 'integer', 'exists:App\Models\Resource,id'],
            'slug' => ['required', 'unique:App\Models\ActivityDetail', 'string'],
            'instructions' => ['required', 'string'],
            'module' => ['required', 'array'],
            'module.*.type' => ['required', 'string', 'exists:App\Models\ActivityAnswerType,type'],
            'module.*.question' => ['required', 'string'],
            'module.*.answer' => ['required', 'array'],
            'module.*.answer.*' => ['required', 'string'],
            'module.*.placement' => ['array'],
            'module.*.placement.*' =>  ['string']
        ]);
        
        $activityDetail = ActivityDetail::create([
            'name' => $request->name,
            'minutes_to_complete' => $request->minutes_to_complete,
            'resource_id' => $request->resource_id,
            'user_id' => Auth::user()->id,
            'instructions' => $request->instructions
        ]);

        $questionsToSync = array();
        
        foreach ($request->module as $module) {
            $activityTypes = ActivityAnswerType::all()->mapWithKeys(function ($item, $key) {
                return [$item['type'] => $item['id']];
            });
            
            $activityQuestion = ActivityQuestion::firstOrCreate([
                'question' => $module['question']
            ]);

            array_push($questionsToSync, $activityQuestion->id);

            $activityAnswer = ActivityAnswer::create([
                'activity_question_id' => $activityQuestion->id,
                'activity_answer_type_id' => $activityTypes[$module['type']]
            ]);
            
            switch($module['type']) {
                case "fitb":
                    $activityAnswerFITB = ActivityAnswerFITB::create([
                        'activity_answer_id' => $activityAnswer->id,
                        'response' => $module['answer'][0]
                    ]);
                    break;
                case "mc":
                    foreach ($module['answer'] as $index => $answer) {
                        $activityAnswerMC = ActivityAnswerMC::create([
                            'activity_answer_id' => $activityAnswer->id,
                            'placement' => $module['placement'][$index],
                            'response' => $answer,
                            'correct' => 0
                        ]);
                    };
                    break;
                case "sa":
                    $activityAnswerSA = ActivityAnswerSA::create([
                        'activity_answer_id' => $activityAnswer->id,
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

        // dd($questionsToSync);
        $activityDetail->questions()->sync($questionsToSync, 'id');

        return redirect(route('admin-activities'));
    }

    /**
     * Display the specified activity.
     *
     * @param  \App\Models\ActivityDetail  $activityDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityDetail $activityDetail)
    {
        return view('models.activity.admin.activity', [
            'activityDetail' => $activityDetail
        ]);
    }

    /**
     * Show the form for editing the specified activity.
     *
     * @param  \App\Models\ActivityDetail  $activityDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityDetail $activityDetail)
    {
        //
    }

    /**
     * Update the specified activity in storage.
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
     * Remove the specified activity from storage.
     *
     * @param  \App\Models\ActivityDetail  $activityDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy( ActivityDetail $activityDetail)
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

        return view('models.activity.admin.activities', [
            'activities' => ActivityDetail::where('name', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('minutes_to_complete', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('created_at', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('updated_at', 'LIKE', '%'.$request->search_term.'%')
            ->orderby('name')->get()
        ]);
    }


}
