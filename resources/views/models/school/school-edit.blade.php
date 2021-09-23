<x-layouts.app>
    <h1>Edit School</h1>
    <form method="POST" action="{{ route('school-update', ['school' => $school->name]) }}" class="admin-form">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $school->name }}" required autofocus>
        <label for="district">District</label>
        <input type="text" name="district" value="{{ $school->district }}" required autofocus>
        <button type="submit" class="form-submit">
            Edit School
        </button>
    </form>
</x-layouts.app>