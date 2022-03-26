<x-layouts.app>
    <x-form.form :action="route('admin-privilege-update', ['privilege' => $privilege->title])">
        @method('patch')
        <x-form.title>Edit Privilege {{ $privilege->title }}</x-form.title>
        <x-form.input name="title" :value="old('title') ? old('title') : $privilege->title" autofocus />
        <x-form.input name="description" :value="old('description') ? old('description') : $privilege->description" />
        <x-form.button>Update Privilege</x-form.button> 
    </x-form.form>
</x-layouts.app>