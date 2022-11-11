<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-2 text-center mb-0">
                {{ config('app.name', 'Notrac') }}
            </h1>
        </div>
    </x-slot>

    <div class="container py-3 text-center">
        <h2 class="fs-3">
            {{ __('Oops, page is not found') }}
            <br>
            <small class="fw-lighter">404</small>
        </h2>

        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
            {{ __('Go to homepage') }}
        </a>
    </div>
</x-app-layout>
