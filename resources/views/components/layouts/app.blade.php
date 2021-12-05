@props(['webpageTitle' => NULL])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'VT-SUPER') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Import other scripts if needed. -->
        {{ $sJavaImport ?? "" }}

        {{-- Fetch links for nav menu's static pages.--}}
        @php
            $appLinks = \App\Models\Page::with(['status', 'sections'])
                ->whereHas('sections', function ($query) {
                    $query->where('section', '=', 'Main Navigation')
                        ->orWhere('section', '=', 'Footer');
                })->whereHas('status', function ($query) {
                    $query->where('status', '=', 'Published');
                })->get();
        @endphp
    </head>
    <body>
        <div class="app-container">
            <x-layouts.top-navigation :appLinks="$appLinks" :webpageTitle="$webpageTitle" />

            <x-system-message />
            <main class="content">
                {{ $slot }}
            </main>

            <x-layouts.footer :appLinks="$appLinks" />
        </div>
    </body>
</html>
