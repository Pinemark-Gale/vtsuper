<x-layouts.app webpageTitle="Admin Panel">
    <div class="card">
        <h1>{{ $resource->name }}</h1>
        <h2>Type: {{ $resource->type->type }}</h2>
        <h2>Source: {{ $resource->source->source }}</h2>
        <h2>Tags: {{ $resource->tags->pluck('tag') }}</h2>
        <h2>Link: {{ $resource->link }}</h2>
        <p>{{ $resource->description }}</p>
        <p>Last Updated: {{ $resource->updated_at->format('M j, Y') }}</p>
    </div>
</x-layouts.app>