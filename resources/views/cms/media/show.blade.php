<x-cms-layout>
    @push('scripts-head')
        @vite('resources/js/chocolat.js')
    @endpush

    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-image"></i>
            <small>{{ $medium->name }}</small>
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        {{-- Index media link --}}
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.media.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('All media') }}
            </a></div>

        @can('manage content')
            {{-- Edit media link --}}
            <div><a class="btn btn-outline-primary btn-sm lh-sm" href="{{ route('cms.media.edit', $medium) }}">
                    <i class="bi bi-pencil-square"></i> {{ __('Edit media') }}
                </a></div>

            {{-- Delete media toggle modal --}}
            <div class="ms-md-auto"><button class="btn btn-outline-danger btn-sm lh-sm" type="button"
                                            data-bs-toggle="modal" data-bs-target="#deleteMediaModal">
                    <i class="bi bi-trash"></i> {{ __('Delete media') }}
                </button></div>
        @endcan
    </x-slot>

    <div class="row">
        {{-- Content --}}
        <div class="col">
            <h2 class="fs-3 fw-light">
                {{ __('Media content') }}
            </h2>

            @if(preg_match('/^image/', $medium->mime_type) )
                <a class="chocolat-image-link" href="#" data-href="{{ $medium->getUrl() }}" title="{{ $medium->name }}">
                    {{ $medium->img()->attributes(['class' => 'img-fluid', 'title' => $medium->name]) }}
                </a>
            @endif
        </div>

        {{-- Details --}}
        <div class="col-md-auto">
            <h3 class="fs-4 fw-light">
                {{ __('Media details') }}
            </h3>

            <table class="table table-sm w-auto">
                <tr>
                    <th>{{ __('ID') }}:</th>
                    <td>
                        {{ $medium->id }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('UUID') }}:</th>
                    <td style="overflow: hidden; max-width: 24ch; text-overflow: ellipsis; white-space: nowrap;">
                        {{ $medium->uuid }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('model_type') }}:</th>
                    <td>
                        {{ $medium->model_type }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('model_id') }}:</th>
                    <td style="overflow: hidden; max-width: 24ch; text-overflow: ellipsis; white-space: nowrap;">
                        {{ $medium->model_id }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('collection_name') }}:</th>
                    <td>
                        {{ $medium->collection_name }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('file_name') }}:</th>
                    <td style="overflow: hidden; max-width: 24ch; text-overflow: ellipsis; white-space: nowrap;">
                        {{ $medium->file_name }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('mime_type') }}:</th>
                    <td>
                        {{ $medium->mime_type }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('disk') }}:</th>
                    <td>
                        {{ $medium->disk }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('conversions_disk') }}:</th>
                    <td>
                        {{ $medium->conversions_disk }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('size') }}:</th>
                    <td>
                        {{ $medium->human_readable_size }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('width') }}:</th>
                    <td>
                        {{ $medium->width }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('height') }}:</th>
                    <td>
                        {{ $medium->height }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('order_column') }}:</th>
                    <td>
                        {{ $medium->order_column }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Created at') }}:</th>
                    <td>{{ $medium->created_at }}</td>
                </tr>
                <tr>
                    <th>{{ __('Updated at') }}:</th>
                    <td>{{ $medium->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col">
            TODO: show manipulations / custom properties / conversions / responsive / ... ?
        </div>
    </div>

    {{-- Delete media modal--}}
    <div class="modal fade" id="deleteMediaModal" tabindex="-1" aria-labelledby="deleteMediaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h2 class="modal-title fs-5" id="deleteMediaModalLabel">
                        {{ __('Delete media') .': ' . $medium->name }}
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
                        'id' => 'cmsDeleteMediaForm',
                        'route' => ['cms.media.destroy', $medium],
                        'method' => 'delete']) !!}
                    {!! Form::button('<i class="bi bi-trash"></i>  '.__('Delete media'), [
                        'type' => 'submit',
                        'class' => 'btn btn-danger',
                        'id' => 'cmsDeleteMediaSubmit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Extra JS --}}
    @push('scripts-bottom')
        <script>
            /* Chocolat */
            document.addEventListener("DOMContentLoaded", () => {
                let imageLinks = document.querySelectorAll('.chocolat-image-link');

                imageLinks.forEach(link => {
                    link.href = link.getAttribute('data-href');
                })

                chocolat(imageLinks, {
                    imageSize: 'contain',
                })
            })
        </script>
    @endpush
</x-cms-layout>
