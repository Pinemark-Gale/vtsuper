<x-layouts.app>
    <h1>Create Resource Tag</h1>
    <x-form-errors />
    <form method="POST" action="{{ route('resource-tag-store') }}" class="admin-form">
        @csrf
        <label for="tag">Tag</label>
        <input tag="text" name="tag" value="{{ old('tag') }}" required autofocus>
        <button tag="submit" class="form-submit">
            Create Resource Tag
        </button>
    </form>
</x-layouts.app>