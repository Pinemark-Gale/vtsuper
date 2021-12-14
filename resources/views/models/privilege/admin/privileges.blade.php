<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin 
        :searchAction="route('admin-privileges-search')" 
        :createLink="route('admin-privilege-create')"
    />

    <x-table.table
        caption="List of the different types of privileges." 
        header1="Privilege Title"
        header2="Last Updated"
    >
        <x-slot name="sTableBody">
            @foreach ($privileges as $privilege)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">
                        <a href="{{ route('admin-privilege-edit', ['privilege' => $privilege->title]) }}">{{ $privilege->title }}</a>
                    </th>
                    <td class="second-col">{{ $privilege->updated_at->format('M j, Y') }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">Created At: {{ $privilege->created_at->format('M j, Y') }}</td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                            <a href="{{ route('admin-privilege', ['privilege' => $privilege->title]) }}">
                                <button class="action-button" data-message="Get more info on {{ $privilege->title }} privilege.">More Info</button>
                            </a>
                            <form method="POST" action="{{ route('admin-privilege-destroy', ['privilege' => $privilege->title]) }}">
                                @csrf
                                @method('DELETE')
                                <button tag="submit" class="action-button delete-button" data-message="Delete {{ $privilege->title }} privilege.">Destroy</button>
                            </form>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-layouts.app>