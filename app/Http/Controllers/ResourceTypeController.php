<?php

namespace App\Http\Controllers;

use App\Models\ResourceType;
use Illuminate\Http\Request;

class ResourceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.resource_type.resource-types', [
            'resourceTypes' => ResourceType::all()
        ]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.resource_type.resource-type-create');    
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
            'type' => ['required', 'string', 'unique:App\Models\ResourceType,type']
        ]);

        ResourceType::create([
            'type' => $request->type
        ]);

        return redirect(route('resource-types'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResourceType  $resourceType
     * @return \Illuminate\Http\Response
     */
    public function show(ResourceType $resourceType)
    {
        return view('models.resource_type.resource-type', [
            'resourceType' => $resourceType
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResourceType  $resourceType
     * @return \Illuminate\Http\Response
     */
    public function edit(ResourceType $resourceType)
    {
        return view('models.resource_type.resource-type-edit', [
            'resourceType' => $resourceType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResourceType  $resourceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResourceType $resourceType)
    {
        $validatedData = $request->validate([
            'type' => ['required', 'string', 'unique:App\Models\ResourceType,type']
        ]);

        $resourceType->type = $request->type;
        $resourceType->save();

        return redirect(route('resource-types'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResourceType  $resourceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResourceType $resourceType)
    {
        $resourceType->delete();

        return redirect(route('resource-types'));
    }
}
