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

            {{-- Firstname --}}
            <div class="mb-2">
                <x-form.input-label for="firstname" :value="__('Firstname')" />
                <x-form.text-input id="firstname" type="text" name="firstname" :value="old('firstname')" required autofocus />
                <x-form.input-error :errors="$errors->get('firstname')" />
            </div>

            {{-- Name --}}
            <div class="mb-2">
                <x-form.input-label for="name" :value="__('Name')" />
                <x-form.text-input id="name" type="text" name="name" :value="old('name')" required />
                <x-form.input-error :errors="$errors->get('name')" />
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
                <x-form.button class="btn-primary px-3 me-3" title="{{ __('Register') }}" />

                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="link-dark small pt-2">
                        {{ __('Already registered?') }}
                    </a>
                @endif
            </div>
        </form>
    </x-auth.auth-card>
</x-app-layout>
