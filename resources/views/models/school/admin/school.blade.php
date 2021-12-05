<x-layouts.app webpageTitle="Admin Panel">
    <div class="card">
        <h1>{{ $school->name }}</h1>
        <h2>{{ $school->district }}</h2>
        <h2>Created At: {{ $school->created_at }}</h2>
        <h2>Updated At: {{ $school->updated_at }}</h2>
    </div>
</x-layouts.app>