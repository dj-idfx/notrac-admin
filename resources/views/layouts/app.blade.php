<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Notrac') }}</title>
    {{-- Scripts --}}
    @vite('resources/js/app.js')
</head>
<body class="l-body">
<div class="l-app min-vh-100 d-flex flex-column">
    {{-- Navigation --}}
    {{-- todo: verder uitwerken components --}}
    @include('includes.app-navigation')

    {{-- todo: breadcrumbs? (like page heading-> isset) --}}

    {{-- Page Heading --}}
    @if (isset($header))
        <header class="l-header">
            {{ $header }}
        </header>
    @endif

    {{-- Page Content --}}
    <main class="l-main">
        {{ $slot }}
    </main>

    {{-- Page Footer --}}
    <footer class="l-footer bg-dark mt-auto">
        <div class="container text-white text-center py-2">
            FOOTER
        </div>
    </footer>
</div>
</body>
</html>
