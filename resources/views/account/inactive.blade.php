<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-2 text-center mb-0">
                {{ __('Account is inactive') }}
            </h1>
        </div>
    </x-slot>

    <x-auth.auth-card>
        {{ __('Please contact us for more information.') }}
    </x-auth.auth-card>
</x-app-layout>
