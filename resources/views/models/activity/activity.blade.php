<x-layouts.app webpageTitle="Activity">
    <x-slot name="sJavaImport">
        <script src="{{ asset('js/tables.js') }}" defer></script>
    </x-slot>
    <div class="activity-container">
        <h1 class="activity-title">{{ $activityDetail->name }}</h1>
        <p>First up, look at the resource below!</p>

        <x-table.table
            caption="Resource associated with activity." 
            header1="Resource Name"
            header2="Type"
        >
            <x-slot name="sTableBody">
                <tr class="base-row bottom-border">
                    <th class="first-col" scope="row">{{ $activityDetail->resource->name }}</th>
                    <td class="second-col lobster-italic">{{ $activityDetail->resource->type->type }}</td>
                    <td class="expand-col">
                        <button class="expand-button" data-message="Expand this row.">+</button>
                    </td>
                </tr>
                <tr class="hidden bottom-border">
                    <td class="first-col">
                        <p><span class="bold">Description:</span> {{ $activityDetail->resource->description }}</p>
                        <a class="goto-resource" href="{{ $activityDetail->resource->link }}">Check out this resource</a>
                    </td>
                    <td class="second-col">
                        <h3 class="action-container-title">Tags</h3>
                        <div class="tag-container">
                            @foreach ($activityDetail->resource->tags->pluck('tag') as $tag)
                                <span class="tag-button">{{ $tag }}</span>
                            @endforeach                   
                        </div>    
                    </td>
                    <td></td>
                </tr>
            </x-slot>
        </x-table.table>

        <p class="instructions">{!! $activityDetail->instructions !!}</p>

        @foreach ($activityDetail->questions as $question)
            <div class="question-container">
                <div class="question-header">
                    <h2 class="question-type">QUESTION {{ $loop->iteration }}: {{ $question->type() }}</h2>
                    <div class="question-filler"></div>
                </div>
                <div class="question-prompt">{{ $question->question }}</div>
                <div class="answer-container">
                    <h2>Expected Response(s):</h2>
                    @foreach ($question->answers as $answer)
                        @if ($answer->type->type == "fitb")
                            @foreach ($answer->fitb as $response)
                                <p class="text-response">{{ $response->response }}</p>
                            @endforeach
                        @elseif ($answer->type->type == "mc")
                            @foreach ($answer->mc as $response)
                                @if ($response->correct)
                                    <p class="correct">{{ $response->placement }} {{ $response->response }}</p>
                                @else
                                    <p>{{ $response->placement }} {{ $response->response }}</p>
                                @endif
                            @endforeach
                        @elseif ($answer->type->type == "sa")
                            @foreach ($answer->sa as $response)
                                <p class="text-response">{{ $response->response }}</p>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-layouts.app>