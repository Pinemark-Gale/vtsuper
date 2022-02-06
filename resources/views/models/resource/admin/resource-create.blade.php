<x-layouts.app>
    <x-form.form :action="route('admin-resource-store')">
        <x-form.title>Create Resource</x-form.title>
        <x-form.input name="name" autofocus />

        <x-form.label for="resource_type_id" label="resource type" />
        <select  name="resource_type_id">
            @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ old('resource_type_id') == $type->id ? 'selected' : '' }}>{{ $type->type }}</option>
            @endforeach
        </select>
        
        <x-form.label for="source_id" label="source" />
        <select  name="source_id">
            @foreach ($sources as $source)
                <option value="{{ $source->id }}" {{ old('source_id') == $source->id ? 'selected' : '' }}>{{ $source->source }}</option>
            @endforeach
        </select>

        <x-form.input name="link" />
        <x-form.input name="description" />
        <x-form.array :items="$tags" label="Tags" />

        <x-form.button>Create Resource</x-form.button>
    </x-form.form>
</x-layouts.app>