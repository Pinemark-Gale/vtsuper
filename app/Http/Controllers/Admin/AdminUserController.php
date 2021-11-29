<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Privilege;
use App\Models\School;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.user.admin.users', [
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
        return view('models.user.admin.user-create', [
            'schools' => School::all(),
            'privileges' => Privilege::all()
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
            'email' => ['required', 'email', 'string', 'max:255', 'unique:\App\Models\User'],
            'password' => ['string', 'nullable', 'confirmed', Rules\Password::defaults()],
            'school_id' => ['required', 'numeric', 'integer', 'exists:App\Models\School,id'],
            'privilege_id' => ['required', 'numeric', 'integer', 'exists:App\Models\Privilege,id']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_id' => $request->school_id,
            'privilege_id' => $request->privilege_id
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('models.user.admin.user', [
            'user' => $user
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
        return view('models.user.admin.user-edit', [
            'user' => $user,
            'schools' => School::all(),
            'privileges' => Privilege::all()
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
        /* Link to validation rules: 
         * https://laravel.com/docs/8.x/validation#a-note-on-optional-fields */
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['string', 'nullable', 'confirmed', Rules\Password::defaults()],
            'school_id' => ['required', 'numeric', 'integer', 'exists:App\Models\School,id'],
            'privilege_id' => ['required', 'numeric', 'integer', 'exists:App\Models\Privilege,id']
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->school_id = $request->school_id;
        $user->privilege_id = $request->privilege_id;

        $user->save();

        return redirect(route('admin-users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('admin-users'));
    }
}
