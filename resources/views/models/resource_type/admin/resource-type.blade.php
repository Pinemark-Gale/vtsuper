<x-layouts.app webpageTitle="Admin Panel">
    <div class="card">
        <h1>{{ $resourceType->type }}</h1>
        <h2>Created At: {{ $resourceType->created_at }}</h2>
        <h2>Updated At: {{ $resourceType->updated_at }}</h2>
    </div>
</x-layouts.app>