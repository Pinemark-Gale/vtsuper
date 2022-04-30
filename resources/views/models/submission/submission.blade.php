<x-layouts.app webpageTitle="Activity">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>
    <div class="activity-container">
        <h1 class="activity-title">{{ $submission->activity->name }}</h1>
        <p>First up, look at the resource below!</p>

        <x-table.table
            caption="Resource associated with activity." 
            header1="Resource Name"
            header2="Type"
        >
            <x-slot name="sTableBody">
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">{{ $submission->activity->resource->name }}</th>
                    <td class="second-col lobster-italic">{{ $submission->activity->resource->type->type }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">
                        <p><span class="bold">Description:</span> {{ $submission->activity->resource->description }}</p>
                        <a class="goto-resource" href="{{ $submission->activity->resource->link }}">Check out this resource</a>
                    </td>
                    <td class="second-col">
                        <h3 class="action-container-title">Tags</h3>
                        <div class="tag-container">
                            @foreach ($submission->activity->resource->tags->pluck('tag') as $tag)
                                <span class="tag-button">{{ $tag }}</span>
                            @endforeach                   
                        </div>    
                    </td>
                    <td></td>
                </tr>
            </x-slot>
        </x-table.table>

        <p class="instructions">{!! $submission->activity->instructions !!}</p>
        @foreach ($submission->questions as $question)
            <div class="question-container">
                <div class="question-header">
                    <h2 class="question-type">QUESTION {{ $loop->iteration }}: {{ $question->type() }}</h2>
                    <div class="question-filler"></div>
                </div>
                <div class="question-prompt">{{ $question->question }}</div>
                <div class="answer-container">
                    <h2>Response:</h2>
                    @if ($question->type == "fitb")
                        @foreach ($question->fitb as $response)
                            <p class="text-response">{{ $response->response }}</p>
                        @endforeach
                    @elseif ($question->type == "mc")
                        @foreach ($question->mc as $response)
                            @if ($response->selected)
                                <p class="selected">{{ $response->placement }} {{ $response->response }}</p>
                            @elseif ($response->correct)
                                <p class="correct">{{ $response->placement }} {{ $response->response }}</p>
                            @else
                                <p>{{ $response->placement }} {{ $response->response }}</p>
                            @endif
                        @endforeach
                    @elseif ($question->type == "sa")
                        @foreach ($question->sa as $response)
                            <p class="text-response">{{ $response->response }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach

    </div>
</x-layouts.app>