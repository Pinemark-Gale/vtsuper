<x-layouts.app>
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <a href="{{ route('admin-page-create') }}" style="display: block; width: 100%;">Create Page</a>
    <br>
    <x-search />
    <br>
    <div class="item-table">
        <!-- Define column headers. -->
        <div class="col-title">Page Title</div>
        <div class="col-title">Status</div>
        <div class="col-title"></div>

        <!-- Generate rest of table. -->
        @foreach ($pages as $page)
            <div class="main-col row-bottom row-{{ $loop->index }}">
                <a href="{{ route('admin-page', ['page' => $page->slug]) }}">{{ $page->title }}</a>
            </div>
            <div class="side-col row-bottom row-{{ $loop->index }}">{{ $page->status->status }}</div>
            <div class="expand-col row-bottom row-{{ $loop->index }}">
                <div id="expand-row-{{ $loop->index }}">+</div>
            </div>
            <div class="main-col main-sub-col row-bottom sub-row-{{ $loop->index }} hide-row">
                <p>Published At: {{ $page->created_at->format('M j, Y') }}</p>
                <p>Last Updated: {{ $page->updated_at->format('M j, Y') }}</p>

            </div>
            <div class="side-col row-bottom sub-row-{{ $loop->index }} hide-row">
                <a href="{{ route('admin-page-edit', ['page' => $page->slug]) }}">
                    <div class="action-button">Edit</div>
                </a>
                <form method="POST" action="{{ route('admin-page-destroy', ['page' => $page->slug]) }}">
                    @csrf
                    @method('DELETE')
                    <button tag="submit" class="action-button">Destroy</button>
                </form>
            </div>
            <div class="row-bottom sub-row-{{ $loop->index }} hide-row"></div>
        @endforeach
    </div>
</x-layouts.app>