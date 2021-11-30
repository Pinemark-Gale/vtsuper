<x-layouts.app>
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table-filter-admin :createLink="route('admin-source-create')" />

    <div class="item-table">
        <!-- Define column headers. -->
        <div class="col-title">Source</div>
        <div class="col-title">Last Updated</div>
        <div class="col-title"></div>
                
        <!-- Generate rest of table. -->
        @foreach ($sources as $source)
            <div class="main-col row-bottom row-{{ $loop->index }}">
                <a href="{{ route('admin-source', ['source' => $source->source]) }}">{{ $source->source }}</a>
            </div>
            <div class="side-col row-bottom row-{{ $loop->index }}">{{ $source->updated_at->format('M j, Y') }}</div>
            <div class="expand-col row-bottom row-{{ $loop->index }}">
                <div id="expand-row-{{ $loop->index }}">+</div>
            </div>
            <div class="main-col main-sub-col row-bottom sub-row-{{ $loop->index }} hide-row">Created At: {{ $source->created_at->format('M j, Y') }}</div>
            <div class="side-col row-bottom sub-row-{{ $loop->index }} hide-row">
                <a href="{{ route('admin-source-edit', ['source' => $source->source]) }}">
                    <div class="action-button">Edit</div>
                </a>
                <form method="POST" action="{{ route('admin-source-destroy', ['source' => $source->source]) }}">
                    @csrf
                    @method('DELETE')
                    <button tag="submit" class="action-button">Destroy</button>
                </form>
            </div>
            <div class="row-bottom sub-row-{{ $loop->index }} hide-row"></div>
        @endforeach
    </div>
</x-layouts.app>