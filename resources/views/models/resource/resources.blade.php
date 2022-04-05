<x-layouts.app webpageTitle="Resources">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <x-table.table-filter 
        :searchAction="route('resources-search')" 
    />

    <x-table.table
        caption="List of resources on the website." 
        header1="Resource Name"
        header2="Type"
    >
        <x-slot name="sTableBody">
            @foreach ($resources as $resource)
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">{{ $resource->name }}</th>
                    <td class="second-col lobster-italic">{{ $resource->type->type }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">
                        <p><span class="bold">Description:</span> {{ $resource->description }}</p>
                        <a class="goto-resource" href="{{ $resource->link }}">Check out this resource</a>
                    </td>
                    <td class="second-col">
                        <h3 class="action-container-title">Tags</h3>
                        <div class="tag-container">
                            @foreach ($resource->tags->pluck('tag') as $tag)
                                <span class="tag-button">{{ $tag }}</span>
                            @endforeach                   
                        </div>    
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-layouts.app>