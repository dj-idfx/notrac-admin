<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-gear"></i> {{ __('ADMIN') }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        <div><button class="btn btn-primary btn-sm lh-sm">
                <i class="bi bi-question-circle"></i> {{ __('Test') }}
            </button></div>
    </x-slot>

    <div class="row">
        <div class="col">
            <a href="{{ route('cms.admin.queue') }}">
                Start media queue
            </a>
        </div>
    </div>
</x-cms-layout>
