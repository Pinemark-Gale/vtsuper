<x-layouts.app webpageTitle="Submissions">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter 
        :searchAction="route('submissions-search')" 
    />

    <x-table.table
        caption="List of submissions this user has submitted." 
        header1="Activity Name"
        header2="Submitted At"
    >
        <x-slot name="sTableBody">
            @foreach ($submissions as $submission)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">{{ $submission->activity->name }}</th>
                    <td class="second-col lobster-italic">{{ $submission->updated_at->format('M j, Y g:iA') }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">
                        <p><span class="bold">Questions:</span> {{ $submission->questions->count() }}</p>
                    </td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                            <a href="{{ route('submission', ['submission' => $submission->id]) }}">
                                <button class="action-button" data-message="See a preview of {{ $submission->activity->name }} submission created on {{ $submission->updated_at->format('M j, Y') }}.">Review</button>
                            </a>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-layouts.app>