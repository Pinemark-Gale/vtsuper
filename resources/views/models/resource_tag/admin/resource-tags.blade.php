<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin 
        :searchAction="route('admin-resource-tags-search')" 
        :createLink="route('admin-resource-tag-create')"
    />

    <x-table.table
        caption="List of resource tags on the website." 
        header1="Resource Tag"
        header2="Resources"
    >
        <x-slot name="sTableBody">
            @foreach ($resourceTags as $resourceTag)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">{{ $resourceTag->tag }}</th>
                    <td class="second-col lobster-italic">{{ $resourceTag->resources->count() }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col"><span class="bold">Last Modified:</span> {{ $resourceTag->updated_at->format('M j, Y') }}</td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                        <a href="{{ route('admin-resource-tag-edit', ['resourceTag' => $resourceTag->tag]) }}">
                            <button class="action-button" data-message="Edit details of {{ $resourceTag->tag }} resource tag.">Edit</button>
                        </a>
                        <form method="POST" action="{{ route('admin-resource-tag-destroy', ['resourceTag' => $resourceTag->tag]) }}">
                            @csrf
                            @method('DELETE')
                            <button tag="submit" class="action-button delete-button" data-message="Delete {{ $resourceTag->tag }} resource tag.">Delete</button>
                        </form>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>

</x-layouts.app>