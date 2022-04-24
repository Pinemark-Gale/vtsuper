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

        <x-form.form :action="route('submission-create', ['activityDetail' => $activityDetail->slug])">
            @method('patch')
            <x-form.title>Create Submission</x-form.title>

            @foreach ($activityDetail->questions as $index => $question)
                <div class="question-container">
                    <div class="question-header">
                        <h2 class="question-type">QUESTION {{ $loop->iteration }}: {{ $question->type() }}</h2>
                        <x-form.input-hidden name="module[{{ $index }}][type]" value="{{ $question->type() }}" />
                        <div class="question-filler"></div>
                    </div>
                    <x-form.input name="module[{{ $index }}][question]" class="question-prompt-submission" value="{{ $question->question }}" hideLabel="true" label="{{ $question->question }}" readonly />
                    <div class="answer-container">
                        @foreach ($question->answers as $answer)
                            @if ($answer->type->type == "fitb")
                                @foreach ($answer->fitb as $response)
                                    <x-form.input name="module[{{ $index }}][answer]" class="text-response" placeholder="write your answer here" />
                                @endforeach
                            @elseif ($answer->type->type == "mc")
                                @foreach ($answer->mc as $response)
                                    <x-form.radio name="module[{{ $index }}]][answer]" value="{{ $response->placement }} {{ $response->response }}" />
                                @endforeach
                            @elseif ($answer->type->type == "sa")
                                @foreach ($answer->sa as $response)
                                    <x-form.input name="module[{{ $index }}][answer]" class="text-response" placeholder="write your answer here" />
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                    <x-form.button>Submit</x-form.button>
                </div>
            @endforeach
        </x-form.form>
    </div>
</x-layouts.app>