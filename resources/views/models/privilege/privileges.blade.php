<x-layouts.app>
    <div class="card-container">
        <a href="{{ route('privilege-create') }}" style="display: block; width: 100%;">Create Privilege</a>
        @foreach ($privileges as $privilege)
            <a href="{{ route('privilege', ['privilege' => $privilege->title]) }}">
                <div class="user-card">
                    <div class="user-info">{{ $privilege->title }}</div>
                    <div class="user-info">Updated: {{ $privilege->updated_at->format('M j, Y') }}</div>
                </div>
            </a>
        @endforeach
    </div>
</x-layouts.app>