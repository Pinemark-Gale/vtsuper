@props(['items', 'editItem' => NULL, 'label' => 'Items'])

<script src="{{ asset('js/form-array.js') }}" defer></script>

<!-- section container collection for user to select sections -->
<div class="array-header">Available {{ $label }} </div>
<div id="array-container" class="array-container">
    @foreach ($items as $item)
        @if ( !is_null($editItem) && ($editItem?->tags?->contains('id', $item->id) || $editItem?->sections?->contains('id', $item->id))  )
            <label class="array-item enabled">
                <input type="hidden" name="array[]" value="{{ $item->id }}">
                {{ $item?->tag }} {{ $item?->section }}
            </label>
        @else
            <label class="array-item disabled">
                <input type="hidden" name="array[]" value="{{ $item->id }}" disabled>
                {{ $item?->tag }} {{ $item?->section }}
            </label>
        @endif
    @endforeach
</div>