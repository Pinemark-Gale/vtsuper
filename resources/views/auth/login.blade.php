<x-layouts.app>
    <x-OOB_components.auth-card>

        <!-- Session Status -->
        <x-OOB_components.auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-OOB_components.auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" class="admin-form">
            @csrf

            <!-- Email Address -->
            <label for="email" value="__('Email')">Email</label>
            <input id="email" type="email" name="email" required autofocus />

            <!-- Password -->
                <label for="password" value="__('Password')">Password</label>
                <input id="password" type="password" name="password" required>

            <!-- Remember Me -->
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-OOB_components.button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-OOB_components.auth-card>
</x-layouts.app>
