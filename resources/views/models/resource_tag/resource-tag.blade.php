<x-layouts.app>
    <div class="card">
        <h1>{{ $resourceTag->tag }}</h1>
        <h2>Created At: {{ $resourceTag->created_at }}</h2>
        <h2>Updated At: {{ $resourceTag->updated_at }}</h2>
        <a href="{{ route('resource-tag-edit', ['resourceTag' => $resourceTag->tag]) }}">
            <div class="user-action">Edit</div>
        </a>
        <form method="POST" action="{{ route('resource-tag-destroy', ['resourceTag' => $resourceTag->tag]) }}" class="admin-form">
            @csrf
            @method('DELETE')
            <button tag="submit" class="form-submit">Destroy</button>
        </form>

    </div>
</x-layouts.app>