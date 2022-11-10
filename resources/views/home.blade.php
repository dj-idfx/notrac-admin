<x-app-layout>
    <x-slot name="header">
        <div class="container py-4">
            <h1 class="text-center mb-0">
                {{ config('app.name', 'Notrac') }}
            </h1>
        </div>
    </x-slot>

    <hr>

    <div class="container py-4">
        <h2 class="text-center mb-0">
            {{ __('Welcome!') }}
        </h2>
    </div>
</x-app-layout>
