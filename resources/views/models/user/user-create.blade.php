<x-layouts.app>
    <x-form.form action="{{ route('user-store') }}">
        <x-form.title>Register</x-form.title>
        <x-form.input name="name" autofocus />

        <x-form.label for="school_id" label="school" />
        <select  name="school_id">
            @foreach ($schools as $school)
                <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
            @endforeach
        </select>
        
        <x-form.label for="privilege_id" label="privilege" />
        <select  name="privilege_id">
            @foreach ($privileges as $privilege)
                <option value="{{ $privilege->id }}" {{ old('privilege_id') == $privilege->id ? 'selected' : '' }}>{{ $privilege->title }}</option>
            @endforeach
        </select>

        <x-form.input name="email" />
        <x-form.input name="password" type="password" autocomplete="new-password" />
        <x-form.input name="password_confirmation" type="password" label="confirm password" />
        <x-form.button>Create Account</x-form.button>
    </x-form.form>
</x-layouts.app>