<?php

namespace App\Http\Controllers;

use App\Models\Privilege;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PrivilegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->privilege->title == 'Admin') {
            return view('models.privileges', [
                'privileges' => Privilege::all()
            ]);    
        } else {
            $message = "User " . Auth::user()->name . " attempted to view all privileges.";
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
            return view('models.privilege-create');    
        } else {
            $message = "User " . Auth::user()->name . " attempted to create a privilege.";
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
            'title' => ['required', 'string']
        ]);

        if (Auth::user()->privilege->title == 'Admin') {
            Privilege::create([
                'title' => $request->title
            ]);
        } else {
            $message = "User " . Auth::user()->name . " attempted to store privilege " . $request->title . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }

        return redirect(route('privileges'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function show(Privilege $privilege)
    {
        if (Auth::user()->privilege->title == 'Admin') {
            return view('models.privilege', [
                'privilege' => $privilege
            ]);
        } else {
            $message = "User " . Auth::user()->name . " attempted to view privilege " . $privilege->title . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function edit(Privilege $privilege)
    {
        if (Auth::user()->privilege->title == 'Admin') {
            return view('models.privilege-edit', [
                'privilege' => $privilege,
            ]);
        } else {
            $message = "User " . Auth::user()->name . " attempted to edit privilege " . $privilege->title . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Privilege $privilege)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string'],
        ]);

        if (Auth::user()->privilege->title == 'Admin') {
            $privilege->title = $request->title;
            $privilege->save();
        } else {
            $message = "User " . Auth::user()->name . " attempted to update privilege " . $privilege->title . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }

        return redirect(route('privileges'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function destroy(Privilege $privilege)
    {
        if (Auth::user()->privilege->title == 'Admin') {
            $privilege->delete();
        } else {
            $message = "User " . Auth::user()->name . " attempted to delete privilege " . $privilege->title . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }

        return redirect(route('privileges'));
    }
}
