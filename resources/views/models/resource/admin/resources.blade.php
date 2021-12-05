<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin :createLink="route('admin-resource-create')" />

    <x-table.table
        caption="List of resources on the website." 
        header1="Resource Name"
        header2="Type"
    >
        <x-slot name="sTableBody">
            @foreach ($resources as $resource)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">
                        <a href="{{ route('admin-resource-edit', ['resource' => $resource->name]) }}">{{ $resource->name }}</a>
                    </th>
                    <td class="second-col">{{ $resource->type->type }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">
                        <h3 class="tag-container-title">Tags</h3>
                        <div class="tag-container">
                            @foreach ($resource->tags->pluck('tag') as $tag)
                                <button class="tag-button" data-message="Get more info on {{ $tag }} resource tag.">
                                    <a href="{{ route('admin-resource-tag', ['resourceTag' => $tag]) }}">{{ $tag }}</a>
                                </button>
                            @endforeach                   
                        </div>
                    </td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                            <a href="{{ route('admin-resource', ['resource' => $resource->name]) }}">
                                <button class="action-button" data-message="Get more info on {{ $resource->name }} resource.">More Info</button>
                            </a>
                            <form method="POST" action="{{ route('admin-resource-destroy', ['resource' => $resource->name]) }}">
                                @csrf
                                @method('DELETE')
                                <button tag="submit" class="action-button delete-button" data-message="Delete {{ $resource->name }} resource.">Delete</button>
                            </form>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-layouts.app>