@extends('layouts.app')

@section('content')
<div class="card-container">
        @foreach ($privileges as $privilege)
                <a href="/privileges/{{ $privilege->title }}">
                    <div class="user-card">
                        <div class="user-info">{{ $privilege->title }}</div>
                        <div class="user-info">Updated: {{ $privilege->updated_at->format('M j, Y') }}</div>
                    </div>
                </a>
        @endforeach
    </div>
@endsection