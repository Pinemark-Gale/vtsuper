<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin 
        :searchAction="route('admin-schools-search')" 
        :createLink="route('admin-school-create')"
    />

    <x-table.table
        caption="List of all schools belonging to users." 
        header1="School Name"
        header2="District"
    >
        <x-slot name="sTableBody">
            @foreach ($schools as $school)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">
                        {{ $school->name }}
                    </th>
                    <td class="second-col lobster-italic">{{ $school->district }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">
                        <p><span class="bold">Total Enrolled:</span> {{ $school->user->count() }}</p>
                        <p><span class="bold">Last Modified At:</span> {{ $school->updated_at->format('M j, Y') }}</p>
                    </td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                        <a href="{{ route('admin-school-edit', ['school' => $school->name]) }}">
                            <button class="action-button" data-message="Edit details of {{ $school->name }}.">Edit</button>
                        </a>
                        <form method="POST" action="{{ route('admin-school-destroy', ['school' => $school->name]) }}">
                            @csrf
                            @method('DELETE')
                            <button tag="submit" class="action-button delete-button" data-message="Delete {{ $school->name }}.">Delete</button>
                        </form>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-layouts.app>