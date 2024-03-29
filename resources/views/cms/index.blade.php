<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class='bi bi-speedometer2'></i> {{ config('app.name', 'Notrac') }} CMS
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        <div><button class="btn btn-primary btn-sm lh-sm">
                <i class="bi bi-question-circle"></i> {{ __('Test') }}
            </button></div>
    </x-slot>

    {{-- $slot --}}
    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
        {{-- User management --}}
        <div class="col">
            <a href="{{ route('cms.users.index') }}" class="link-secondary text-decoration-none user-select-none">
                <div class="d-flex flex-column align-items-center h-100 border border-secondary py-3 px-2 px-sm-3">
                    <h2 class="text-center">
                        <i class="bi bi-people display-3 lh-1"></i> <br>
                        {{ $userCount }} {{ __('Users') }}
                    </h2>

                    <p class="m-0">
                        <strong><i class="bi bi-person-dash text-warning"></i> {{ $userUnverifiedCount }}</strong> {{ __('Unverified') }}
                        <br>
                        <strong><i class="bi bi-person-fill-slash text-danger"></i> {{ $userInactiveCount }}</strong> {{ __('Inactive') }}
                    </p>
                </div>
            </a>
        </div>

        {{-- Posts management --}}
        <div class="col">
            <a href="{{ route('cms.posts.index') }}" class="link-secondary text-decoration-none user-select-none">
                <div class="d-flex flex-column align-items-center h-100 border border-secondary py-3 px-2 px-sm-3">
                    <h2 class="text-center">
                        <i class="bi bi-journals display-3 lh-1"></i> <br>
                        {{ $postCount }} {{ __('Posts') }}
                    </h2>

                    <p class="m-0">
                        <strong><i class="bi bi-journal-text text-success"></i> {{ $postPublishedCount }}</strong> {{ __('Published') }}
                        <br>
                        <strong><i class="bi bi-journal-minus text-warning"></i> {{ $postNotPublishedCount }}</strong> {{ __('Not published') }}
                    </p>
                </div>
            </a>
        </div>

        {{-- Media management --}}
        <div class="col">
            <a href="{{ route('cms.media.index') }}" class="link-secondary text-decoration-none user-select-none">
                <div class="d-flex flex-column align-items-center h-100 border border-secondary py-3 px-2 px-sm-3">
                    <h2 class="text-center">
                        <i class="bi bi-images display-3 lh-1"></i> <br>
                        {{ $mediaCount }} {{ __('Media') }}
                    </h2>

                    <p class="m-0">
                        <strong><i class="bi bi-image-fill"></i> {{ $mediaImageCount }}</strong> {{ __('Images') }}
                        <br>
                        <strong><i class="bi bi-camera-video"></i> {{ $mediaVideoCount }}</strong> {{ __('Videos') }}
                    </p>
                </div>
            </a>
        </div>
    </div>
</x-cms-layout>
