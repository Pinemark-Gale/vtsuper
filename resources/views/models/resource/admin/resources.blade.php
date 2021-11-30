<x-layouts.app>
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table-filter-admin :createLink="route('admin-resource-create')" />

    <div class="item-table">
        <!-- Define column headers. -->
        <div class="col-title">Resource Name</div>
        <div class="col-title">Type</div>
        <div class="col-title"></div>

        <!-- Generate rest of table. -->
        @foreach ($resources as $resource)
            <div class="main-col row-bottom row-{{ $loop->index }}">
                <a href="{{ route('admin-resource', ['resource' => $resource->name]) }}">{{ $resource->name }}</a>
            </div>
            <div class="side-col row-bottom row-{{ $loop->index }}">{{ $resource->type->type }}</div>
            <div class="expand-col row-bottom row-{{ $loop->index }}">
                <div id="expand-row-{{ $loop->index }}">+</div>
            </div>
            <div class="main-col main-sub-col row-bottom sub-row-{{ $loop->index }} hide-row">{{ $resource->description }}</div>
            <div class="side-col row-bottom sub-row-{{ $loop->index }} hide-row">
                @foreach ($resource->tags->pluck('tag') as $tag)
                    <span>{{ $tag }}</span>
                @endforeach
            </div>
            <div class="row-bottom sub-row-{{ $loop->index }} hide-row"></div>
        @endforeach
    </div>
</x-layouts.app>