<x-layouts.app webpageTitle="Admin Panel">
    <div class="card">
        <h1>{{ $user->name }}</h1>
        <h2>Title: {{ $user->privilege->title }}</h2>
        <h2>School: {{ $user->school->name }}</h2>
        <p>{{ $user->email }}</p>
        <h2>Member Since: {{ $user->created_at->format('M j, Y') }}</h2>
    </div>
</x-layouts.app>