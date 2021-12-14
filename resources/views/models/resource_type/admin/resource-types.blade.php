<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin 
        :searchAction="route('admin-resource-types-search')" 
        :createLink="route('admin-resource-type-create')"
    />

    <x-table.table
        caption="List of resource types on website." 
        header1="Resource Type"
        header2="Last Updated"
    >
        <x-slot name="sTableBody">
            @foreach ($resourceTypes as $resourceType)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">
                       <a href="{{ route('admin-resource-type-edit', ['resourceType' => $resourceType->type]) }}">{{ $resourceType->type }}</a>
                    </th>
                    <td class="second-col">{{ $resourceType->updated_at->format('M j, Y') }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">Created At: {{ $resourceType->created_at }}</td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                            <a href="{{ route('admin-resource-type', ['resourceType' => $resourceType->type]) }}">
                                <button class="action-button" data-message="Get more info on {{ $resourceType->type }} resource type.">More Info</button>
                            </a>
                            <form method="POST" action="{{ route('admin-resource-type-destroy', ['resourceType' => $resourceType->type]) }}">
                                @csrf
                                @method('DELETE')
                                <button tag="submit" class="action-button delete-button" data-message="Delete {{ $resourceType->type }} resource type.">Destroy</button>
                            </form>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-layouts.app>