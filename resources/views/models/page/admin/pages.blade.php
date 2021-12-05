<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin :createLink="route('admin-page-create')" />
    
    <x-table.table
        caption="List of static pages across the website ." 
        header1="Page Title"
        header2="Status"
    >
        <x-slot name="sTableBody">
            @foreach ($pages as $page)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">
                        <a href="{{ route('admin-page-edit', ['page' => $page->slug]) }}">{{ $page->title }}</a>
                    </th>
                    <td class="second-col">{{ $page->status->status }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">
                        <p>Published At: {{ $page->created_at->format('M j, Y') }}</p>
                        <p>Last Updated: {{ $page->updated_at->format('M j, Y') }}</p>
                    </td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                            <a href="{{ route('admin-page', ['page' => $page->slug]) }}">
                                <button class="action-button" data-message="Preview {{ $page->title }} page.">Preview</button>
                            </a>
                            <form method="POST" action="{{ route('admin-page-destroy', ['page' => $page->slug]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-button delete-button" data-message="Delete {{ $page->title }} page.">Delete</button>
                            </form>
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-layouts.app>