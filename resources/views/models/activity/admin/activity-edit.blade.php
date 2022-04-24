<x-layouts.app webpageTitle="Admin Panel">

    <x-form.form :action="route('admin-activity-update', ['activityDetail' => $activity->slug])">
        @method('patch')
        <x-form.title>Edit Activity</x-form.title>
        <x-form.input name="name" :value="old('name') ? old('name') : $activity->name" required autofocus />
        <x-form.input name="slug" :value="old('slug') ? old('slug') : $activity->slug" required />
        <x-form.input name="minutes_to_complete" label="Minutes to Complete" :value="old('minutes_to_complete') ? old('minutes_to_complete') : $activity->minutes_to_complete" />
        <x-form.label for="resource_id" label="Resource" />
        <select name="resource_id">
            <option value=""></option>
            @foreach ($resources as $resource)
                <option value="{{ $resource->id }}" {{ old('resource_id') == $resource->id ? 'selected' : ($activity->resource->id == $resource->id ? 'selected' : '') }}>{{ $resource->name }}</option>
            @endforeach
        </select>
        
        <x-form.label for="instructions" />
        <x-form.editor name="instructions" :value="old('instructions') ? old('instructions') : $activity->instructions" />

        <script src="{{ asset('js/form-activity.js') }}" defer></script>

        <div id="question-container">
            @foreach ($activity->questions as $index => $question)
                <label class="activity_question" for="module[{{ $index }}][question]">
                    @if ($question->answers[0]->type->type == "fitb")
                        Fill in the Blank
                    @elseif ($question->answers[0]->type->type == "mc")
                        Multiple Choice
                    @elseif ($question->answers[0]->type->type == "sa")
                        Short Answer
                    @endif
                    <input name="module[{{ $index }}][type]" type="hidden" value="{{ $question->answers[0]->type->type }}">
                    <input name="module[{{ $index }}][question]" type="text" value="{{ $question->question }}" placeholder="question">
                    @foreach ($question->answers as $answer)
                        @if ($answer->type->type == "fitb")
                            @foreach ($answer->fitb as $response)
                                <input name="module[{{ $index }}][answer][]" type="text" placeholder="answer" value="{{ $response->response }}">
                            @endforeach
                        @elseif ($answer->type->type == "mc")
                            @foreach ($answer->mc as $response)
                                <label class="correct_button" for="module[{{ $index}}][correct][]" label="answer correctness">
                                    @if ($response->correct)
                                        Correct<input name="module[{{ $index }}][correct][]" type="hidden" value="1">
                                    @else
                                        Incorrect<input name="module[{{ $index}}][correct][]" type="hidden" value="0">
                                    @endif
                                </label>
                                <input name="module[{{ $index }}][placement][]" type="text" placeholder="placement" value="{{ $response->placement }}" class="placement">
                                <input name="module[{{ $index }}][answer][]" type="text" placeholder="answer" value="{{ $response->response }}">
                            @endforeach
                        @elseif ($answer->type->type == "sa")
                            @foreach ($answer->sa as $response)
                                <input name="module[{{ $index }}][answer][]" type="text" placeholder="answer" value="{{ $response->response }}">
                            @endforeach
                        @endif
                    @endforeach
                    <button class="label_button">Delete Question</button>
                </label>
            @endforeach
        </div>
        @foreach($errors->all() as $message)
            {{ $message }}
        @endforeach

        <div class="button-options">
            <button id="button-fitb" type="button">Add Fill in the Blank Question</button>
            <button id="button-mc" type="button">Add Multiple Choice Question</button>
            <button id="button-sa" type="button">Add Short Answer Question</button>
        </div>
        <x-form.button>Update Activity</x-form.button>
    </x-form.form>

</x-layouts.app>