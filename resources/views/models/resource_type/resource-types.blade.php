<x-layouts.app>
<x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <a href="{{ route('resource-type-create') }}" style="display: block; width: 100%;">Create Resource Type</a>
    <br>
    <div class="item-table">
        <!-- Define column headers. -->
        <div class="col-title">Resource Type</div>
        <div class="col-title">Last Updated</div>
        <div class="col-title"></div>
                
        <!-- Generate rest of table. -->
        @foreach ($resourceTypes as $resourceType)
            <div class="main-col row-bottom row-{{ $loop->index }}">
                <a href="{{ route('resource-type', ['resourceType' => $resourceType->type]) }}">{{ $resourceType->type }}</a>
            </div>
            <div class="side-col row-bottom row-{{ $loop->index }}">{{ $resourceType->updated_at->format('M j, Y') }}</div>
            <div class="expand-col row-bottom row-{{ $loop->index }}">
                <div id="expand-row-{{ $loop->index }}">+</div>
            </div>
            <div class="main-col main-sub-col row-bottom sub-row-{{ $loop->index }} hide-row">Created At: {{ $resourceType->created_at }}</div>
            <div class="side-col row-bottom sub-row-{{ $loop->index }} hide-row">
                <a href="{{ route('resource-type-edit', ['resourceType' => $resourceType->type]) }}">
                    <div class="action-button">Edit</div>
                </a>
                <form method="POST" action="{{ route('resource-type-destroy', ['resourceType' => $resourceType->type]) }}">
                    @csrf
                    @method('DELETE')
                    <button tag="submit" class="action-button">Destroy</button>
                </form>
            </div>
            <div class="row-bottom sub-row-{{ $loop->index }} hide-row"></div>
        @endforeach
    </div>
</x-layouts.app>