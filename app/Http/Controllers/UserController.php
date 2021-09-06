<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Privilege;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->privilege->title == 'Admin') {
            return view('models.users', [
                'users' => User::with(['school', 'privilege'])->orderby('name')->get()
            ]);
        } else {
            $message = "User " . Auth::user()->name . " attempted to view all users.";
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
        // handled by Laravel Breeze register
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // handled by Laravel Breeze register
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (Auth::user()->privilege->title == 'Admin') {
            return view('models.user', [
                'user' => $user
            ]);
        } else {
            $message = "User " . Auth::user()->name . " attempted to view user profile " . $user->name . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->privilege->title == 'Admin') {
            return view('models.user-edit', [
                'user' => $user,
                'schools' => School::all(),
                'privileges' => Privilege::all()
            ]);
        } else {
            $message = "User " . Auth::user()->name . " attempted to edit user profile " . $user->name . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        /* Link to validation rules: 
         * https://laravel.com/docs/8.x/validation#a-note-on-optional-fields */
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['string', 'nullable'],
            'school_id' => ['required', 'numeric', 'integer'],
            'privilege_id' => ['required', 'numeric', 'integer']
        ]);

        if (Auth::user()->privilege->title == 'Admin') {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->school_id = $request->school_id;
            $user->privilege_id = $request->privilege_id;
    
            $user->save();
        } else {
            $message = "User " . Auth::user()->name . " attempted to update user profile " . $user->name . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }

        return redirect(route('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->privilege->title == 'Admin') {
            $user->delete();
        } else {
            $message = "User " . Auth::user()->name . " attempted to delete user profile " . $user->name . ".";
            Log::warning($message);
            return redirect(route('unauthorized-access'));
        }

        return redirect(route('users'));
    }
}
