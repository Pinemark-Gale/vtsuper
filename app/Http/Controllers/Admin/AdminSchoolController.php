<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AdminSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.school.admin.schools', [
            'schools' => School::all()
        ]);       
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.school.admin.school-create');    
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
            'name' => ['required', 'string', 'unique:App\Models\School,name'],
            'district' => ['required', 'string']
        ]);

        School::create([
            'name' => $request->name,
            'district' => $request->district
        ]);

        return redirect(route('admin-schools'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view('models.school.admin.school', [
            'school' => $school
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('models.school.admin.school-edit', [
            'school' => $school,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'unique:App\Models\School,name'],
            'district' => ['required', 'string']
        ]);

        $school->name = $request->name;
        $school->district = $request->district;
        $school->save();

        return redirect(route('admin-schools'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        // Check if user is trying to delete default school.
        if ($school->name == 'None') {
            return redirect()
                ->back()
                ->with(
                    config('session.system_message'), 
                    'None school option cannot be deleted!'
                );
        }

        // Find or create None school.
        $uncatigorized = School::where('name', '=', 'None')->first();
        if (is_null($uncatigorized)) {
            $uncatigorized = School::create([
                'name' => 'None'
            ]);
            
        }
        
        // Gather foreign keys and detach.
        $toDetach = User::where('school_id', '=', $school->id)
            ->update(['school_id' => $uncatigorized->id]);
        
        $school->delete();

        return redirect(route('admin-schools'));
    }
}
