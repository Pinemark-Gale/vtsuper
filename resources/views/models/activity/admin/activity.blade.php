<x-layouts.app webpageTitle="Admin Panel">
    <h1>{{ $activityDetail->name }}</h1>
    <h2>SLUG: {{ $activityDetail->slug }}</h2>
    <h2><a href="{{ $activityDetail->resource->link }}">{{ $activityDetail->resource->name }}</a></h2>
    <p>{{ $activityDetail->resource->description }}</p>
    <h2>Instructions</h2>
    <p>{!! $activityDetail->instructions !!}</p>
    @foreach ($activityDetail->questions as $question)
        <h3>QUESTION: {{ $question->question }}</h3>
        @foreach ($question->answers as $answer)
            <p>TYPE: {{ $answer->type->type }}</p>
            @if ($answer->type->type == "fitb")
                @foreach ($answer->fitb as $response)
                    <p>{{ $response->response }}</p>
                @endforeach
            @elseif ($answer->type->type == "mc")
                @foreach ($answer->mc as $response)
                    <p>{{ $response->placement }}</p>
                    <p>{{ $response->response }}</p>
                @endforeach
            @elseif ($answer->type->type == "sa")
                @foreach ($answer->sa as $response)
                    <p>{{ $response->response }}</p>
                @endforeach
            @endif
        @endforeach
    @endforeach
</x-layouts.app>