<x-layouts.app>
    <x-form.form :action="route('privilege-store')">
        <x-form.title>Create Privilege</x-form.title>
        <x-form.input name="title" autofocus />
        <x-form.button>Create Privilege</x-form.button>
    </x-form.form>
</x-layouts.app>