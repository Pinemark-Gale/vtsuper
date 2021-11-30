<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Resource;
use App\Models\ResourceType;
use App\Models\ResourceTag;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.resource.admin.resources', [
            'resources' => Resource::with(['type', 'source', 'tags'])
                ->orderby('name')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.resource.admin.resource-create', [
            'types' => ResourceType::all(),
            'tags' => ResourceTag::all(),
            'sources' => Source::all()
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
            'resource_type_id' => ['required', 'integer', 'exists:App\Models\ResourceType,id'],
            'source_id' => ['required', 'integer', 'exists:App\Models\Source,id'],
            'name' => ['required', 'unique:App\Models\Resource', 'string'],
            'link' => ['required', 'string'],
            'description' => ['required', 'string'],
            'tags.*' => ['array:id,tag'],
            'tags.*.id' => ['exists:App\Models\ResourceTag,id']
        ]);
        
        $resource = Resource::create([
            'resource_type_id' => $request->resource_type_id,
            'source_id' => $request->source_id,
            'name' => $request->name,
            'link' => $request->link,
            'description' => $request->description,
        ]);

         /* Sync tags to many-to-many table. */
         $resource->tags()->sync($request->array, 'id');

        return redirect(route('admin-resources'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        return view('models.resource.admin.resource', [
            'resource' => $resource
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        return view('models.resource.admin.resource-edit', [
            'resource' => $resource,
            'types' => ResourceType::all(),
            'tags' => ResourceTag::all(),
            'sources' => Source::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        /* For tag id unique validation documentation go to the resource below:
         * https://laravel.com/docs/5.1/validation#rule-unique
         * Original Rule for tags.*.id: 'unique:resource_resource_tag,resource_tag_id,NULL,id,resource_id,'.$resource->id
         * */
        
        $validatedData = $request->validate([
            'resource_type_id' => ['required', 'integer', 'exists:App\Models\ResourceType,id'],
            'source_id' => ['required', 'integer', 'exists:App\Models\Source,id'],
            'name' => ['required', Rule::unique('resources', 'name')->ignore($resource->id), 'string'],
            'link' => ['required', 'string'],
            'description' => ['required', 'string'],
            'array' => ['array'],
            'array.*' => ['integer', 'exists:App\Models\ResourceTag,id'],
        ]);

        /* Sync tags to many-to-many table. */
        $resource->tags()->sync($request->array, 'id');

        $resource->resource_type_id = $request->resource_type_id;
        $resource->source_id = $request->source_id;
        $resource->name = $request->name;
        $resource->link = $request->link;
        $resource->description = $request->description;

        $resource->save();

        return redirect(route('admin-resources'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        $resource->tags()->detach();

        $resource->delete();

        return redirect(route('admin-resources'));
    }
}