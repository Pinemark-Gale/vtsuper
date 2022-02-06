<x-layouts.app webpageTitle="Admin Panel">
    
    <x-form.form :action="route('admin-activity-store')">
        <x-form.title>Create Activity</x-form.title>
        <x-form.input-hidden name="user_id" value="{{ auth()->user()->id }}" />
        <x-form.input name="name" required autofocus />
        <x-form.input name="minutes_to_complete" label="Minutes to Complete" />

        <x-form.label for="resource_id" label="Resource" />
        <select name="resource_id">
            @foreach ($resources as $resource)
                <option value="{{ $resource->id }}" {{ old('resource_id') == $resource-> id ? 'selected' : '' }}>{{ $resource->name }}</option>
            @endforeach
        </select>
        
        <x-form.editor name="instructions" />
        <x-form.button>Create Activity</x-form.button>
    </x-form.form>

</x-layouts.app>