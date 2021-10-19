@if (session(config('session.system-message')))
    <div class="system-message">
        Warning: {{ session(config('session.system-message')) }}
    </div>
@endif