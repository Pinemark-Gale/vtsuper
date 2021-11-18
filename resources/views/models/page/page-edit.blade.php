<x-layouts.app>
    <x-form.form :action="route('page-update', ['page' => $page->slug])">
        @method('patch')
        <x-form.title>Edit Page {{ $page->title }}</x-form.title>
        <x-form.input name="title" :value="old('title') ? old('title') : $page->title" autofocus />
            
        <x-form.label for="user_id" label="Author" />
        <select  name="user_id">
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : ($page->author->id == $user->id ? 'selected' : '' ) }}>{{ $user->name }}</option>
            @endforeach
        </select>

        <x-form.label for="page_status_id" label="Status" />
        <select  name="page_status_id">
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ old('page_status_id') == $status->id ? 'selected' : ($page->status->id == $status->id ? 'selected' : '' ) }}>{{ $status->status }}</option>
            @endforeach
        </select>
        
        <x-form.input name="slug" :value="old('slug') ? old('slug') : $page->slug" />
        <x-form.editor name="content" :value="old('content') ? old('content') : $page->content" />
        <x-form.array :items="$sections" :editItem="$page" label="Sections" />

        <x-form.button>Update page</x-form.button>
    </x-form.form>
</x-layouts.app>