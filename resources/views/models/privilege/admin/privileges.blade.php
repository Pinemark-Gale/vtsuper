<x-layouts.app>
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table-filter-admin :createLink="route('admin-privilege-create')" />

    <div class="item-table">
        <!-- Define column headers. -->
        <div class="col-title">Resource Tag</div>
        <div class="col-title">Last Updated</div>
        <div class="col-title"></div>
                
        <!-- Generate rest of table. -->
        @foreach ($privileges as $privilege)
            <div class="main-col row-bottom row-{{ $loop->index }}">
                <a href="{{ route('admin-privilege', ['privilege' => $privilege->title]) }}">{{ $privilege->title }}</a>
            </div>
            <div class="side-col row-bottom row-{{ $loop->index }}">{{ $privilege->updated_at->format('M j, Y') }}</div>
            <div class="expand-col row-bottom row-{{ $loop->index }}">
                <div id="expand-row-{{ $loop->index }}">+</div>
            </div>
            <div class="main-col main-sub-col row-bottom sub-row-{{ $loop->index }} hide-row">Created At: {{ $privilege->created_at->format('M j, Y') }}</div>
            <div class="side-col row-bottom sub-row-{{ $loop->index }} hide-row">
                <a href="{{ route('admin-privilege-edit', ['privilege' => $privilege->title]) }}">
                    <div class="action-button">Edit</div>
                </a>
                <form method="POST" action="{{ route('admin-privilege-destroy', ['privilege' => $privilege->title]) }}">
                    @csrf
                    @method('DELETE')
                    <button tag="submit" class="action-button">Destroy</button>
                </form>
            </div>
            <div class="row-bottom sub-row-{{ $loop->index }} hide-row"></div>
        @endforeach
    </div>
</x-layouts.app>