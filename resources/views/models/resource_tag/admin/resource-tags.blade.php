<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin :createLink="route('admin-resource-tag-create')" />

    <x-table.table
        caption="List of resource tags on the website." 
        header1="Resource Tag"
        header2="Last Updated"
    >
        <x-slot name="sTableBody">
            @foreach ($resourceTags as $resourceTag)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">
                        <a href="{{ route('admin-resource-tag-edit', ['resourceTag' => $resourceTag->tag]) }}">{{ $resourceTag->tag }}</a>
                    </th>
                    <td class="second-col">{{ $resourceTag->updated_at->format('M j, Y') }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">Created At: {{ $resourceTag->created_at->format('M j, Y') }}</td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                        <a href="{{ route('admin-resource-tag', ['resourceTag' => $resourceTag->tag]) }}">
                            <button class="action-button" data-message="Get more info on {{ $resourceTag->tag }} resource tag.">More Info</button>
                        </a>
                        <form method="POST" action="{{ route('admin-resource-tag-destroy', ['resourceTag' => $resourceTag->tag]) }}">
                            @csrf
                            @method('DELETE')
                            <button tag="submit" class="action-button delete-button" data-message="Delete {{ $resourceTag->tag }} resource tag.">Destroy</button>
                        </form>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>

</x-layouts.app>