@props(['for', 'label' => $for, 'class' => ''])

<label class="{{ $class }}" for="{{ $for }}">{{ ucwords($label) }}</label>