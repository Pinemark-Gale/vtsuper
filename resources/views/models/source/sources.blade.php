<x-layouts.app>
<div class="card-container">
        <a href="{{ route('source-create') }}" style="display: block; width: 100%;">Create Source</a>
        @foreach ($sources as $source)
            <a href="{{ route('source', ['source' => $source->source]) }}">
                <div class="user-card">
                    <div class="user-info">{{ $source->source }}</div>
                    <div class="user-info">Updated: {{ $source->updated_at->format('M j, Y') }}</div>
                </div>
            </a>
        @endforeach
    </div>
</x-layouts.app>