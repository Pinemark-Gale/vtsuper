<x-layouts.app>
    <div class="card-container">
        <a href="{{ route('resource-create') }}" style="display: block; width: 100%;">Create Resource</a>
        @foreach ($resources as $resource)
                <a href="{{ route('resource', ['resource' => $resource->name]) }}">
                    <div class="user-card">
                        <div class="user-info">{{ $resource->name }}</div>
                        <div class="user-info">{{ $resource->type->type }}</div>
                        <div class="user-info">{{ $resource->source->source }}</div>
                        <div class="user-info">{{ $resource->tags->pluck('tag')}}</div>
                        <a href="{{ route('resource-edit', ['resource' => $resource->name]) }}">
                            <div class="user-action">Edit</div>
                        </a>
                        <form method="POST" action="{{ route('resource-destroy', ['resource' => $resource->name]) }}" class="admin-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="form-submit">Destroy</button>
                        </form>
                    </div>
                </a>
        @endforeach
    </div>
</x-layouts.app>