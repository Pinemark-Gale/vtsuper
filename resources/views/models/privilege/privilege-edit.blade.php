<x-layouts.app>
    <h1>Edit Privilege {{ $privilege->title }}</h1>
    <form method="POST" action="{{ route('privilege-update', ['privilege' => $privilege->title]) }}" class="admin-form">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ $privilege->title }}" required autofocus>
        <button type="submit" class="form-submit">
            Update Privilege Title
        </button>
    </form>
</x-layouts.app>