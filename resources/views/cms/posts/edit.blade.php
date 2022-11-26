<x-cms-layout>
    @push('scripts-head')
        @vite('resources/js/quill.js')
    @endpush

    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-pencil-square"></i> {{ __('Edit  post') . ': ' . $post->title }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.posts.show', $post) }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('Show post') }}
            </a></div>
    </x-slot>

    <div class="row justify-content-center">
        {!! Form::model($post, [
            'id' => 'cmsEditPostForm',
            'route' => ['cms.posts.update', $post],
            'method' => 'patch',
            'class' => 'quill-form col-lg-10 col-xl-8',
            'files' => true,
        ]) !!}

        <div class="row g-3">
            <h2 class="fs-3 fw-light col-12 mb-0">
                {{ __('Post details') }}
            </h2>

            {{-- title --}}
            <div class="col-12">
                {!! Form::label('title', __('Title (Heading 1)'), ['class' => 'form-label']) !!}
                {!! Form::text('title', null, [
                    'aria-label' => 'title',
                    'class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control',
                    'required',
                    ]) !!}
                {!! $errors->first('title', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
            </div>

            {{-- quill --}}
            <div class="col-12">
                {!! Form::label('quill', __('Content'), ['class' => 'form-label']) !!}
                <input name="quill" id="quill" type="hidden" required>
                {!! $errors->first('quill', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}

                <div class="quill-container">
                    <div class="quill-editor">{!! $post->quill !!}</div>
                </div>
            </div>

            {{-- image file --}}
            <div class="col-12">
                {!! Form::label('cover', __('Post cover'), ['class' => 'h3 fs-4 fw-light']) !!}
                {!! Form::file('cover', [
                    'aria-label' => 'cover',
                    'class' => $errors->has('cover') ? 'form-control is-invalid' : 'form-control',
                    'accept' => 'image/*',
                    'id' => 'cover',
                    ]) !!}
                {!! $errors->first('cover', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                <div id="coverHelp" class="form-text">{{ __('max. 2MB') }}</div>
            </div>

            {{-- buttons --}}
            <div class="col-12 d-flex">
                {!! Form::button('<i class="bi bi-save"></i>  '.__('Save'), [
                    'type' => 'submit',
                    'class' => 'btn btn-primary me-auto',
                    'id' => 'cmsEditPostSubmit',
                ]) !!}

                <a href="{{ route('cms.posts.show', $post) }}"
                   class="btn btn-outline-dark">
                    <i class="bi bi-x-circle"></i>
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</x-cms-layout>
