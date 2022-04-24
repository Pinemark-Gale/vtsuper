@props([
    'name', 
    'value' => $name, 
    'type' => 'text', 
    'label' => $name, 
    'hideLabel' => 'false',
    'removeLabel' => 'false'
])

@if ($removeLabel == 'false')
    @if ($hideLabel == 'false')
        <x-form.label for="{{ $name }}" label="{{ $label }}" />
    @else
        <x-form.label for="{{ $name }}" label="{{ $label }}" class="hidden" />
    @endif
@endif

<input {{ $attributes }}
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ $value == $name ? old('' . $name) : $value }}"
>

<x-form.error name="{{ $name }}" />