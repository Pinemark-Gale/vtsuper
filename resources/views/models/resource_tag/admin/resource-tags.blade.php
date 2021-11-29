<x-layouts.app>
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <a href="{{ route('admin-resource-tag-create') }}" style="display: block; width: 100%;">Create Resource Tag</a>
    <br>
    <div class="item-table">
        <!-- Define column headers. -->
        <div class="col-title">Resource Tag</div>
        <div class="col-title">Last Updated</div>
        <div class="col-title"></div>
                
        <!-- Generate rest of table. -->
        @foreach ($resourceTags as $resourceTag)
            <div class="main-col row-bottom row-{{ $loop->index }}">
                <a href="{{ route('admin-resource-tag', ['resourceTag' => $resourceTag->tag]) }}">{{ $resourceTag->tag }}</a>
            </div>
            <div class="side-col row-bottom row-{{ $loop->index }}">{{ $resourceTag->updated_at->format('M j, Y') }}</div>
            <div class="expand-col row-bottom row-{{ $loop->index }}">
                <div id="expand-row-{{ $loop->index }}">+</div>
            </div>
            <div class="main-col main-sub-col row-bottom sub-row-{{ $loop->index }} hide-row">Created At: {{ $resourceTag->created_at->format('M j, Y') }}</div>
            <div class="side-col row-bottom sub-row-{{ $loop->index }} hide-row">
                <a href="{{ route('admin-resource-tag-edit', ['resourceTag' => $resourceTag->tag]) }}">
                    <div class="action-button">Edit</div>
                </a>
                <form method="POST" action="{{ route('admin-resource-tag-destroy', ['resourceTag' => $resourceTag->tag]) }}">
                    @csrf
                    @method('DELETE')
                    <button tag="submit" class="action-button">Destroy</button>
                </form>
            </div>
            <div class="row-bottom sub-row-{{ $loop->index }} hide-row"></div>
        @endforeach
    </div>
</x-layouts.app>