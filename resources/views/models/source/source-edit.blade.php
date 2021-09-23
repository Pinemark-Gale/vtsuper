<x-layouts.app>
    <h1>Edit Source {{ $source->source }}</h1>
    <form method="POST" action="{{ route('source-update', ['source' => $source->source]) }}" class="admin-form">
        @csrf
        <label for="source">source</label>
        <input source="text" name="source" value="{{ $source->source }}" required autofocus>
        <button source="submit" class="form-submit">
            Update Source
        </button>
    </form>
</x-layouts.app>