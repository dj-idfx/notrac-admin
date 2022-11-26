<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-2 text-center mb-0">
                <i class="bi bi-house-door"></i> {{ config('app.name', 'Notrac') }}
            </h1>
        </div>
    </x-slot>

    <div class="container py-3 mb-4">
        <h2 class="fs-3 fw-light text-center">
            {{ __('Welcome!') }}
        </h2>

        <div class="row justify-content-center">
            <div class="col text-center">
                <x-svg.brand-logo class="w-100 text-secondary user-select-none" style="max-width: 720px;" />
            </div>
        </div>
    </div>
</x-app-layout>
