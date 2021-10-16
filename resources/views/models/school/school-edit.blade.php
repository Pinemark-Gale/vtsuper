<x-layouts.app>
    <x-form.form action="{{ route('school-update', ['school' => $school->name]) }}">
        <x-form.title>Edit School</x-form.title>
        <x-form.input name="name" value="{{ old('name') ? old('name') : $school->name }}" autofocus />
        <x-form.input name="district" value="{{ old('district') ? old('district') : $school->district }}" />
        <x-form.button>Update School</x-form.button>
    </x-form.form>
</x-layouts.app>