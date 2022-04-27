@props(['class' => 'form-submit'])

<button type="submit" class="{{ $class }}">
    {{ $slot }}
</button>
