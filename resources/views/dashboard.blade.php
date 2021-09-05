@extends('layouts.app')

@section('content')
    <h1>Welcome {{ Auth::user()->name }}</h1>
    <h3>Email: {{ Auth::user()->email }}</h3>
    <h3>School: {{ Auth::user()->school->name }}</h3>
    <h3>Privilege: {{ Auth::user()->privilege->title }}</h3>

@endsection
