<x-layouts.app>
    <x-form.form :action="route('user-update', ['user' => $user->id])">
        @method('patch')
        <x-form.title>Edit User {{ $user->name }}</x-form.title>
        <x-form.input name="name" :value="old('name') ? old('name') : $user->name" autofocus />
        <x-form.input name="pronouns" :value="old('pronouns') ? old('pronouns') : $user->pronoun->pronouns" />

        <x-form.label for="school_id" label="school" />
        <select  name="school_id">
            @foreach ($schools as $school)
                <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : ($user->school->id == $school->id ? 'selected' : '') }}>
                    {{ $school->name }}
                </option>
            @endforeach
        </select>
        
        <x-form.input name="email" :value="old('email') ? old('email') : $user->email" />
        <x-form.button>Update Settings</x-form.button>
    </x-form.form>

    <a href="{{ route('user-edit-password') }}">Reset Password</a>
</x-layouts.app>