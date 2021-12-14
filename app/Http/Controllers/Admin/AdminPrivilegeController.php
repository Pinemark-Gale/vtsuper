<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PrivilegeController;
use App\Models\Privilege;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AdminPrivilegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.privilege.admin.privileges', [
            'privileges' => Privilege::all()
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.privilege.admin.privilege-create');    
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
            'title' => ['required', 'string',  'unique:App\Models\Privilege,title']
        ]);

        Privilege::create([
            'title' => $request->title
        ]);

        return redirect(route('admin-privileges'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function show(Privilege $privilege)
    {
        return view('models.privilege.admin.privilege', [
            'privilege' => $privilege
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function edit(Privilege $privilege)
    {
        return view('models.privilege.admin.privilege-edit', [
            'privilege' => $privilege,
        ]);
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
            'title' => ['required', 'string',  'unique:App\Models\Privilege,title'],
        ]);

        $privilege->title = $request->title;
        $privilege->save();

        return redirect(route('admin-privileges'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function destroy(Privilege $privilege)
    {
        // Check if user is trying to delete default privilege.
        if ($privilege->title == 'Uncatigorized') {
            return redirect()
                ->back()
                ->with(
                    config('session.system_message'), 
                    'Uncatigorized privilege cannot be deleted!'
                );
        }

        // Find or create an uncatigorized privilege title.
        $uncatigorized = Privilege::where('title', '=', 'Uncatigorized')->first();
        if (is_null($uncatigorized)) {
            $uncatigorized = Privilege::create([
                'title' => 'Uncatigorized'
            ]);
            
        }
        
        // Gather foreign keys and detach.
        $toDetach = User::where('privilege_id', '=', $privilege->id)
            ->update(['privilege_id' => $uncatigorized->id]);

        // Delete specified privilege.
        $privilege->delete();

        return redirect(route('admin-privileges'));
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

        return view('models.privilege.admin.privileges', [
            'privileges' => Privilege::where('title', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('created_at', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('updated_at', 'LIKE', '%'.$request->search_term.'%')
            ->orderby('title')->get()
        ]);
    }

}
