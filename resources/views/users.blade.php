@extends('layouts.app')

@section('content')
    <div class="card-container">
        @foreach ($users as $user)
                <a href="/users/{{ $user->name }}">
                    <div class="user-card">
                        <div class="user-info">{{ $user->privilege->title }}</div>
                        <div class="user-info">{{ $user->name }}</div>
                        <div class="user-info">{{ $user->school->name}}</div>
                    </div>
                </a>
        @endforeach
    </div>
    @endsection
