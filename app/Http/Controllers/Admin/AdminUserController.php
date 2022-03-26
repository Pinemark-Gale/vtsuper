<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Privilege;
use App\Models\School;
use App\Models\Page;
use App\Models\Pronoun;
use App\Models\ActivityDetail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
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
            'users' => User::with(['school', 'privilege', 'pronoun'])
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
            'privilege_id' => ['required', 'numeric', 'integer', 'exists:App\Models\Privilege,id'],
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
            'privilege_id' => $request->privilege_id,
            'pronoun_id' => $pronoun_id
        ]);

        return redirect(route('admin-users'));
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
            'privilege_id' => ['required', 'numeric', 'integer', 'exists:App\Models\Privilege,id'],
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
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->school_id = $request->school_id;
        $user->privilege_id = $request->privilege_id;
        $user->pronoun_id = $pronoun_id;

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
        // Check if user is trying to delete admin user.
        if ($user->name == 'admin') {
            return redirect()
                ->back()
                ->with(
                    config('session.system_message'), 
                    'admin user cannot be deleted!'
                );
        }

        // Find or create admin user.
        $uncatigorized = User::where('name', '=', 'admin')->first();
        if (is_null($uncatigorized)) {
            $uncatigorized = User::create([
                'name' => 'admin'
            ]);
            
        }
        
        // Gather foreign keys and detach from pages.
        $pagesToDetach = Page::where('user_id', '=', $user->id)
            ->update(['user_id' => $uncatigorized->id]);
        
        $activityDetailToDetach = ActivityDetail::where('user_id', '=', $user->id)
            ->update(['user_id' => $uncatigorized->id]);

        $user->delete();

        return redirect(route('admin-users'));
    }

    /**
     * Search function that returns same index view
     * with select where statement.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'search_term' => ['required', 'string'],
        ]);

        return view('models.user.admin.users', [
            'users' => User::whereHas('privilege', function (Builder $query) use($request) {
                $query->where('title', 'LIKE', '%'.$request->search_term.'%');
            })->orWhere('name', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('email', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('created_at', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('updated_at', 'LIKE', '%'.$request->search_term.'%')
            ->with(['school', 'privilege'])
            ->orderby('name')->get()
        ]);
    }

}
