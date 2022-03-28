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
use Illuminate\Validation\Rule;

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
            'activities' => ActivityDetail::with(['author', 'resource', 'questions'])
                ->orderby('name')->get()
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
            'slug' => $request->slug,
            'minutes_to_complete' => $request->minutes_to_complete,
            'resource_id' => $request->resource_id,
            'user_id' => Auth::user()->id,
            'instructions' => $request->instructions
        ]);
        
        foreach ($request->module as $module) {
            $activityTypes = ActivityAnswerType::all()->mapWithKeys(function ($item, $key) {
                return [$item['type'] => $item['id']];
            });
            
            $activityQuestion = ActivityQuestion::create([
                'activity_detail_id' => $activityDetail->id,
                'question' => $module['question']
            ]);

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
        return view('models.activity.admin.activity-edit', [
            'activity' => $activityDetail,
            'resources' => Resource::all(),
        ]);
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
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'minutes_to_complete' => ['required', 'integer'],
            'resource_id' => ['required', 'integer', 'exists:App\Models\Resource,id'],
            'slug' => ['required', Rule::unique('activity_details', 'slug')->ignore($activityDetail->id), 'string'],
            'instructions' => ['required', 'string'],
            'module' => ['required', 'array'],
            'module.*.type' => ['required', 'string', 'exists:App\Models\ActivityAnswerType,type'],
            'module.*.question' => ['required', 'string'],
            'module.*.answer' => ['required', 'array'],
            'module.*.answer.*' => ['required', 'string'],
            'module.*.placement' => ['array'],
            'module.*.placement.*' =>  ['string']
        ]);
        
        $activityDetail->name = $request->name;
        $activityDetail->slug = $request->slug;
        $activityDetail->minutes_to_complete = $request->minutes_to_complete;
        $activityDetail->resource_id = $request->resource_id;
        $activityDetail->user_id = Auth::user()->id;
        $activityDetail->instructions = $request->instructions;

        $activityDetail->save();

        $questions = $activityDetail->questions;

        foreach ($questions as $question) {
            $question->delete();
        }
        
        foreach ($request->module as $module) {
            $activityTypes = ActivityAnswerType::all()->mapWithKeys(function ($item, $key) {
                return [$item['type'] => $item['id']];
            });
            
            $activityQuestion = ActivityQuestion::create([
                'activity_detail_id' => $activityDetail->id,
                'question' => $module['question']
            ]);

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

        return redirect(route('admin-activities'));
    }

    /**
     * Remove the specified activity from storage.
     *
     * @param  \App\Models\ActivityDetail  $activityDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy( ActivityDetail $activityDetail)
    {
        $activityDetail->delete();

        return redirect(route('admin-activities'));
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
