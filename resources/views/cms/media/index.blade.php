<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-images"></i> {{ __('Media') }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        {{-- Dashboard link --}}
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.dashboard.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('Dashboard') }}
            </a></div>

        @can('manage content')
            {{-- Create media link--}}
            <div><a class="btn btn-outline-primary btn-sm lh-sm" href="{{ route('cms.media.create') }}">
                    <i class="bi bi-plus-circle"></i> {{ __('Add new media') }}
                </a></div>
        @endcan
    </x-slot>

    <h2 class="fs-3 fw-light">
        {{ __('All media') }}
    </h2>

    <div class="row g-2">
        @forelse($media as $medium)
            <div class="col-auto">
                <a href="{{ route('cms.media.show', $medium) }}">
                    <img src="{{ $medium->getUrl('thumbnail') }}" alt="{{ $medium->file_name }}" class="img-fluid">
                </a>
            </div>

        @empty
            <div class="col">
                <p class="fw-bold fst-italic">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ __('No media found') }}
                </p>
            </div>
        @endforelse
    </div>
</x-cms-layout>
