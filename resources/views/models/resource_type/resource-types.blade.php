<x-layouts.app>
    <div class="card-container">
        <a href="{{ route('resource-type-create') }}" style="display: block; width: 100%;">Create Resource Type</a>
        @foreach ($resourceTypes as $resourceType)
            <a href="{{ route('resource-type', ['resourceType' => $resourceType->type]) }}">
                <div class="user-card">
                    <div class="user-info">{{ $resourceType->type }}</div>
                    <div class="user-info">Updated: {{ $resourceType->updated_at->format('M j, Y') }}</div>
                </div>
            </a>
        @endforeach
    </div>
</x-layouts.app>