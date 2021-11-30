<x-layouts.app>
    <div class="card">
        <h1>{{ $source->source }}</h1>
        <h2>Created At: {{ $source->created_at }}</h2>
        <h2>Updated At: {{ $source->updated_at }}</h2>
        <a href="{{ route('admin-source-edit', ['source' => $source->source]) }}">
            <div class="user-action">Edit</div>
        </a>
        <form method="POST" action="{{ route('admin-source-destroy', ['source' => $source->source]) }}" class="admin-form">
            @csrf
            @method('DELETE')
            <button source="submit" class="form-submit">Destroy</button>
        </form>

    </div>
</x-layouts.app>