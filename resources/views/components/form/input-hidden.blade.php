@props(['name', 'value' => $name, 'type' => 'text'])

<input {{ $attributes }}
    type="hidden"
    name="{{ $name }}"
    value="{{ $value == $name ? old('' . $name) : $value }}"
>

<x-form.error name="{{ $name }}" />