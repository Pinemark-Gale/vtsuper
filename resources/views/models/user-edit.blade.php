@extends('layouts.app')

@section('content')
    <h1>Edit User {{ $user->name }}</h1>
    <form method="POST" action=" {{ route('user-update') }}" class="admin-form">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $user->name }}" required autofocus>

        <label for="school"'>School</label>
        <select  name="school">
            @foreach ($schools as $school)
                <option value="{{ $school->name }}">{{ $school->name }}</option>
            @endforeach
        </select>
        
        <label for="privilege">Privilege</label>
        <select  name="privilege">
            @foreach ($privileges as $privilege)
                <option value="{{ $privilege->title }}">{{ $privilege->title }}</option>
            @endforeach
        </select>

        <label for="email">Email</label>
        <input type="text" name="email" value="{{ $user-email }}">

        <label for="password">Password</label>
        <input type="password" name="password" value="{{ old('password') }}">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <button type="submit" class="form-submit">
            Create User
        </button>
    </form>
@endsection
