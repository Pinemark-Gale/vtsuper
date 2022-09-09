<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Privilege;
use App\Models\School;
use App\Models\Pronoun;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.user.users', [
            'users' => User::with(['school', 'privilege'])
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
        return view('models.user.user-create', [
            'schools' => School::all(),
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'max:50', 'unique:\App\Models\User'],
            'password' => ['string', 'nullable', 'confirmed', Rules\Password::defaults()],
            'school_id' => ['required', 'numeric', 'integer', 'exists:App\Models\School,id'],
            'pronouns' => ['string', 'max:100', 'nullable']
        ]);

        /* Set pronoun id to default or create/fetch new one if specified. */
        $pronoun_id = 1;
        if (isset($request->pronouns)) {
            $pronoun_id = Pronoun::firstOrCreate([
                'pronouns' => $request->pronouns
            ]);
            $pronoun_id = $pronoun_id->id;
        }         

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_id' => $request->school_id,
            'privilege_id' => config('privileges.privilege_map')['UNCATIGORIZED'],
            'pronoun_id' => $pronoun_id
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('models.user.user', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('models.user.user-edit', [
            'user' => auth()->user(),
            'schools' => School::all(),
        ]);
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
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'max:50', Rule::unique('users', 'email')->ignore($user->id)],
            'school_id' => ['required', 'numeric', 'integer', 'exists:App\Models\School,id'],
            'pronouns' => ['string', 'max:100', 'nullable']
        ]);

        /* Set pronoun id to default or create/fetch new one if specified. */
        $pronoun_id = 1;
        if (isset($request->pronouns)) {
            $pronoun_id = Pronoun::firstOrCreate([
                'pronouns' => $request->pronouns
            ]);
            $pronoun_id = $pronoun_id->id;
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->school_id = $request->school_id;
        $user->pronoun_id = $pronoun_id;

        $user->save();

        return redirect(route('dashboard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editPassword(User $user)
    {
        return view('models.user.user-password', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'password' => ['string', 'nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect(route('user-edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

    }
}
