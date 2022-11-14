<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-person"></i> {{ $user->full_name }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        <div><button class="btn btn-primary btn-sm lh-sm">
                <i class="bi bi-question-circle"></i> {{ __('Test') }}
            </button></div>
    </x-slot>

    <h2 class="fs-3 fw-light">
        {{ __('User details') }}
    </h2>

    <p>
        {{ $user->full_name }} <br>
        {{ $user->email }} <br>
    </p>
</x-cms-layout>
