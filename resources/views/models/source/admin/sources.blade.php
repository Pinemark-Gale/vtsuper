<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin :createLink="route('admin-source-create')" />

    <x-table.table
        caption="List of the different source for resources." 
        header1="Source"
        header2="Last Updated"
    >
        <x-slot name="sTableBody">
            @foreach ($sources as $source)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">
                        <a href="{{ route('admin-source-edit', ['source' => $source->source]) }}">{{ $source->source }}</a>
                    </th>
                    <td class="second-col">{{ $source->updated_at->format('M j, Y') }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">Created At: {{ $source->created_at->format('M j, Y') }}</td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                        <a href="{{ route('admin-source', ['source' => $source->source]) }}">
                            <button class="action-button" data-message="Get more info on {{ $source->source }} source.">More Info</button>
                        </a>
                        <form method="POST" action="{{ route('admin-source-destroy', ['source' => $source->source]) }}">
                            @csrf
                            @method('DELETE')
                            <button tag="submit" class="action-button delete-button" data-message="Delete {{ $source->source }} source.">Destroy</button>
                        </form>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-layouts.app>