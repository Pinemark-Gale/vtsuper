<x-layouts.app>
    <x-form.form :action="route('resource-update', ['resource' => $resource->name])">
        @method('patch')
        <x-form.title>Edit Resource {{ $resource->name }}</x-form.title>
        <x-form.input name="name" :value="old('name') ? old('name') : $resource->name" autofocus />

        <x-form.label for="resource_type_id" label="resource type" />
        <select  name="resource_type_id">
            @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ old('resource_type_id') == $type->id ? 'selected' : ($resource->type->id == $type->id ? 'selected' : '' ) }}>{{ $type->type }}</option>
            @endforeach
        </select>
        
        <x-form.label for="source_id" label="source" />
        <select  name="source_id">
            @foreach ($sources as $source)
                <option value="{{ $source->id }}" {{ old('source_id') == $source->id ? 'selected' : ($resource->source->id == $source->id ? 'selected' : '') }}>{{ $source->source }}</option>
            @endforeach
        </select>

        <x-form.input name="link" :value="old('link') ? old('link') : $resource->link" />
        <x-form.input name="description" :value="old('description') ? old('description') : $resource->description" />
        <x-form.array :items="$tags" :editItem="$resource" label="Tags" />

        <x-form.button>Update Resource</x-form.button>
    </x-form.form>
</x-layouts.app>