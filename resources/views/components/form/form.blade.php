@props(['action', 'method' => 'POST'])

<form method="{{ $method }}" action="{{ $action }}" class="admin-form">
    @csrf
    {{ $slot }}
</form>