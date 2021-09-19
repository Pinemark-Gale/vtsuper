@extends('layouts.app')

@section('content')
    <h1>Create Resource</h1>
    @if ($errors->any())
        <h1>ERRORS: Plez Fix</h1>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif
    <form method="POST" action="{{ route('resource-store') }}" class="admin-form">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required autofocus>

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
        <input type="text" name="link" value="{{ old('link') }}">

        <label for="description">Description</label>
        <input type="text" name="description" value="{{ old('description') }}">

        <label for="tags">Tags</label>
        <ul>
            @foreach ($tags as $tag)
                <li>{{ $tag->id }} - {{ $tag->tag }}</li>
            @endforeach
        </ul>
        <input type="text" name="tags[0][id]" value="1">
        <input type="text" name="tags[1][id]" value="2">

        <button type="submit" class="form-submit">
            Create Resource
        </button>
    </form>
@endsection
