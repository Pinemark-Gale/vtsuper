<x-layouts.app>
    <div class="card-container">
        @foreach ($users as $user)
                <a href="{{ route('user', ['user' => $user->name]) }}">
                    <div class="user-card">
                        <div class="user-info">{{ $user->privilege->title }}</div>
                        <div class="user-info">{{ $user->name }}</div>
                        <div class="user-info">{{ $user->school->name}}</div>
                        <a href="{{ route('user-edit', ['user' => $user->name]) }}">
                            <div class="user-action">Edit</div>
                        </a>
                        <form method="POST" action="{{ route('user-destroy', ['user' => $user->name]) }}" class="admin-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="form-submit">Destroy</button>
                        </form>
                    </div>
                </a>
        @endforeach
    </div>
</x-layouts.app>