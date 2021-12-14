@props(['caption', 'header1', 'header2'])

<table class="general-table">
    <caption>{{ $caption }}</caption>

    <thead>
        <th scope="col" class="first-col">{{ $header1 }}</th>
        <th scope="col" class="second-col">{{ $header2 }}</th>
        <th scope="col" class="expand-col">Expand</th>
    </thead>
    <tbody class="table-body">
        {{ $sTableBody }}
    </tbody>
</table>