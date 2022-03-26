<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ResourceTag;
use Illuminate\Http\Request;

class AdminResourceTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.resource_tag.admin.resource-tags', [
            'resourceTags' => ResourceTag::with(['resources'])->get()
        ]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.resource_tag.admin.resource-tag-create');    
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
            'tag' => ['required', 'string', 'unique:App\Models\ResourceTag,tag']
        ]);

        ResourceTag::create([
            'tag' => $request->tag
        ]);

        return redirect(route('admin-resource-tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResourceTag  $resourceTag
     * @return \Illuminate\Http\Response
     */
    public function show(ResourceTag $resourceTag)
    {
        return view('models.resource_tag.admin.resource-tag', [
            'resourceTag' => $resourceTag
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResourceTag  $resourceTag
     * @return \Illuminate\Http\Response
     */
    public function edit(ResourceTag $resourceTag)
    {
        return view('models.resource_tag.admin.resource-tag-edit', [
            'resourceTag' => $resourceTag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResourceTag  $resourceTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResourceTag $resourceTag)
    {
        $validatedData = $request->validate([
            'tag' => ['required', 'string', 'unique:App\Models\ResourceTag,tag']
        ]);

        $resourceTag->tag = $request->tag;
        $resourceTag->save();

        return redirect(route('admin-resource-tags'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResourceTag  $resourceTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResourceTag $resourceTag)
    {
        $resourceTag->resources()->detach();

        $resourceTag->delete();

        return redirect(route('admin-resource-tags'));
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

        return view('models.resource_tag.admin.resource-tags', [
            'resourceTags' => ResourceTag::where('tag', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('created_at', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('updated_at', 'LIKE', '%'.$request->search_term.'%')
            ->orderby('tag')->get()
        ]);
    }
}
