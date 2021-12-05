<x-layouts.app webpageTitle="Admin Panel">
    <div class="card">
        <h1>{{ $resourceTag->tag }}</h1>
        <h2>Created At: {{ $resourceTag->created_at }}</h2>
        <h2>Updated At: {{ $resourceTag->updated_at }}</h2>
    </div>
</x-layouts.app>