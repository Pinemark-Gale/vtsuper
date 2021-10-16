<x-layouts.app>
    <x-form.form action="{{ route('source-update', ['source' => $source->source]) }}">
        <x-form.title>Edit Source {{ $source->source }}</x-form.title>
        <x-form.input name="source" value="{{ old('source') ? old('source') : $source->source }}" autofocus />
        <x-form.button>Update Source</x-form.button>
    </x-form.form>
</x-layouts.app>