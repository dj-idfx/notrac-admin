<x-cms-layout>
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
            'class' => 'col-lg-10 col-xl-8'
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
