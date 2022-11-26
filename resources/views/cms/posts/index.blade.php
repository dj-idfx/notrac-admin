<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-journals"></i> {{ __('Posts') }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        {{-- Dashboard link --}}
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.dashboard.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('Dashboard') }}
            </a></div>

        @can('write article')
            {{-- Create post link--}}
            <div><a class="btn btn-outline-primary btn-sm lh-sm" href="{{ route('cms.posts.create') }}">
                    <i class="bi bi-plus-circle"></i> {{ __('Create new post') }}
                </a></div>
        @endcan

        @can('manage content')
            {{-- Trash overview --}}
            <div class="ms-sm-auto"><a class="btn btn-outline-danger btn-sm lh-sm" href="{{ route('cms.posts.trash') }}">
                    <i class="bi bi-trash"></i> {{ __('Post trash') }}
                </a></div>
        @endcan
    </x-slot>

    <h2 class="fs-3 fw-light">
        {{ __('All posts') }}
    </h2>

    @forelse($posts as $post)
        @if($loop->first)<ul class="list-unstyled">@endif
            <li class="mb-1">
                @if(! $post->published)
                    <i class="bi bi-journal-minus text-warning"></i>
                @else
                    <i class="bi bi-journal-text text-success"></i>
                @endif

                <a href="{{ route('cms.posts.show', $post) }}" class="link-dark ms-1">
                    <small>{{ $post->created_at }} - </small> {{ $post->title }}
                </a>
            </li>
            @if($loop->last)</ul>@endif

    @empty
        <p class="fw-bold fst-italic">
            <i class="bi bi-exclamation-circle-fill"></i> {{ __('No posts found') }}
        </p>
    @endforelse
</x-cms-layout>
