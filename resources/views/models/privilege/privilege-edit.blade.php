<x-layouts.app>
    <x-form.form :action="route('privilege-update', ['privilege' => $privilege->title])">
        @method('patch')
        <x-form.title>Edit Privilege {{ $privilege->title }}</x-form.title>
        <x-form.input name="title" :value="old('title') ? old('title') : $privilege->title" autofocus />
        <x-form.button>Update Privilege</x-form.button> 
    </x-form.form>
</x-layouts.app>