<x-layouts.app>
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>

    <a href="{{ route('school-create') }}" style="display: block; width: 100%;">Create School</a>
    <br>
    <div class="item-table">
        <!-- Define column headers. -->
        <div class="col-title">School</div>
        <div class="col-title">District</div>
        <div class="col-title"></div>
                
        <!-- Generate rest of table. -->
        @foreach ($schools as $school)
            <div class="main-col row-bottom row-{{ $loop->index }}">
                <a href="{{ route('school', ['school' => $school->name]) }}">{{ $school->name }}</a>
            </div>
            <div class="side-col row-bottom row-{{ $loop->index }}">{{ $school->district }}</div>
            <div class="expand-col row-bottom row-{{ $loop->index }}">
                <div id="expand-row-{{ $loop->index }}">+</div>
            </div>
            <div class="main-col main-sub-col row-bottom sub-row-{{ $loop->index }} hide-row">
                <p>Updated At: {{ $school->updated_at->format('M j, Y') }}</p>
                <p>Created At: {{ $school->created_at->format('M j, Y') }}</p>
            </div>
            <div class="side-col row-bottom sub-row-{{ $loop->index }} hide-row">
                <a href="{{ route('school-edit', ['school' => $school->name]) }}">
                    <div class="action-button">Edit</div>
                </a>
                <form method="POST" action="{{ route('school-destroy', ['school' => $school->name]) }}">
                    @csrf
                    @method('DELETE')
                    <button tag="submit" class="action-button">Destroy</button>
                </form>
            </div>
            <div class="row-bottom sub-row-{{ $loop->index }} hide-row"></div>
        @endforeach
    </div>
</x-layouts.app>