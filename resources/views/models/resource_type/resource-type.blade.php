@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>{{ $resourceType->type }}</h1>
        <h2>Created At: {{ $resourceType->created_at }}</h2>
        <h2>Updated At: {{ $resourceType->updated_at }}</h2>
        <a href="{{ route('resource-type-edit', ['resourceType' => $resourceType->type]) }}">
            <div class="user-action">Edit</div>
        </a>
        <form method="POST" action="{{ route('resource-type-destroy', ['resourceType' => $resourceType->type]) }}" class="admin-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="form-submit">Destroy</button>
        </form>

    </div>
@endsection
