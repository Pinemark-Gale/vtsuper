<x-layouts.app>
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tags.js') }}" defer></script>
    </x-slot>

    <h1>Edit Resource {{ $resource->name }}</h1>
    <x-form-errors />
    <form method="POST" action="{{ route('resource-update', ['resource' => $resource->name]) }}" class="admin-form">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $resource->name }}" required autofocus>

        <label for="resource_type_id"'>Resource Type</label>
        <select  name="resource_type_id">
            @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ old('resource_type_id') == $type->id ? 'selected' : ($resource->type->id == $type->id ? 'selected' : '' ) }}>{{ $type->type }}</option>
            @endforeach
        </select>
        
        <label for="source_id">Source</label>
        <select  name="source_id">
            @foreach ($sources as $source)
                <option value="{{ $source->id }}" {{ old('source_id') == $source->id ? 'selected' : ($resource->source->id == $source->id ? 'selected' : '') }}>{{ $source->source }}</option>
            @endforeach
        </select>

        <label for="link">Link</label>
        <input type="text" name="link" value="{{ $resource->link }}">

        <label for="description">Description</label>
        <input type="text" name="description" value="{{ $resource->description }}">

        <label for="tags">Tags</label>

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

        <button type="submit" class="form-submit">
            Update Resource
        </button>
    </form>
</x-layouts.app>