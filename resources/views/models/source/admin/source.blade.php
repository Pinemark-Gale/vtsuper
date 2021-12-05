<x-layouts.app webpageTitle="Admin Panel">
    <div class="card">
        <h1>{{ $source->source }}</h1>
        <h2>Created At: {{ $source->created_at }}</h2>
        <h2>Updated At: {{ $source->updated_at }}</h2>
    </div>
</x-layouts.app>