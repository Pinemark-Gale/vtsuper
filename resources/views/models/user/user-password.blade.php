<x-layouts.app>
    <x-form.form :action="route('user-update-password', ['user' => $user->name])">
        @method('patch')
        <x-form.input name="password" type="password" />
        <x-form.input name="password_confirmation" type="password" label="confirm password" />
        <x-form.button>Update Password</x-form.button>
    </x-form.form>

    <a href="{{ route('user-edit') }}">Edit Profile</a>
</x-layouts.app>