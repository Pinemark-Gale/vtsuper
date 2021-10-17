<x-layouts.app>
    <x-form.form :action="route('source-store')">
        <x-form.title>Create Source</x-form.title>
        <x-form.input name="source" required autofocus />
        <x-form.button>Create Source</x-form.button>
    </x-form.form>
</x-layouts.app>