<x-layouts.app>
    <h1>Register</h1>
    <x-form-errors />
    <form method="POST" action="{{ route('user-store') }}" class="admin-form">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required autofocus>

        <label for="school_id"'>School</label>
        <select  name="school_id">
            @foreach ($schools as $school)
                <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
            @endforeach
        </select>
        
        <label for="privilege_id">Privilege</label>
        <select  name="privilege_id">
            @foreach ($privileges as $privilege)
                <option value="{{ $privilege->id }}" {{ old('privilege_id') == $privilege->id ? 'selected' : '' }}>{{ $privilege->title }}</option>
            @endforeach
        </select>

        <label for="email">Email</label>
        <input type="text" name="email" value="{{ old('email') }}">

        <label for="password">Password</label>
        <input type="password" name="password" value="{{ old('password') }}">

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" value="">

        <button type="submit" class="form-submit">
            Create Account
        </button>
    </form>
</x-layouts.app>