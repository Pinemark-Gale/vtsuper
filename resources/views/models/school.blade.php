@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>{{ $school->name }}</h1>
        <h2>{{ $school->district }}</h2>
        <h2>Created At: {{ $school->created_at }}</h2>
        <h2>Updated At: {{ $school->updated_at }}</h2>
        <a href="{{ route('school-edit', ['school' => $school->name]) }}">
            <div class="user-action">Edit</div>
        </a>
        <form method="POST" action="{{ route('school-destroy', ['school' => $school->name]) }}" class="admin-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="form-submit">Destroy</button>
        </form>

    </div>
@endsection