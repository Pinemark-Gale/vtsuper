@props(['webpageTitle'])

<div id="logo" class="logo light-logo">
        <a href="{{ route('home') }}"><h1>VT SUPER</h1></a>
        <div class="sub-title">{{ $webpageTitle ?? auth()->user()?->privilege->title }}</div>
</div>