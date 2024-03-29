<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-person-gear"></i> {{ __('Edit  user') . ': ' . $user->full_name }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.users.show', $user) }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('Show user') }}
            </a></div>
    </x-slot>

    <div class="row justify-content-center">
        {!! Form::model($user, [
            'id' => 'cmsEditUserForm',
            'route' => ['cms.users.update', $user],
            'method' => 'patch',
            'class' => 'col-lg-10 col-xl-8',
            'files' => true,
        ]) !!}

        <div class="row g-3">
            <h2 class="fs-3 fw-light col-12 mb-0">
                {{ __('User details') }}
            </h2>

            {{-- first_name --}}
            <div class="col-md-6">
                {!! Form::label('first_name', __('First Name'), ['class' => 'form-label']) !!}
                {!! Form::text('first_name', null, [
                    'aria-label' => 'first_name',
                    'class' => $errors->has('first_name') ? 'form-control is-invalid' : 'form-control',
                    'required'
                    ]) !!}
                {!! $errors->first('first_name', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
            </div>

            {{-- last_name --}}
            <div class="col-md-6">
                {!! Form::label('last_name', __('Last Name'), ['class' => 'form-label']) !!}
                {!! Form::text('last_name', null, [
                    'aria-label' => 'last_name',
                    'class' => $errors->has('last_name') ? 'form-control is-invalid' : 'form-control',
                    'required'
                    ]) !!}
                {!! $errors->first('last_name', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
            </div>

            {{-- email --}}
            <div class="col-md-6">
                {!! Form::label('email', __('Email'), ['class' => 'form-label']) !!}
                {!! Form::email('email', null, [
                    'aria-label' => 'email',
                    'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control',
                    'required'
                    ]) !!}
                {!! $errors->first('email', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
            </div>

            {{-- Force next columns to break to new line --}}
            <div class="w-100 m-0 p-0"></div>

            {{-- role select --}}
            <div class="col-md-6">
                {!! Form::label('role', __('User role'), ['class' => 'h3 fs-4 fw-light']) !!}
                {!! Form::select('role', $roles, $user->getRoleNames()->get(0), [
                    'aria-label' => 'role',
                    'class' => $errors->has('role') ? 'form-select is-invalid' : 'form-select',
                    'required'
                    ]) !!}
                {!! $errors->first('role', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
            </div>

            {{-- image file --}}
            <div class="col-md-6">
                {!! Form::label('cover', __('User image'), ['class' => 'h3 fs-4 fw-light']) !!}
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
                    'id' => 'cmsEditUserSubmit'
                ]) !!}

                <a href="{{ route('cms.users.show', $user) }}"
                   class="btn btn-outline-dark">
                    <i class="bi bi-x-circle"></i>
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</x-cms-layout>
