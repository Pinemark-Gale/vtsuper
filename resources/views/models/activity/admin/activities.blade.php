<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin 
        :searchAction="route('admin-activities-search')" 
        :createLink="route('admin-activity-create')"
    />

    <x-table.table
        caption="List of activities on the website." 
        header1="Activity Name"
        header2="Type"
    >
        <x-slot name="sTableBody">
            @foreach ($activities as $activity)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">
                        <a href="{{ route('admin-activity-edit', ['activityDetail' => $activity->name]) }}">{{ $activity->name }}</a>
                    </th>
                    <td class="second-col">{{ $activity->name }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">{{ $activity->instructions }}</td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                            <a href="{{ route('admin-activity', ['activityDetail' => $activity->name]) }}">
                                <button class="action-button" data-message="Get more info on {{ $activity->name }} activity.">More Info</button>
                            </a>
                            <form method="POST" action="{{ route('admin-activity-destroy', ['activityDetail' => $activity->name]) }}">
                                @csrf
                                @method('DELETE')
                                <button tag="submit" class="action-button delete-button" data-message="Delete {{ $activity->name }} activity.">Delete</button>
                            </form>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-layouts.app>