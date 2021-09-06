@extends('layouts.app')

@section('content')
    <div class="card-container">
        <a href="{{ route('school-create') }}" style="display: block; width: 100%;">Create School</a>
        @foreach ($schools as $school)
            <a href="{{ route('school', ['school' => $school->name]) }}">
                <div class="user-card">
                    <div class="user-info">{{ $school->name }}</div>
                    <div class="user-info">Updated: {{ $school->updated_at->format('M j, Y') }}</div>
                </div>
            </a>
        @endforeach
    </div>
@endsection