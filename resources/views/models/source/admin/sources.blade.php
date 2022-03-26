<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin 
        :searchAction="route('admin-sources-search')" 
        :createLink="route('admin-source-create')"
    />

    <x-table.table
        caption="List of the different source for resources." 
        header1="Source"
        header2="Resources"
    >
        <x-slot name="sTableBody">
            @foreach ($sources as $source)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">
                        <a href="">{{ $source->source }}</a>
                    </th>
                    <td class="second-col lobster-italic">{{ $source->resources->count() }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col"><span class="bold">Last Modified:</span> {{ $source->updated_at->format('M j, Y') }}</td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                        <a href="{{ route('admin-source-edit', ['source' => $source->source]) }}">
                            <button class="action-button" data-message="Edit details of {{ $source->source }} source.">Edit</button>
                        </a>
                        <form method="POST" action="{{ route('admin-source-destroy', ['source' => $source->source]) }}">
                            @csrf
                            @method('DELETE')
                            <button tag="submit" class="action-button delete-button" data-message="Delete {{ $source->source }} source.">Delete</button>
                        </form>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-layouts.app>