<x-layouts.app>

    <x-form.form :action="route('page-store')">
        <x-form.title>Create Page</x-form.title>
        
        <x-form.input name="title" autofocus />
        
        <x-form.label for="page_status_id" labetl="Status" />
        <select  name="page_status_id">
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ old('page_status_id') == $status->id ? 'selected' : '' }}>{{ $status->status }}</option>
            @endforeach
        </select>

        <x-form.input name="slug" />

        <x-form.array :items="$sections" label="Sections" />

        <x-form.editor name="content" />

        <x-form.button>Create Page</x-form.button>
    </x-form.form>

</x-layouts.app>