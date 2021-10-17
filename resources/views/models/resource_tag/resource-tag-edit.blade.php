<x-layouts.app>
    <x-form.form :action="route('resource-tag-update', ['resourceTag' => $resourceTag->tag])" >
        @method('patch')
        <x-form.title>Edit Resource Tag {{ $resourceTag->tag }}</x-form.title>
        <x-form.input name="tag" :value="old('tag') ? old('tag') : $resourceTag->tag" autofocus />
        <x-form.button>Update Resource Tag</x-form.button>
    </x-form.form>
</x-layouts.app>