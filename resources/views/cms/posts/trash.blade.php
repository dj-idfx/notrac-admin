<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-journal-x text-danger"></i> {{ __('Post trash') }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        {{-- Index post link --}}
        <div>
            <a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.posts.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('All posts') }}
            </a>
        </div>

        {{-- Delete All posts toggle modal --}}
        <div class="ms-sm-auto">
            <button class="btn btn-outline-danger btn-sm lh-sm" type="button" {{ $posts->count() == 0 ? 'disabled' : '' }}
                    data-bs-toggle="modal" data-bs-target="#deleteAllPostsModal">
                <i class="bi bi-trash-fill"></i> {{ __('Empty post trash') }}
            </button>
        </div>
    </x-slot>

    <h2 class="fs-3 fw-light">
        {{ __('All trashed posts') }}
    </h2>

    @forelse($posts as $post)
        @if($loop->first)<ul class="list-unstyled">@endif
            <li class="mb-3">
                {{-- Restore post --}}
                {!! Form::open([
                    'id' => 'cmsRestorePostForm'.$post->id,
                    'route' => ['cms.posts.restore', $post->id],
                    'method' => 'patch',
                    'class' => 'd-inline',
                    ]) !!}
                {!! Form::button('<i class="bi bi-arrow-counterclockwise"></i> ', [
                    'type' => 'submit',
                    'class' => 'btn btn-warning btn-sm',
                    'id' => 'cmsRestorePostsSubmit'.$post->id,
                    ]) !!}
                {!! Form::close() !!}

                {{-- Delete post --}}
                {!! Form::open([
                    'id' => 'cmsDeletePostForm'.$post->id,
                    'route' => ['cms.posts.delete', $post->id],
                    'method' => 'delete',
                    'class' => 'd-inline mx-1',
                    ]) !!}
                {!! Form::button('<i class="bi bi-trash"></i> ', [
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'id' => 'cmsDeletePostsSubmit'.$post->id,
                    ]) !!}
                {!! Form::close() !!}

                <small>{{ $post->created_at }} - </small> <strong>{{ $post->title }}</strong>
            </li>
            @if($loop->last)</ul>@endif

    @empty
        <p class="fst-italic">
            {{ __('No trashed posts found') }}
        </p>
    @endforelse

    {{-- Delete all posts modal--}}
    <div class="modal fade" id="deleteAllPostsModal" tabindex="-1" aria-labelledby="deleteAllPostsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h2 class="modal-title fs-5" id="deleteAllPostsModalLabel">
                        {{ __('Empty post trash') }}
                    </h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>{{ __('Are you sure?') }}</strong><br>
                    {{ __('This action is permanent and can not be un-done!') }}
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i>
                        {{ __('Cancel') }}
                    </button>

                    {!! Form::open([
                        'id' => 'cmsDeleteAllPostsForm',
                        'route' => 'cms.posts.trash.empty',
                        'method' => 'delete']) !!}
                    {!! Form::button('<i class="bi bi-trash"></i>  '.__('Empty post trash'), [
                        'type' => 'submit',
                        'class' => 'btn btn-danger',
                        'id' => 'cmsDeleteAllPostsSubmit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-cms-layout>
