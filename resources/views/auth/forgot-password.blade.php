<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-6 text-center w-75 mb-0 mx-auto">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </h1>
        </div>
    </x-slot>

    <x-auth.auth-card>
        {{-- Session Status --}}
        <x-auth.auth-session-status class="mb-3" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Honeypot hidden fields --}}
            <x-honeypot />

            {{-- Email --}}
            <div class="mb-3">
                <x-form.input-label for="email" :value="__('Email')" />
                <x-form.text-input id="email" type="email" name="email" :value="old('email')" required :autofocus="$errors->any() ? false : true" autocomplete="username" />
                <x-form.input-error :errors="$errors->get('email')" />
            </div>

            {{-- Submit --}}
            <div class="d-flex flex-wrap align-items-end justify-content-between">
                <x-form.button class="btn-primary me-3" title="{{ __('Email Password Reset Link') }}" />

                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="link-dark small pt-2">
                        {{ __('Log in') }}
                    </a>
                @endif
            </div>
        </form>
    </x-auth.auth-card>
</x-app-layout>
