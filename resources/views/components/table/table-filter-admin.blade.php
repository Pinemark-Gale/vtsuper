@props(['searchAction', 'createLink' => '#'])

<x-table.admin-panel-header />

<div class="table-filter-container">
    <x-table.search :searchAction="$searchAction" />
    <a href="{{ $createLink }}" class="filter-link">Create</a>
</div>