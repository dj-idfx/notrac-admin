<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-pencil-square"></i> {{ __('Edit  media') . ': ' . $medium->name }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.media.show', $medium) }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('Show media') }}
            </a></div>
    </x-slot>

    <div class="row justify-content-center">
        {!! Form::model($medium, [
            'id' => 'cmsEditMediaForm',
            'route' => ['cms.media.update', $medium],
            'method' => 'patch',
            'class' => 'col-lg-10 col-xl-8',
        ]) !!}

        <div class="row g-3">
            <h2 class="fs-3 fw-light col-12 mb-0">
                {{ __('Media details') }}
            </h2>

            {{-- name --}}
            <div class="col-12">
                {!! Form::label('name', __('Name'), ['class' => 'form-label']) !!}
                {!! Form::text('name', null, [
                    'aria-label' => 'name',
                    'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control',
                    'required',
                    ]) !!}
                {!! $errors->first('name', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
            </div>

            {{-- buttons --}}
            <div class="col-12 d-flex">
                {!! Form::button('<i class="bi bi-save"></i>  '.__('Save'), [
                    'type' => 'submit',
                    'class' => 'btn btn-primary me-auto',
                    'id' => 'cmsEditMediaSubmit',
                ]) !!}

                <a href="{{ route('cms.media.show', $medium) }}"
                   class="btn btn-outline-dark">
                    <i class="bi bi-x-circle"></i>
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</x-cms-layout>
