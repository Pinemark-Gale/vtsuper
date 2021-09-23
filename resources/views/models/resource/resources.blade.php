<x-layouts.app>
    <a href="{{ route('resource-create') }}" style="display: block; width: 100%;">Create Resource</a>
    <br>
    <div class="item-table">
        <div class="col-title">Resource Name</div>
        <div class="col-title">Type</div>
        <div class="col-title"></div>
        @foreach ($resources as $resource)
            <div class="main-col row-bottom row-{{ $loop->index }}">
                <a href="{{ route('resource', ['resource' => $resource->name]) }}">{{ $resource->name }}</a>
            </div>
            <div class="side-col row-bottom row-{{ $loop->index }}">{{ $resource->type->type }}</div>
            <div class="expand-col row-bottom row-{{ $loop->index }}" onclick="itemTableRowExpand('row-{{ $loop->index }}')">
                <div id="expand-row-{{ $loop->index }}">+</div>
            </div>
            <div class="main-col main-sub-col row-bottom sub-row-{{ $loop->index }} hide-row">{{ $resource->description }}</div>
            <div class="side-col row-bottom sub-row-{{ $loop->index }} hide-row">
                @foreach ($resource->tags->pluck('tag') as $tag)
                    <span>{{ $tag }}</span>
                @endforeach
            </div>
            <div class="row-bottom sub-row-{{ $loop->index }} hide-row"></div>
            <!-- <a href="{{ route('resource-edit', ['resource' => $resource->name]) }}">
                <div class="user-action">Edit</div>
            </a>
            <form method="POST" action="{{ route('resource-destroy', ['resource' => $resource->name]) }}" class="admin-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="form-submit">Destroy</button>
            </form> -->
        @endforeach
    </div>

    <script type="application/javascript">
        function itemTableRowExpand(rowId) {
            var row = document.getElementsByClassName(rowId);
            for (index = 0; index < row.length; index++) {
                row[index].classList.toggle('row-bottom');
            }

            var subRow = document.getElementsByClassName("sub-" + rowId);
            for (index = 0; index < row.length; index++) {
                subRow[index].classList.toggle('hide-row');
            }

            document.getElementById("expand-" + rowId).classList.toggle("active-expand-col");
        }
    </script>
</x-layouts.app>