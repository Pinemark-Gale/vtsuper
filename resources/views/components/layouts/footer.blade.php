<div class="rainbow-border"></div>
<div class="footer-container">
    <div class="link-container">
        <a class="link red-link">Student Resources</a>
        <a class="link red-link">Educator Resources</a>
    </div>
    <x-svg.footer-seperator class="seperator" />
    <div class="link-container">
        @foreach ($appLinks as $link)
            @if ($link->sections->contains('section', 'Footer'))
                <a href="{{ route('page', ['page' => $link->slug]) }}" class="link blue-link">{{ $link->title }}</a>
            @endif
        @endforeach
        <a class="link blue-link">Home</a>
        <a class="link blue-link">Contact Us</a>
        <a class="link blue-link">About VT-SUPER</a>
        <a class="link blue-link">Account</a>
        <a class="link blue-link">About WPP</a>
    </div>
</div>
<div class="info-container">
    <a class="info">2021 (c) Winooski Partners for Prevention</a>
    <a class="info">Site by Pinemark Studio</a>
    <a class="info">Privacy Policy</a>
    <a class="info">Cookies Policy</a>
    <a class="info">Terms & Conditions</a>        
</div>