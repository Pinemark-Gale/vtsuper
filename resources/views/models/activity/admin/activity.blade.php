<x-layouts.app webpageTitle="Admin Panel">
    <h1>{{ $activityDetail->name }} - {{ $activityDetail->id }}</h1>
    <h2><a href="{{ $activityDetail->resource->link }}">{{ $activityDetail->resource->name }}</a></h2>
    <p>{{ $activityDetail->resource->description }}</p>
    <h2>Instructions</h2>
    <p>{!! $activityDetail->instructions !!}</p>
    {{ $activityDetail->questions }}
</x-layouts.app>