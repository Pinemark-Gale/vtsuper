@extends('layouts.app')

@section('content')
<div class="card-container">
        @foreach ($schools as $school)
                <a href="/schools/{{ $school->title }}">
                    <div class="user-card">
                        <div class="user-info">{{ $school->name }}</div>
                        <div class="user-info">Updated: {{ $school->updated_at->format('M j, Y') }}</div>
                    </div>
                </a>
        @endforeach
    </div>
@endsection