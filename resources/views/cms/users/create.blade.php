<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-person-plus"></i> {{ __('Create new user') }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.users.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('All users') }}
            </a></div>
    </x-slot>

    <div class="row justify-content-center">
            {!! Form::open([
                'id' => 'cmsCreateUserForm',
                'route' => 'cms.users.store',
                'method' => 'post',
                'class' => 'col-lg-10 col-xl-8'
            ]) !!}

            <div class="row g-3">
                <h2 class="fs-3 fw-light col-12 mb-0">
                    {{ __('User details') }}
                </h2>

                {{--  first_name --}}
                <div class="col-md-6">
                    {!! Form::label('first_name', __('First Name'), ['class' => 'form-label']) !!}
                    {!! Form::text('first_name', null, [
                        'aria-label' => 'first_name',
                        'class' => $errors->has('first_name') ? 'form-control is-invalid' : 'form-control',
                        $errors->any() ? '' : 'autofocus',
                        'required'
                        ]) !!}
                    {!! $errors->first('first_name', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

                {{--  last_name --}}
                <div class="col-md-6">
                    {!! Form::label('last_name', __('Last Name'), ['class' => 'form-label']) !!}
                    {!! Form::text('last_name', null, [
                        'aria-label' => 'last_name',
                        'class' => $errors->has('last_name') ? 'form-control is-invalid' : 'form-control',
                        'required'
                        ]) !!}
                    {!! $errors->first('last_name', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

                {{--  email --}}
                <div class="col-md-6">
                    {!! Form::label('email', __('Email'), ['class' => 'form-label']) !!}
                    {!! Form::email('email', null, [
                        'aria-label' => 'email',
                        'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control',
                        'required'
                        ]) !!}
                    {!! $errors->first('email', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

                <h3 class="fs-4 fw-light col-12 mb-0">
                    {{ __('User role') }}
                </h3>

                {{--  role select --}}
                <div class="col-md-6">
                    {!! Form::label('role', __('Role'), ['class' => 'form-label d-none']) !!}
                    {!! Form::select('role', config('permission.default_roles'), 'subscriber', [
                        'aria-label' => 'role',
                        'class' => $errors->has('role') ? 'form-select is-invalid' : 'form-select',
                        'required'
                        ]) !!}
                    {!! $errors->first('role', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

                {{-- buttons --}}
                <div class="col-12 d-flex">
                    {!! Form::button('<i class="bi bi-save"></i>  '.__('Save'), [
                        'type' => 'submit',
                        'class' => 'btn btn-primary me-auto',
                        'id' => 'cmsCreateUserSubmit'
                    ]) !!}

                    <a href="{{ route('cms.users.index') }}"
                       class="btn btn-outline-dark">
                        <i class="bi bi-x-circle"></i>
                        {{ __('Cancel') }}
                    </a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
</x-cms-layout>
