<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-2 text-center mb-0">
                <i class="bi bi-journals"></i> {{ __('Posts') }}
            </h1>
        </div>
    </x-slot>

    <div class="container py-3 mb-3">
       <h2 class="fs-3 fw-light mb-0">
            {{ __('All posts') }}
        </h2>

        <div class="row justify-content-center">
            @forelse($posts as $post)
                <div class="col-12">
                    <hr class="border-dark border-opacity-50">

                    <h3 class="fs-4">
                        {{ $post->title }}
                    </h3>

                    <p>
                        {{ $post->user->full_name }} <br>
                        <small class="fst-italic">{{ $post->created_at }}</small>
                    </p>

                    <a href="{{ route('posts.show', $post) }}" class="btn btn-primary btn-sm">
                        {{ __('Read more') }}
                    </a>
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
