<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="none">
    <meta name="description" content="Notrac Admin is a CMS starter template created with Laravel 9 and Bootstrap 5.">
    <title>CMS | {{ config('app.name', 'Notrac') }}</title>
    {{-- Scripts --}}
    @vite('resources/js/cms.js')
    @stack('scripts-head')
</head>
<body class="cms-body">
<div class="cms-app">
    {{-- Sidebar --}}
    @include('includes.cms-sidebar')

    <div class="cms-page">
        {{-- Navigation --}}
        @include('includes.cms-navigation')

        {{-- View header --}}
        @if (isset($header)) @include('includes.cms-header') @endif

        {{-- View action buttons --}}
        @if (isset($actionButtons)) @include('includes.cms-action-buttons') @endif

        {{-- View content --}}
        <main class="cms-main container-lg">
            {{ $slot }}
        </main>

        {{-- Session flash messages --}}
        @if(Session::has('flash_message')) @include('includes.cms-flash-message') @endif
    </div>
</div>
@stack('scripts-bottom')
</body>
</html>
