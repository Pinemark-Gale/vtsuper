@props(['appLinks'])

<button onclick="menuSwitch()" id="menu-icon" class="menu-icon">
    <div class="top-bar"></div>
    <div class="middle-bar"></div>
    <div class="bottom-bar"></div>
</button>

<div id="menu-nav" class="menu-nav-container menu-nav-hide">
    <!-- left side of menu navigation -->
    <div class="link-container">
        @auth
            @if (auth()->user()->privilegeCheck('admin'))
                <a href="{{ route('users') }}" class="red-link">Users</a>
                <a href="{{ route('privileges') }}" class="red-link">Privileges</a>
                <a href="{{ route('admin-pages') }}" class="red-link">Pages</a>
            @endif
            @if (auth()->user()->privilegeCheck('contributor'))
                <a href="{{ route('sources') }}" class="red-link">Sources</a>
            @endif
            @if (auth()->user()->privilegeCheck('teacher'))
                <a href="{{ route('schools') }}" class="red-link">Schools</a>
                <a href="{{ route('resource-tags') }}" class="red-link">Resource Tags</a>
                <a href="{{ route('resource-types') }}" class="red-link">Resource Types</a>
            @endif
        @else 
            <a href="{{ route('login') }}" class="red-link">Log in</a>
            <a href="{{ route('user-create') }}" class="red-link">Register</a>
        @endauth
    </div>
    <!-- menu divider -->
    <div class="svg-container">
        <x-svg.menu-seperator />
    </div>
    <!-- right side of menu navigation -->
    <div class="link-container">
        <a href="{{ url('/dashboard') }}" class="blue-link">Dashboard</a>
        <a href="{{ route('resources') }}" class=blue-link>Resources</a>
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
                <a href="{{ route('page', ['page' => $link->slug]) }}" class="blue-link">{{ $link->title }}</a>
            @endif
        @endforeach
    </div>
</div>

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