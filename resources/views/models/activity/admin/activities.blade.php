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
        header2="Minutes to Complete"
    >
        <x-slot name="sTableBody">
            @foreach ($activities as $activity)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">{{ $activity->name }}</th>
                    <td class="second-col lobster-italic">{{ $activity->minutes_to_complete }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">
                        <p><span class="bold">Author:</span> {{ $activity->author->name }}</p>
                        <p><span class="bold">Resource:</span> {{ $activity->resource->name }}</p>
                        <p><span class="bold">Questions:</span> {{ $activity->questions->count() }}</p>
                        <p><span class="bold">Slug:</span> {{ $activity->slug }}</p>
                    </td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                            <a href="{{ route('admin-activity', ['activityDetail' => $activity->slug]) }}">
                                <button class="action-button" data-message="See a preview of {{ $activity->name }} activity.">Preview</button>
                            </a>
                            <a href="{{ route('admin-activity-edit', ['activityDetail' => $activity->slug]) }}">
                                <button class="action-button" data-message="Edit details of {{ $activity->name }} activity.">Edit</button>
                            </a>
                            <form method="POST" action="{{ route('admin-activity-destroy', ['activityDetail' => $activity->slug]) }}">
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