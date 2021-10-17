<x-layouts.app>
    <x-form.form action="{{ route('login') }}">
        <!-- Email Address -->
        <x-form.input name="email" autocomplete="username" autofocus />

        <!-- Password -->
        <x-form.input name="password" type="password" autocomplete="password" />

        <!-- Remember Me -->
        <label for="remember_me">
            <input id="remember_me" type="checkbox" name="remember">
            <span>{{ __('Remember me') }}</span>
        </label>

        <div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <x-form.button>{{ __('Log in') }}</x-form.button>
        </div>
    </x-form.form>
]</x-layouts.app>
