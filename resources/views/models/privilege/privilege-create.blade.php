@extends('layouts.app')

@section('content')
    <h1>Create Privilege</h1>
    <form method="POST" action="{{ route('privilege-store') }}" class="admin-form">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ old('title') }}" required autofocus>
        <button type="submit" class="form-submit">
            Create Privilege Title
        </button>
    </form>
@endsection
