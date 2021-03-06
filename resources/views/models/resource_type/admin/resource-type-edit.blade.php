<x-layouts.app>
    <x-form.form :action="route('admin-resource-type-update', ['resourceType' => $resourceType->type])">
        @method('patch')
        <x-form.title>Edit Resource Type {{ $resourceType->type }}</x-form.title>
        <x-form.input name="type" :value="old('type') ? old('type') : $resourceType->type" required autofocus />
        <x-form.button>Update Resource Type</x-form.button>
    </x-form.form>
</x-layouts.app>