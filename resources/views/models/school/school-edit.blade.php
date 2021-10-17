<x-layouts.app>
    <x-form.form :action="route('school-update', ['school' => $school->name])">
        @method('patch')
        <x-form.title>Edit School</x-form.title>
        <x-form.input name="name" :value="old('name') ? old('name') : $school->name" required autofocus />
        <x-form.input name="district" :value="old('district') ? old('district') : $school->district" required />
        <x-form.button>Update School</x-form.button>
    </x-form.form>
</x-layouts.app>