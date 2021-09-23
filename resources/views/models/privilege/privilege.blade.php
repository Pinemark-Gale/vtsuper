<x-layouts.app>
    <div class="card">
        <h1>{{ $privilege->title }}</h1>
        <h2>Created At: {{ $privilege->created_at }}</h2>
        <h2>Updated At: {{ $privilege->updated_at }}</h2>
        <a href="{{ route('privilege-edit', ['privilege' => $privilege->title]) }}">
            <div class="user-action">Edit</div>
        </a>
        <form method="POST" action="{{ route('privilege-destroy', ['privilege' => $privilege->title]) }}" class="admin-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="form-submit">Destroy</button>
        </form>

    </div>
</x-layouts.app>