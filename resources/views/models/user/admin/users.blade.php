<x-layouts.app>
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>
    <x-table-filter-admin />

    <div class="item-table">
        <!-- Define column headers. -->
        <div class="col-title">User</div>
        <div class="col-title">Privilege</div>
        <div class="col-title"></div>

        <!-- Generate rest of table. -->
        @foreach ($users as $user)
            <div class="main-col row-bottom row-{{ $loop->index }}">
                <a href="{{ route('admin-user', ['user' => $user->name]) }}">{{ $user->name }}</a>
            </div>
            <div class="side-col row-bottom row-{{ $loop->index }}">{{ $user->privilege->title }}</div>
            <div class="expand-col row-bottom row-{{ $loop->index }}">
                <div id="expand-row-{{ $loop->index }}">+</div>
            </div>
            <div class="main-col main-sub-col row-bottom sub-row-{{ $loop->index }} hide-row">
                <p>Email: {{ $user->email }}</p>
                <p>School: {{ $user->school->name }}</p>
            </div>
            <div class="side-col row-bottom sub-row-{{ $loop->index }} hide-row">
                <a href="{{ route('admin-user-edit', ['user' => $user->name]) }}">
                    <div class="action-button">Edit</div>
                </a>
                <form method="POST" action="{{ route('admin-user-destroy', ['user' => $user->name]) }}">
                    @csrf
                    @method('DELETE')
                    <button tag="submit" class="action-button">Destroy</button>
                </form>
            </div>
            <div class="row-bottom sub-row-{{ $loop->index }} hide-row"></div>
        @endforeach
    </div>
</x-layouts.app>