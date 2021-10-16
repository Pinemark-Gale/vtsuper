<x-layouts.app>
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tags.js') }}" defer></script>
    </x-slot>

    <x-form.form action="{{ route('resource-store') }}">
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

        <label for="tags">Tags</label>

        <!-- tag container collection for user to select tags -->
        <div id="tag-container">
            <span>Available Tags</span>
            @foreach ($tags as $tag)
                <div data-tid="{{ $tag->id }}" class="tag-container-tag">{{ $tag->tag }}</div>
            @endforeach
        </div>

        <!-- resource tags collection for user to remove and view current tags -->
        <div id='resource-tags'>
        </div>

        <!-- resource tag ids for submitting tags to the database -->
        <div id='resource-tag-ids'>
        </div>

        <x-form.button>Create Resource</x-form.button>
    </x-form.form>
</x-layouts.app>