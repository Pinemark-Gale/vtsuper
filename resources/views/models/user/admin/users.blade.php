<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin />

    <x-table.table
        caption="List of users and associated information." 
        header1="User"
        header2="Privilege"
    >
        <x-slot name="sTableBody">
            @foreach ($users as $user)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">
                        <a href="{{ route('admin-user-edit', ['user' => $user->name]) }}">{{ $user->name }}</a>
                    </th>
                    <td class="second-col">{{ $user->privilege->title }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">
                        <p>Email: {{ $user->email }}</p>
                        <p>School: {{ $user->school->name }}</p>
                    </td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                        <a href="{{ route('admin-user', ['user' => $user->name]) }}">
                            <button class="action-button" data-message="Get more info on {{ $user->name }}.">More Info</button>
                        </a>
                        <form method="POST" action="{{ route('admin-user-destroy', ['user' => $user->name]) }}">
                            @csrf
                            @method('DELETE')
                            <button tag="submit" class="action-button delete-button" data-message="Delete {{ $user->name }}.">Destroy</button>
                        </form>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-layouts.app>