@extends('layouts.app')

@section('content')
    <h1>Edit Resource Tag {{ $resourceTag->tag }}</h1>
    <form method="POST" action="{{ route('resource-tag-update', ['resourceTag' => $resourceTag->tag]) }}" class="admin-form">
        @csrf
        <label for="tag">tag</label>
        <input tag="text" name="tag" value="{{ $resourceTag->tag }}" required autofocus>
        <button tag="submit" class="form-submit">
            Update Resource Tag
        </button>
    </form>
@endsection
