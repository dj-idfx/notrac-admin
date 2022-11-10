<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-2 text-center mb-0">
                {{ config('app.name', 'Notrac') }}
            </h1>
        </div>
    </x-slot>

    <div class="container py-3">
        <h2 class="fs-3 text-center mb-0">
            {{ __('Welcome!') }}
        </h2>
    </div>
</x-app-layout>
