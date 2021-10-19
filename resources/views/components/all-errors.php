@if ($errors->any())
        <h1>ERRORS:</h1>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
@endif