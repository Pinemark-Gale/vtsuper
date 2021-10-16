@props(['name'])

<div class="errors">
    @error($name)
        {{ $message }}
    @enderror
</div>