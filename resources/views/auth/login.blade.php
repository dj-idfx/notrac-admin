<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-2 text-center mb-0">
                {{ __('Log In') }}
            </h1>
        </div>
    </x-slot>

    <x-auth.auth-card>
        {{-- Session Status --}}
        <x-auth.auth-session-status class="mb-3" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <x-form.input-label for="email" :value="__('Email')" />
                <x-form.text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-form.input-error :errors="$errors->get('email')" />
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <x-form.input-label for="password" :value="__('Password')" />
                <x-form.text-input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-form.input-error :errors="$errors->get('password')" />
            </div>

            {{-- Remember --}}
            <div class="mb-3 form-check">
                <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
            </div>

            {{-- Submit --}}
            <div class="d-flex flex-wrap align-items-end justify-content-between">
                <x-form.button class="btn-primary me-3" title="{{ __('Log in') }}" />

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-dark small pt-2">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>
    </x-auth.auth-card>
</x-app-layout>
