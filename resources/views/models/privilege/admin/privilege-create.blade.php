<x-layouts.app>
    <x-form.form :action="route('admin-privilege-store')">
        <x-form.title>Create Privilege</x-form.title>
        <x-form.input name="title" autofocus />
        <x-form.input name="description" />
        <x-form.button>Create Privilege</x-form.button>
    </x-form.form>
</x-layouts.app>