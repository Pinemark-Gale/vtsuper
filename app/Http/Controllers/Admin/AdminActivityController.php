<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ActivityDetails;

use App\Models\ActivityDetail;
use App\Models\Resource;

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
            'name' => ['required', 'string', 'unique:App\Models\ActivityDetail,id'],
            'minutes_to_complete' => ['required', 'integer'],
            'resource_id' => ['required', 'integer', 'exists:App\Models\Resource,id'],
            'instructions' => ['required', 'string'],
            'module' => ['required', 'array'],
            'module.*.type' => ['required', 'string', 'exists:App\Models\ActivityAnswerType,type'],
            'module.*.question' => ['required', 'string'],
            'module.*.answer' => ['required', 'array'],
            'module.*.answer.*' => ['required', 'string'],
            'module.*.placement' => ['array'],
            'module.*.placement.*' =>  ['string']
        ]);

        dd($request);
    }

    /**
     * Display the specified activity.
     *
     * @param  \App\Models\ActivityDetail  $activityDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityDetail $activityDetail)
    {
        //
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

        return view('models.page.admin.pages', [
            'pages' => ActivityDetail::where('name', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('minutes_to_complete', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('created_at', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('updated_at', 'LIKE', '%'.$request->search_term.'%')
        ]);
    }


}
