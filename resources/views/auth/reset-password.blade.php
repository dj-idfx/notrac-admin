<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-2 text-center mb-0">
                {{ __('Reset Password') }}
            </h1>
        </div>
    </x-slot>

    <x-auth.auth-card>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            {{-- Honeypot hidden fields --}}
            <x-honeypot />

            {{-- Password Reset Token --}}
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- Email --}}
            <div class="mb-3">
                <x-form.input-label for="email" :value="__('Email')" />
                <x-form.text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-form.input-error :errors="$errors->get('email')" />
            </div>

            {{-- Password --}}
            <div class="mb-2">
                <x-form.input-label for="password" :value="__('Password')" />
                <x-form.text-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-form.input-error :errors="$errors->get('password')" />
            </div>

            {{-- Confirm Password --}}
            <div class="mb-3">
                <x-form.input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-form.text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="" />
                <x-form.input-error :errors="$errors->get('password_confirmation')" />
            </div>

            {{-- Submit --}}
            <div class="d-flex flex-wrap align-items-end justify-content-between">
                <x-form.button class="btn-primary me-3" title="{{ __('Reset Password') }}" />
            </div>
        </form>
    </x-auth.auth-card>
</x-app-layout>
