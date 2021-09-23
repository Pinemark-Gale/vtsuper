<x-layouts.app>
    <h1>Edit Resource {{ $resource->name }}</h1>
    @if ($errors->any())
        <h1>ERRORS: Plez Fix</h1>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif
    <form method="POST" action="{{ route('resource-update', ['resource' => $resource->name]) }}" class="admin-form">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $resource->name }}" required autofocus>

        <label for="resource_type_id"'>Resource Type</label>
        <select  name="resource_type_id">
            @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->type }}</option>
            @endforeach
        </select>
        
        <label for="source_id">Source</label>
        <select  name="source_id">
            @foreach ($sources as $source)
                <option value="{{ $source->id }}">{{ $source->source }}</option>
            @endforeach
        </select>

        <label for="link">Link</label>
        <input type="text" name="link" value="{{ $resource->link }}">

        <label for="description">Description</label>
        <input type="text" name="description" value="{{ $resource->description }}">

        <label for="tags">Tags</label>
        <ul>
            @foreach ($tags as $tag)
                <li>{{ $tag->id }} - {{ $tag->tag }}</li>
            @endforeach
        </ul>
        <ul>
            @foreach ($resource->tags as $tag)
                <input type="text" name="tags[{{ $loop->index }}][id]" value="{{ $tag->id }}">
            @endforeach
        </ul>

        <button type="submit" class="form-submit">
            Update Resource
        </button>
    </form>
</x-layouts.app>