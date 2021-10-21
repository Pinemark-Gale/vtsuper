@if (session(config('session.system_message')))
    <div class="system-message">
        Warning: {{ session(config('session.system_message')) }}
    </div>
@endif