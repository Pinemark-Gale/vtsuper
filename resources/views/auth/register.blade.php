<x-layouts.app>
        <!-- Validation Errors -->
        <x-OOB_components.auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-OOB_components.label for="name" :value="__('Name')" />

                <x-OOB_components.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-OOB_components.label for="email" :value="__('Email')" />

                <x-OOB_components.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-OOB_components.label for="password" :value="__('Password')" />

                <x-OOB_components.input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-OOB_components.label for="password_confirmation" :value="__('Confirm Password')" />

                <x-OOB_components.input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-OOB_components.button class="ml-4">
                    {{ __('Register') }}
                </x-OOB_components.button>
            </div>
        </form>
</x-layouts.app>