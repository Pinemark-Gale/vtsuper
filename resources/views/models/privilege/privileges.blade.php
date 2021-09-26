<x-layouts.app>
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <a href="{{ route('privilege-create') }}" style="display: block; width: 100%;">Create Resource Tag</a>
    <br>
    <div class="item-table">
        <!-- Define column headers. -->
        <div class="col-title">Resource Tag</div>
        <div class="col-title">Last Updated</div>
        <div class="col-title"></div>
                
        <!-- Generate rest of table. -->
        @foreach ($privileges as $privilege)
            <div class="main-col row-bottom row-{{ $loop->index }}">
                <a href="{{ route('privilege', ['privilege' => $privilege->title]) }}">{{ $privilege->title }}</a>
            </div>
            <div class="side-col row-bottom row-{{ $loop->index }}">{{ $privilege->updated_at->format('M j, Y') }}</div>
            <div class="expand-col row-bottom row-{{ $loop->index }}">
                <div id="expand-row-{{ $loop->index }}">+</div>
            </div>
            <div class="main-col main-sub-col row-bottom sub-row-{{ $loop->index }} hide-row">Created At: {{ $privilege->created_at->format('M j, Y') }}</div>
            <div class="side-col row-bottom sub-row-{{ $loop->index }} hide-row">
                <a href="{{ route('privilege-edit', ['privilege' => $privilege->title]) }}">
                    <div class="action-button">Edit</div>
                </a>
                <form method="POST" action="{{ route('privilege-destroy', ['privilege' => $privilege->title]) }}">
                    @csrf
                    @method('DELETE')
                    <button tag="submit" class="action-button">Destroy</button>
                </form>
            </div>
            <div class="row-bottom sub-row-{{ $loop->index }} hide-row"></div>
        @endforeach
    </div>

    <div class="card-container">
        <a href="{{ route('privilege-create') }}" style="display: block; width: 100%;">Create Privilege</a>
        @foreach ($privileges as $privilege)
            <a href="{{ route('privilege', ['privilege' => $privilege->title]) }}">
                <div class="user-card">
                    <div class="user-info">{{ $privilege->title }}</div>
                    <div class="user-info">Updated: {{ $privilege->updated_at->format('M j, Y') }}</div>
                </div>
            </a>
        @endforeach
    </div>
</x-layouts.app>