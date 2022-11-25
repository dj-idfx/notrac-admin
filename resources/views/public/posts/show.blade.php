<x-app-layout>
    <x-slot name="header">
        <div class="container py-3">
            <h1 class="fs-2 text-center mb-0">
                <i class="bi bi-journal-text"></i> {{ $post->title }}
            </h1>
        </div>
    </x-slot>

    <div class="container py-3 mb-3">
        <div class="row">
            <div class="col">
                <div class="quill-content">
                    {!! $post->quill !!}
                </div>

                <p>
                    {{ $post->user->full_name }} <br>
                    <small class="fst-italic">{{ $post->created_at }}</small>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
