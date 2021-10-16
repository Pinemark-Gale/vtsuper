@props(['name', 'value' => $name, 'type' => 'text', 'label' => $name])

<x-form.label for="{{ $name }}" label="{{ $label }}" />

<input {{ $attributes }}
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ $value == $name ? old('' . $name) : $value }}"
>

<x-form.error name="{{ $name }}" />