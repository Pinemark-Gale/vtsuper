<x-layouts.app>
    <x-form.form :action="route('user-store')">
        <x-form.title>Register</x-form.title>
        <x-form.input name="name" required autofocus />
        <x-form.input name="pronouns" />

        <x-form.label for="school_id" label="school" />
        <select  name="school_id">
            @foreach ($schools as $school)
                <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
            @endforeach
        </select>
        
        <x-form.input name="email" required />
        <x-form.input name="password" type="password" autocomplete="new-password" required />
        <x-form.input name="password_confirmation" type="password" label="confirm password" required />
        <x-form.button>Create Account</x-form.button>
    </x-form.form>
</x-layouts.app>