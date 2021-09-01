@extends('layouts.app')

@section('content')
    @foreach ($users as $user)
        <div>
            <a href="/users/{{ $user->name }}">{{ $user->name }}</a>
        </div>
    @endforeach
@endsection
