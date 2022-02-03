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
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.activity.admin.activity-create', [
            'resources' => Resource::all()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PageSection  $pageSection
     * @return \Illuminate\Http\Response
     */
    public function show(PageSection $pageSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PageSection  $pageSection
     * @return \Illuminate\Http\Response
     */
    public function edit(PageSection $pageSection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PageSection  $pageSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PageSection $pageSection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PageSection  $pageSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(PageSection $pageSection)
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
