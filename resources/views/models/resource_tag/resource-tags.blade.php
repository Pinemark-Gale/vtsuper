@extends('layouts.app')

@section('content')
<div class="card-container">
        <a href="{{ route('resource-tag-create') }}" style="display: block; width: 100%;">Create Resource Tag</a>
        @foreach ($resourceTags as $resourceTag)
            <a href="{{ route('resource-tag', ['resourceTag' => $resourceTag->tag]) }}">
                <div class="user-card">
                    <div class="user-info">{{ $resourceTag->tag }}</div>
                    <div class="user-info">Updated: {{ $resourceTag->updated_at->format('M j, Y') }}</div>
                </div>
            </a>
        @endforeach
    </div>

@endsection