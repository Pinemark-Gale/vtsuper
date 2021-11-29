<x-layouts.app>
    <x-form.form :action="route('admin-user-update', ['user' => $user->name])">
        @method('patch')
        <x-form.title>Edit User {{ $user->name }}</x-form.title>
        <x-form.input name="name" :value="old('name') ? old('name') : $user->name" autofocus />

        <x-form.label for="school_id" label="school" />
        <select  name="school_id">
            @foreach ($schools as $school)
                <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : ($user->school->id == $school->id ? 'selected' : '') }}>
                    {{ $school->name }}
                </option>
            @endforeach
        </select>
        
        <x-form.label for="privilege_id" label="privilege" />
        <select  name="privilege_id">
            @foreach ($privileges as $privilege)
                <option value="{{ $privilege->id }}" {{ old('privilege_id') == $privilege->id ? 'selected' : ($user->privilege->id == $privilege->id ? 'selected' : '') }}>
                    {{ $privilege->title }}
                </option>
            @endforeach
        </select>

        <x-form.input name="email" :value="old('email') ? old('email') : $user->email" />
        <x-form.input name="password" type="password" />
        <x-form.input name="password_confirmation" type="password" label="confirm password" />
        <x-form.button>Update User</x-form.button>
    </x-form.form>
</x-layouts.app>