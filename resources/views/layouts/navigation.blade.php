<navigation>
    @if (Route::has('login'))
        <div class="header-logo">
            <a href="{{ route('home') }}"<h1>VT Super</h1></a>
        </div>
        <div class="header-style">
            @auth
                <a href="{{ url('/dashboard') }}" class="">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <div :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </div>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth

        </div>
    @endif</navigation>
