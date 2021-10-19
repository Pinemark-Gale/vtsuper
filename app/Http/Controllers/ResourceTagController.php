<?php

namespace App\Http\Controllers;

use App\Models\ResourceTag;
use Illuminate\Http\Request;

class ResourceTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.resource_tag.resource-tags', [
            'resourceTags' => ResourceTag::all()
        ]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.resource_tag.resource-tag-create');    
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

        return redirect(route('resource-tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResourceTag  $resourceTag
     * @return \Illuminate\Http\Response
     */
    public function show(ResourceTag $resourceTag)
    {
        return view('models.resource_tag.resource-tag', [
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
        return view('models.resource_tag.resource-tag-edit', [
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

        return redirect(route('resource-tags'));
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

        return redirect(route('resource-tags'));
    }
}
