<x-layouts.app webpageTitle="Admin Panel">
    <div class="card">
        <h1>{{ $privilege->title }}</h1>
        <h2>Created At: {{ $privilege->created_at }}</h2>
        <h2>Updated At: {{ $privilege->updated_at }}</h2>
    </div>
</x-layouts.app>