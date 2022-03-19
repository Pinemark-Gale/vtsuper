<div class="bottom-container">
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
        </div>
    </div>
    <div class="info-container">
        <a class="info">2021 (c) Winooski Partners for Prevention</a>
        <a class="info">Site by Pinemark Studio</a>
            @foreach ($appLinks as $link)
                @if ($link->sections->contains('section', 'Sub Footer'))
                    <a href="{{ route('page', ['page' => $link->slug]) }}" class="info">{{ $link->title }}</a>
                @endif
            @endforeach
    </div>
</div>