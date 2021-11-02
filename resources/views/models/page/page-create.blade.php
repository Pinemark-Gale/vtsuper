<x-layouts.app>

    <x-form.form :action="route('page-store')">
        <x-form.title>Create Page</x-form.title>
        
        <x-form.input name="title" autofocus />
        
        <x-form.label for="page_status_id" label="Status" />
        <select  name="page_status_id">
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ old('page_status_id') == $status->id ? 'selected' : '' }}>{{ $status->status }}</option>
            @endforeach
        </select>

        <x-form.label for="page_section_id" label="Section" />
        <select  name="page_section_id">
            @foreach ($sections as $sections)
                <option value="{{ $sections->id }}" {{ old('page_section_id') == $sections->id ? 'selected' : '' }}>{{ $sections->section }}</option>
            @endforeach
        </select>

        <x-form.input name="slug" />
        <x-form.input name="content" />

        <x-form.button>Create Page</x-form.button>
    </x-form.form>
</x-layouts.app>