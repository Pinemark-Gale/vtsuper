<x-layouts.app>
    <div>
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <x-form.form action="{{ route('password.email') }}">
        <!-- Email Address -->
        <x-form.input name="email" autofocus />

        <x-form.button>{{ __('Email Password Reset Link') }}</x-form.button>
    </x-form.form>
</x-layouts.app>
