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
    </x-slot>

    <h2 class="fs-3 fw-light">
        {{ __('All images') }}
    </h2>

    <div class="row g-2">
        @forelse($images as $image)
            <div class="col-6 col-sm-4 col-md-2">
                <a href="{{ route('cms.media.show', $image) }}">
                    <img src="{{ $image->getUrl('thumbnail') }}" alt="{{ $image->file_name }}" class="img-fluid w-100" loading="lazy">
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
