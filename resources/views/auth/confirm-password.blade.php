<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-6 text-center w-75 mb-0 mx-auto">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </h1>
        </div>
    </x-slot>

    <x-auth.auth-card>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            {{-- Honeypot hidden fields --}}
            <x-honeypot />

            {{-- Password --}}
            <div class="mb-3">
                <x-form.input-label for="password" :value="__('Password')" />
                <x-form.text-input id="password" type="password" name="password" required :autofocus="$errors->any() ? false : true" />
                <x-form.input-error :errors="$errors->get('password')" />
            </div>

            {{-- Submit --}}
            <div class="d-flex flex-wrap align-items-end justify-content-between">
                <x-form.button class="btn-primary me-3" title="{{ __('Confirm') }}" />
            </div>
        </form>
    </x-auth.auth-card>
</x-app-layout>
