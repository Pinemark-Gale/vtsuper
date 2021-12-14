@props(['searchAction'])

<div class="table-filter-container">
    <x-table.search :searchAction="$searchAction" />
    <div class="filter-button">
        <div class="filter-button-title">Sort By</div>
        <div class="filter-button-arrow">&#9660</div>
    </div>
</div>