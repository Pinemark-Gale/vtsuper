<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Source;
use App\Models\Resource;
use Illuminate\Http\Request;

class AdminSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.source.admin.sources', [
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
        return view('models.source.admin.source-create');    
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

        return redirect(route('admin-sources'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function show(Source $source)
    {
        return view('models.source.admin.source', [
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
        return view('models.source.admin.source-edit', [
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

        return redirect(route('admin-sources'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Source $source)
    {
        // Check if user is trying to delete default source.
        if ($source->source == 'Unknown') {
            return redirect()
                ->back()
                ->with(
                    config('session.system_message'), 
                    'Unknown source option cannot be deleted!'
                );
        }

        // Find or create Unknown source.
        $uncatigorized = Source::where('source', '=', 'Unknown')->first();
        if (is_null($uncatigorized)) {
            $uncatigorized = Source::create([
                'source' => 'Unknown'
            ]);
            
        }
        
        // Gather foreign keys and detach.
        $toDetach = Resource::where('source_id', '=', $source->id)
            ->update(['source_id' => $uncatigorized->id]);

        $source->delete();

        return redirect(route('admin-sources'));
    }
}
