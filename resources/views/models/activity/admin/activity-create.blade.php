<x-layouts.app webpageTitle="Admin Panel">

    <x-form.form :action="route('admin-activity-store')">
        <x-form.title>Create Activity</x-form.title>
        <x-form.input name="name" required autofocus />
        <x-form.input name="slug" required />
        <x-form.input name="minutes_to_complete" label="Minutes to Complete" />

        <x-form.label for="resource_id" label="Resource" />
        <select name="resource_id">
            <option value=""></option>
            @foreach ($resources as $resource)
                <option value="{{ $resource->id }}" {{ old('resource_id') == $resource->id ? 'selected' : '' }}>{{ $resource->name }}</option>
            @endforeach
        </select>
        
        <x-form.label for="instructions" />
        <x-form.editor name="instructions" />

        <script src="{{ asset('js/form-activity.js') }}" defer></script>

        <div id="question-container">
            
        </div>
        @foreach($errors->all() as $message)
            {{ $message }}
        @endforeach

        <div class="button-options">
            <button id="button-fitb" type="button">Add Fill in the Blank Question</button>
            <button id="button-mc" type="button">Add Multiple Choice Question</button>
            <button id="button-sa" type="button">Add Short Answer Question</button>
        </div>
        <x-form.button>Create Activity</x-form.button>
    </x-form.form>

</x-layouts.app>