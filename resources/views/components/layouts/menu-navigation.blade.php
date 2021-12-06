@props(['appLinks'])

<button onclick="menuSwitch()" id="menu-icon" class="menu-icon" data-message="Pull up the main navigation for the website.">
    <div class="top-bar"></div>
    <div class="middle-bar"></div>
    <div class="bottom-bar"></div>
</button>

<nav id="menu-nav" class="menu-nav-container menu-nav-hide">
    <!-- left side of menu navigation -->
    <div class="link-container">
        @auth
            @if (auth()->user()->privilegeCheck('contributor'))
                <a href="{{ route('admin-users') }}" class="red-link">Admin Panel</a>
            @endif
        @else 
            <a href="{{ route('login') }}" class="red-link">Log in</a>
            <a href="{{ route('admin-user-create') }}" class="red-link">Register</a>
        @endauth
    </div>
    <!-- menu divider -->
    <div class="svg-container">
        <x-svg.menu-seperator />
    </div>
    <!-- right side of menu navigation -->
    <div class="link-container">
        <a href="{{ url('/dashboard') }}" class="blue-link">Dashboard</a>
        @auth
            <form method="POST" action="{{ route('logout') }}" >
                    @csrf

                    <div  class="blue-link":href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </div>
            </form>
        @endauth

        @foreach ($appLinks as $link)
            @if ($link->sections->contains('section', 'Main Navigation'))
                <a href="{{ route('admin-page', ['page' => $link->slug]) }}" class="blue-link">{{ $link->title }}</a>
            @endif
        @endforeach
    </div>
</nav>

<script type="application/javascript">
    // Toggle Modal Hide
    function menuSwitch() {
        document.getElementById("menu-nav").classList.toggle('menu-nav-hide');
        document.getElementById("menu-icon").classList.toggle('menu-icon');
        document.getElementById("menu-icon").classList.toggle('active-menu-icon');
        document.getElementById("arrow-icon").classList.toggle('light-arrow');
        document.getElementById("arrow-icon").classList.toggle('dark-arrow');
        document.getElementById("logo").classList.toggle('light-logo');
        document.getElementById("logo").classList.toggle('dark-logo');
    }
</script>