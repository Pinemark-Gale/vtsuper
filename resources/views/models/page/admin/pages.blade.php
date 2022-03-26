<x-layouts.app webpageTitle="Admin Panel">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter-admin 
        :searchAction="route('admin-pages-search')" 
        :createLink="route('admin-page-create')"
    />
    
    <x-table.table
        caption="List of static pages across the website ." 
        header1="Page Title"
        header2="Status"
    >
        <x-slot name="sTableBody">
            @foreach ($pages as $page)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">{{ $page->title }}</th>
                    <td class="second-col lobster-italic">{{ $page->status->status }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">
                        <p><span class="bold">Author:</span> {{ $page->author->name }}</p>
                        <p><span class="bold">Last Modified:</span> {{ $page->updated_at->format('M j, Y') }}</p>
                    </td>
                    <td class="second-col">
                        <h3 class="action-container-title">Actions</h3>
                        <div class="action-container">
                            <a href="{{ route('admin-page', ['page' => $page->slug]) }}">
                                <button class="action-button" data-message="Preview {{ $page->title }} page.">Preview</button>
                            </a>
                            <a href="{{ route('admin-page-edit', ['page' => $page->slug]) }}">
                                <button class="action-button" data-message="Edit details of  {{ $page->title }} page.">Edit</button>
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