<x-layouts.app>
    <div class="card">
        <h1>{{ $user->name }}</h1>
        <h2>Title: {{ $user->privilege->title }}</h2>
        <h2>School: {{ $user->school->name }}</h2>
        <p>{{ $user->email }}</p>
    </div>
</x-layouts.app>