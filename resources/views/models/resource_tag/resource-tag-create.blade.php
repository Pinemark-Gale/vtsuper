<x-layouts.app>
    <x-form.form :action="route('resource-tag-store')">
        <x-form.title>Create Resource Tag</x-form.title>
        <x-form.input name="tag" required autofocus />
        <x-form.button>Create Resource Tag</x-form.button>
    </x-form.form>
</x-layouts.app>