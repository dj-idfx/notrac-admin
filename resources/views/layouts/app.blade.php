<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <meta name="description" content="Notrac Admin is a CMS starter template created with Laravel 9 and Bootstrap 5.">
    <title>{{ config('app.name', 'Notrac') }}</title>
    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::favicon('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::favicon('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::favicon('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ Vite::favicon('site.webmanifest') }}">
    {{-- Scripts --}}
    @vite('resources/js/app.js')
</head>
<body class="l-body">
<div class="l-app min-vh-100 d-flex flex-column">
    {{-- Navigation --}}
    @include('includes.app-navigation')

    {{-- todo: breadcrumbs? (like page heading-> isset) --}}

    {{-- View header --}}
    @if (isset($header))@include('includes.app-header')@endif

    {{-- View content --}}
    <main class="l-main">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    @include('includes.app-footer')
</div>
</body>
</html>
