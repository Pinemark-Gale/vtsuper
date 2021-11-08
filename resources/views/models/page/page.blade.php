<x-layouts.app>
    <div class="card">
        <h1>{{ $page->title }}</h1>
        <h2>Status: {{ $page->status->status }}</h2>
        <h2>Sections:</h2>
        @foreach ($page->sections as $section)
            <p>{{ $section->section }}</p>
        @endforeach
        <h2>Published At: {{ $page->created_at->format('M j, Y') }}</h2>
        <h2>Content: {!! $page->content !!}</h2>
    </div>
</x-layouts.app>