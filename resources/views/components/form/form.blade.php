@props(['action', 'method' => 'POST', 'class' => 'admin-form'])

<form method="{{ $method }}" action="{{ $action }}" class="{{ $class }}}">
    @csrf
    {{ $slot }}
</form>