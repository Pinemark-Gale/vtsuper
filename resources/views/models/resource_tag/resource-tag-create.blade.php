@extends('layouts.app')

@section('content')
    <h1>Create Resource Tag</h1>
    <form method="POST" action="{{ route('resource-tag-store') }}" class="admin-form">
        @csrf
        <label for="tag">Tag</label>
        <input tag="text" name="tag" value="{{ old('tag') }}" required autofocus>
        <button tag="submit" class="form-submit">
            Create Resource Tag
        </button>
    </form>
@endsection
