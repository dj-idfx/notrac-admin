<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-6 text-center w-75 mb-0 mx-auto">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </h1>
        </div>
    </x-slot>

    <x-auth.auth-card>
        {{-- Session Status --}}
        @if (session('status') == 'verification-link-sent')
            <x-auth.auth-session-status class="mb-3" :status="__('A new verification link has been sent to the email address you provided during registration.')" />
        @endif

        <div class="d-flex flex-wrap align-items-end justify-content-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-form.button class="btn-outline-primary btn-sm px-3 my-1 me-3" title="{{ __('Resend Verification Email') }}" />
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-form.button class="btn-outline-primary btn-sm px-3 my-1" title="{{ __('Log Out') }}" />
            </form>
        </div>
    </x-auth.auth-card>
</x-app-layout>
