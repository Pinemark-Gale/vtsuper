<x-layouts.app>
    <x-form.form :action="route('school-store')">
        <x-form.title>Create School</x-form.title>
        <x-form.input name="name" required autofocus />
        <x-form.input name="district" required />
        <x-form.button>Create School</x-form.button>
    </x-form.form>
</x-layouts.app>
