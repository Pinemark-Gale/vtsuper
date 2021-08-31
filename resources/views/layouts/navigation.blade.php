<nav>
    @if (Route::has('login'))
        <div class="header-logo">
            <a href="{{ route('home') }}"><h1>VT Super</h1></a>
        </div>
        <div class="header-style">
            @auth
                <a href="{{ url('/dashboard') }}" class="header-item">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="header-item">
                    @csrf

                    <div :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </div>
                </form>
            @else
                <a href="{{ route('login') }}" class="header-item">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="header-item">Register</a>
                @endif
            @endauth

        </div>
    @endif
</nav>
