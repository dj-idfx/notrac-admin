<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-2 text-center mb-0">
                <i class="bi bi-journals"></i> {{ __('Posts') }}
            </h1>
        </div>
    </x-slot>

    <div class="container py-3 mb-4">
        <h2 class="fs-3 fw-light mb-0">
            {{ __('All posts') }}
        </h2>

        <div class="row justify-content-center">
            @forelse($posts as $post)
                <div class="col-12">
                    <hr class="border-dark border-opacity-50">

                    <div class="row">
                        <div class="col-4 col-md-auto">
                            <a href="{{ route('posts.show', $post) }}" class="text-decoration-none">
                                <img src="{{ $post->getFirstMediaUrl('cover', 'thumbnail') }}"
                                     alt="{{ $post->title }}"
                                     class="img-fluid"
                                     @if($loop->index > 3) loading="lazy" @endif>
                            </a>
                        </div>

                        <div class="col d-flex flex-column">
                            <h3 class="fs-4">
                                {{ $post->title }}
                            </h3>

                            <p class="mt-auto">
                                {{ $post->user->full_name }}
                                <br>
                                <small class="fst-italic">{{ $post->created_at }}</small>
                                <br>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary btn-sm mt-2">
                                    {{ __('Read more') }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col">
                    <p class="fw-bold fst-italic">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ __('No posts found') }}
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
