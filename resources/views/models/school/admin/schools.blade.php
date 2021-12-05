<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin :createLink="route('admin-school-create')" />

    <x-table.table
        caption="List of all schools belonging to users." 
        header1="School Name"
        header2="District"
    >
        <x-slot name="sTableBody">
            @foreach ($schools as $school)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">
                        <a href="{{ route('admin-school-edit', ['school' => $school->name]) }}">{{ $school->name }}</a>
                    </th>
                    <td class="second-col">{{ $school->district }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">
                        <p>Updated At: {{ $school->updated_at->format('M j, Y') }}</p>
                        <p>Created At: {{ $school->created_at->format('M j, Y') }}</p>
                    </td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                        <a href="{{ route('admin-school', ['school' => $school->name]) }}">
                            <button class="action-button" data-message="Get more info on {{ $school->name }}.">More Info</button>
                        </a>
                        <form method="POST" action="{{ route('admin-school-destroy', ['school' => $school->name]) }}">
                            @csrf
                            @method('DELETE')
                            <button tag="submit" class="action-button delete-button" data-message="Delete {{ $school->name }}.">Destroy</button>
                        </form>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-layouts.app>