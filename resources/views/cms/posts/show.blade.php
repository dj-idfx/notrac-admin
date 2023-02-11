<x-cms-layout>
    @push('scripts-head')
        @vite('resources/js/dropzone.js')
        @vite('resources/js/chocolat.js')

        <style>
            .collapse.show + button { display: none; }
            .collapse.show ~ a { display: inline-block; }
        </style>
    @endpush

    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-journal-text"></i>
            <small>{{ $post->title }}</small>
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        {{-- Index post link --}}
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.posts.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('All posts') }}
            </a></div>

        @if($post->published)
            {{-- View post link --}}
            <div><a class="btn btn-outline-dark btn-sm lh-sm" href="{{ route('posts.show', $post) }}">
                    <i class="bi bi-eye"></i>
                    <span class="d-md-none">{{ __('View') }}</span>
                    <span class="d-none d-md-inline">{{ __('View post') }}</span>
                </a></div>
        @endif

        @can('manage content')
            {{-- Edit post link --}}
            <div><a class="btn btn-outline-primary btn-sm lh-sm" href="{{ route('cms.posts.edit', $post) }}">
                    <i class="bi bi-pencil-square"></i>
                    <span class="d-md-none">{{ __('Edit') }}</span>
                    <span class="d-none d-md-inline">{{ __('Edit post') }}</span>
                </a></div>

            {{-- (un-)Publish post --}}
            <div>
                {!! Form::open([
                    'id' => 'cmsPublishPostForm',
                    'route' => ['cms.posts.publish', $post],
                    'method' => 'patch']) !!}
                {!! Form::button($post->published ? '<i class="bi bi-caret-down-square"></i>  '.__('Unpublish post') : '<i class="bi bi-caret-up-square"></i>  '.__('Publish post'), [
                    'type' => 'submit',
                    'class' => 'btn btn-outline-warning btn-sm lh-sm',
                    'id' => 'cmsPublishPostSubmit']) !!}
                {!! Form::close() !!}
            </div>

            {{-- Delete post toggle modal --}}
            <div class="ms-md-auto"><button class="btn btn-outline-danger btn-sm lh-sm" type="button"
                                            data-bs-toggle="modal" data-bs-target="#deletePostModal">
                    <i class="bi bi-trash"></i>
                    <span class="d-md-none">{{ __('Delete') }}</span>
                    <span class="d-none d-md-inline">{{ __('Delete post') }}</span>
                </button></div>
        @endcan
    </x-slot>

    <div class="row">
        {{-- Content --}}
        <div class="col">
            <h2 class="fs-3 fw-light">
                {{ __('Post content') }}
            </h2>

            <div class="border-start ps-3 mb-3">
                {!! $post->quill !!}
            </div>

            <h3 class="fs-4 fw-light">
                {{ __('Post author') }}
            </h3>

            <p>
                <a href="{{ route('cms.users.show', $post->user) }}">{{ $post->user->full_name }}</a>
            </p>
        </div>

        {{-- Details --}}
        <div class="col-md-auto">
            <h3 class="fs-4 fw-light">
                {{ __('Post cover') }}
            </h3>

            <a class="chocolat-image-link" href="#" data-href="{{ $post->getFirstMediaUrl('cover') }}" title="{{ $post->title }}">
                <img src="{{ $post->getFirstMediaUrl('cover', 'thumbnail') }}" alt="{{ $post->title }}" class="img-fluid w-100 mb-3" width="250" height="250">
            </a>

            <h3 class="fs-4 fw-light">
                {{ __('Post details') }}
            </h3>

            <table class="table table-sm w-auto">
                <tr>
                    <th>{{ __('ID') }}:</th>
                    <td style="overflow: hidden; max-width: 24ch; text-overflow: ellipsis; white-space: nowrap;">
                        {{ $post->id }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Created at') }}:</th>
                    <td>{{ $post->created_at }}</td>
                </tr>
                <tr>
                    <th>{{ __('Updated at') }}:</th>
                    <td>{{ $post->updated_at }}</td>
                </tr>
                <tr>
                    <th>{{ __('Published') }}:</th>
                    <td class="{{ $post->published ? null : 'text-warning fw-bold' }}">
                        {{ $post->published ? __('Yes') : __('No')}}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Published at') }}:</th>
                    <td>{{ $post->published_at }}</td>
                </tr>

                @if($post->deleted_at)
                    <tr>
                        <th>{{ __('Deleted at') }}:</th>
                        <td>{{ $post->deleted_at }}</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

    <hr>

    {{-- Images --}}
    <div class="row">
        <div class="col">
            <h2 class="fs-3 fw-light">
                {{ __('Post images') }}
            </h2>

            <div class="row">
                @forelse($post->getMedia('images') as $medium)
                    <div class="col-6 col-sm-4 col-md-2 mb-3">
                        <a class="chocolat-image-link" href="#" data-href="{{ $medium->getUrl() }}" title="{{ $medium->file_name }}">
                            <img src="{{ $medium->getUrl('thumbnail') }}" alt="{{ $medium->file_name }}" class="img-fluid w-100" width="250" height="250" loading="lazy">
                        </a>
                    </div>

                @empty
                    <div class="col">
                        <p class="fst-italic">
                            <i class="bi bi-exclamation-circle"></i> {{ __('No images found') }}
                        </p>
                    </div>
                @endforelse

                {{-- Dropzone --}}
                <div class="col-12">
                    <div class="collapse" id="collapseNewImages">
                        <div class="dropzone mb-3">
                            <div class="fallback">
                                <input name="media" type="file" multiple>
                            </div>
                            <div class="dz-message">
                                <strong>{{ __('Drop files here to upload') }}</strong>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNewImages" aria-expanded="false" aria-controls="collapseNewImages">
                        <i class="bi bi-plus-circle"></i> {{ __('Upload new images') }}
                    </button>

                    <a href="" class="btn btn-sm btn-outline-dark d-none">
                        <i class="bi bi-arrow-counterclockwise"></i> {{ __('Refresh') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <hr>

    {{-- Delete post modal--}}
    <div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="deletePostModalLabel">
                        {{ __('Delete post') .': ' . $post->title }}
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure?') }}
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i>
                        {{ __('Cancel') }}
                    </button>

                    {!! Form::open([
                        'id' => 'cmsDeletePostForm',
                        'route' => ['cms.posts.destroy', $post],
                        'method' => 'delete']) !!}
                    {!! Form::button('<i class="bi bi-trash"></i>  '.__('Delete post'), [
                        'type' => 'submit',
                        'class' => 'btn btn-danger',
                        'id' => 'cmsDeletePostSubmit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Extra JS --}}
    @push('scripts-bottom')
        <script>
            /* Dropzone */
            window.addEventListener('load', () => {
                const MediaDropzone = new dropzone('.dropzone', {
                    url: "{{ route('cms.posts.images', $post) }}",
                    method: "post",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    paramName: "media", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    parallelUploads: 4,
                    maxFiles: 16,
                    uploadMultiple: true,
                    acceptedFiles: `image/*`,
                });

                MediaDropzone.on("addedfile", file => {
                    console.log(`File added: ${file.name}`);
                });
            });

            /* Chocolat */
            document.addEventListener("DOMContentLoaded", () => {
                let imageLinks = document.querySelectorAll('.chocolat-image-link');

                imageLinks.forEach(link => {
                    link.href = link.getAttribute('data-href');
                })

                chocolat(imageLinks, {
                    loop: true,
                    imageSize: 'contain',
                })
            })
        </script>
    @endpush
</x-cms-layout>
