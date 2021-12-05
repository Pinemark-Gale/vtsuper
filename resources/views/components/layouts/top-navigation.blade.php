@props(['appLinks', 'webpageTitle'])

<nav class="top-nav-container">
    <x-svg.arrow-option onclick="themeSwitch()" id="arrow-icon" class="arrow-option light-arrow" />
    <x-layouts.light-logo :webpageTitle="$webpageTitle" />
    <x-layouts.menu-navigation :appLinks="$appLinks" />
</nav>
