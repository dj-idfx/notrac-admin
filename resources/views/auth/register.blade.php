<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-2 text-center mb-0">
                {{ __('Register') }}
            </h1>
        </div>
    </x-slot>

    <x-auth.auth-card>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Honeypot hidden fields --}}
            <x-honeypot />

            {{-- Firstname --}}
            <div class="mb-2">
                <x-form.input-label for="first_name" :value="__('First Name')" />
                <x-form.text-input id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus />
                <x-form.input-error :errors="$errors->get('first_name')" />
            </div>

            {{-- Name --}}
            <div class="mb-2">
                <x-form.input-label for="last_name" :value="__('Last Name')" />
                <x-form.text-input id="last_name" type="text" name="last_name" :value="old('last_name')" required />
                <x-form.input-error :errors="$errors->get('last_name')" />
            </div>

            {{-- Email --}}
            <div class="mb-2">
                <x-form.input-label for="email" :value="__('Email')" />
                <x-form.text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
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
                <x-form.button class="btn-primary me-3" title="{{ __('Register') }}" />

                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="link-dark small pt-2">
                        {{ __('Already registered?') }}
                    </a>
                @endif
            </div>
        </form>
    </x-auth.auth-card>
</x-app-layout>
