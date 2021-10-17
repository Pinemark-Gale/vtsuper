<x-layouts.app>
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tags.js') }}" defer></script>
    </x-slot>

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

        <x-form.label for="tags" label="tags" />

        <!-- tag container collection for user to select tags -->
        <div id="tag-container">
            <span>Available Tags</span>
            @foreach ($tags as $tag)
                @if (!$resource->tags->contains('id', $tag->id))
                    <div data-tid="{{ $tag->id }}" class="tag-container-tag">{{ $tag->tag }}</div>
                @endif
            @endforeach
        </div>

        <!-- resource tags collection for user to remove and view current tags -->
        <div id='resource-tags'>
            @foreach ($resource->tags as $tag)
                <div data-tid="{{ $tag->id }}" class="resource-tag">{{ $tag->tag }}</div>
            @endforeach
        </div>

        <!-- resource tag ids for submitting tags to the database -->
        <div id='resource-tag-ids'>
            @foreach ($resource->tags as $tag)
                <input type="hidden" class="resource-tag-id" name="tags[{{ $loop->index }}][id]" value="{{ $tag->id }}">
            @endforeach
        </div>

        <x-form.button>Update Resource</x-form.button>
    </x-form.form>
</x-layouts.app>