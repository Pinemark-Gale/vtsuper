<x-layouts.app>
    <x-form.form action="{{ route('resource-type-store') }}">
        <x-form.title>Create Resource Type</x-form.title>
        <x-form.input name="type" autofocus />
        <x-form.button>Create Resource Type</x-form.button>
    </x-form.form>
</x-layouts.app>