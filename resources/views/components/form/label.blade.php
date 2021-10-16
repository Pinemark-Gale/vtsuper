@props(['for', 'label' => $for])

<label for="{{ $for }}">{{ ucwords($label) }}</label>