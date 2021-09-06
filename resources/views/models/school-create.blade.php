@extends('layouts.app')

@section('content')
    <h1>Create School</h1>
    <form method="POST" action="{{ route('school-store') }}" class="admin-form">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required autofocus>
        <label for="district">District</label>
        <input type="text" name="district" value="{{ old('district') }}" required autofocus>
        <button type="submit" class="form-submit">
            Create School
        </button>
    </form>
@endsection
