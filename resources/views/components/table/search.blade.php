@props(['searchAction'])

<div class="search-bar">
    <x-form.form method="GET" :action="$searchAction" class="">
        <button type="submit" data-message="Search by search term input.">    
            <x-svg.search-icon />
        </button>
        <label for="search_term" class="hidden">Search term</label>
        <input name="search_term" type="text" class="search-bar-input" placeholder="SEARCH">
    </x-form.form>    
</div>