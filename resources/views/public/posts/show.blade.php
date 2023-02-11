<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-2 text-center mb-0">
                <i class="bi bi-journal-text"></i> {{ $post->title }}
            </h1>
        </div>
    </x-slot>

    <div class="container py-3 mb-4">
        <div class="row">
            <div class="col-md-auto text-center">
                <img src="{{ $post->getFirstMediaUrl('cover', 'thumbnail') }}" alt="{{ $post->title }}" class="img-fluid mb-3" width="250" height="250">
            </div>

            <div class="col">
                <div class="quill-content">
                    {!! $post->quill !!}
                </div>

                <p>
                    {{ $post->user->full_name }} <br>
                    <small class="fst-italic">{{ $post->created_at }}</small>
                </p>

                @if($post->getFirstMedia('cover'))
                    {{ $post->getFirstMedia('cover')->img()->attributes(['class' => 'img-fluid']) }}
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
