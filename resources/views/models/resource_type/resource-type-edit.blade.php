<x-layouts.app>
    <h1>Edit Resource Type {{ $resourceType->type }}</h1>
    <form method="POST" action="{{ route('resource-type-update', ['resourceType' => $resourceType->type]) }}" class="admin-form">
        @csrf
        <label for="type">type</label>
        <input type="text" name="type" value="{{ $resourceType->type }}" required autofocus>
        <button type="submit" class="form-submit">
            Update Resource Type
        </button>
    </form>
</x-layouts.app>