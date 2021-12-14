<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Page;
use App\Models\PageStatus;
use App\Models\PageSection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.page.admin.pages', [
            'pages' => Page::with(['status', 'sections'])
                ->orderby('title')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.page.admin.page-create', [
            'statuses' => PageStatus::all(),
            'sections' => PageSection::all()
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
            'page_status_id' => ['required', 'integer', 'exists:App\Models\PageStatus,id'],
            'title' => ['required', 'unique:App\Models\Page', 'string'],
            'slug' => ['required', 'unique:App\Models\Page', 'string'],
            'content' => ['required', 'string'],
            'array' => ['array'],
            'array.*' => ['integer', 'exists:App\Models\PageSection,id'],
        ]);
        
        $page = Page::create([
            'user_id' => auth()->user()->id,
            'page_status_id' => $request->page_status_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content
        ]);

        /* Sync sections to many-to-many table. */
        $page->sections()->sync($request->array, 'id');

        return redirect(route('admin-pages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('models.page.admin.page', [
            'page' => $page
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('models.page.admin.page-edit', [
            'page' => $page,
            'users' => User::all(),
            'statuses' => PageStatus::all(),
            'sections' => PageSection::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $validatedData = $request->validate([
            'user_id' => ['required', 'integer', 'exists:App\Models\User,id'],
            'page_status_id' => ['required', 'integer', 'exists:App\Models\PageStatus,id'],
            'title' => ['required', Rule::unique('pages', 'title')->ignore($page->id), 'string'],
            'slug' => ['required', Rule::unique('pages', 'title')->ignore($page->id), 'string'],
            'content' => ['required', 'string'],
            'array' => ['array'],
            'array.*' => ['integer', 'exists:App\Models\PageSection,id'],
        ]);

        /* Sync sections to many-to-many table. */
        $page->sections()->sync($request->array, 'id');

        $page->user_id = $request->user_id;
        $page->page_status_id = $request->page_status_id;
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = $request->content;

        $page->save();

        return redirect(route('admin-pages'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->sections()->detach();

        $page->delete();

        return redirect(route('admin-pages'));
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

        return view('models.page.admin.pages', [
            'pages' => Page::where('title', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('slug', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('created_at', 'LIKE', '%'.$request->search_term.'%')
            ->orWhere('updated_at', 'LIKE', '%'.$request->search_term.'%')
            ->with(['status', 'sections'])
                ->orderby('title')->get()
        ]);
    }
}
