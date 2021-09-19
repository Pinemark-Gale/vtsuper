<nav>
    @if (Route::has('login'))
        <div class="header-logo">
            <a href="{{ route('home') }}"><h1>VT Super</h1></a>
        </div>
        <div class="header-style">
            @auth
                <a href="{{ url('/dashboard') }}" class="header-item">Dashboard</a>
                <a href="{{ route('users') }}" class="header-item">Users</a>
                <a href="{{ route('privileges') }}" class="header-item">Privileges</a>
                <a href="{{ route('schools') }}" class="header-item">Schools</a>
                <a href="{{ route('resource-types') }}" class="header-item">Resource Types</a>
                <a href="{{ route('resource-tags') }}" class="header-item">Resource Tags</a>
                <a href="{{ route('sources') }}" class="header-item">Sources</a>
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
