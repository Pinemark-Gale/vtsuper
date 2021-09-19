@extends('layouts.app')

@section('content')
    <h1>Create Resource Type</h1>
    <form method="POST" action="{{ route('resource-type-store') }}" class="admin-form">
        @csrf
        <label for="type">Type</label>
        <input type="text" name="type" value="{{ old('type') }}" required autofocus>
        <button type="submit" class="form-submit">
            Create Resource Type
        </button>
    </form>
@endsection
