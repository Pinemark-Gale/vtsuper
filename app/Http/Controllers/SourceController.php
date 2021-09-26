<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.source.sources', [
            'sources' => Source::all()
        ]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.source.source-create');    
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
            'source' => ['required', 'string',  'unique:App\Models\Source,source']
        ]);

        Source::create([
            'source' => $request->source
        ]);

        return redirect(route('sources'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function show(Source $source)
    {
        return view('models.source.source', [
            'source' => $source
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        return view('models.source.source-edit', [
            'source' => $source,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Source $source)
    {
        $validatedData = $request->validate([
            'source' => ['required', 'string',  'unique:App\Models\Source,source'],
        ]);

        $source->source = $request->source;
        $source->save();

        return redirect(route('sources'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Source $source)
    {
        $source->delete();

        return redirect(route('sources'));
    }
}
