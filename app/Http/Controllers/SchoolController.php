<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->privilege->title == 'Admin') {
            return view('models.schools', [
                'schools' => School::all()
            ]);       
        } else {
            $message = "User " . Auth::user()->name . " attempted to view all schools.";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->privilege->title == 'Admin') {
            return view('models.school-create');    
        } else {
            $message = "User " . Auth::user()->name . " attempted to create a school.";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }
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

        if (Auth::user()->privilege->title == 'Admin') {
            School::create([
                'name' => $request->name,
                'district' => $request->district
            ]);
        } else {
            $message = "User " . Auth::user()->name . " attempted to store school " . $request->name . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }

        return redirect(route('schools'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        if (Auth::user()->privilege->title == 'Admin') {
            return view('models.school', [
                'school' => $school
            ]);
        } else {
            $message = "User " . Auth::user()->name . " attempted to view school " . $school->name . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        if (Auth::user()->privilege->title == 'Admin') {
            return view('models.school-edit', [
                'school' => $school,
            ]);
        } else {
            $message = "User " . Auth::user()->name . " attempted to edit school " . $school->name . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }
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

        if (Auth::user()->privilege->title == 'Admin') {
            $school->name = $request->name;
            $school->district = $request->district;
            $school->save();
        } else {
            $message = "User " . Auth::user()->name . " attempted to update school " . $school->name . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }

        return redirect(route('schools'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        if (Auth::user()->privilege->title == 'Admin') {
            $school->delete();
        } else {
            $message = "User " . Auth::user()->name . " attempted to delete school " . $school->name . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }

        return redirect(route('schools'));
    }
}
