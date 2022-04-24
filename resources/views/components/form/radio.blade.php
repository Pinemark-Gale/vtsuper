@props(['name', 'value' => $name, 'label' => $value])

<div class="mc-answer-block">
    <input type="radio" name="{{ $name }}" class="radio" value="{{ $value }}">
    <label for="{{ $name }}">{{ $label }}</label>
</div>
