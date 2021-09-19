@extends('layouts.app')

@section('content')
    <h1>Create Source</h1>
    <form method="POST" action="{{ route('source-store') }}" class="admin-form">
        @csrf
        <label for="source">Source</label>
        <input source="text" name="source" value="{{ old('source') }}" required autofocus>
        <button source="submit" class="form-submit">
            Create Source
        </button>
    </form>
@endsection
