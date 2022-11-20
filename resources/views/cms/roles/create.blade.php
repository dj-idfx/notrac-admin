<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-plus-square"></i> {{ __('Create new role') }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.roles.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('All roles') }}
            </a></div>
    </x-slot>

    <div class="row justify-content-center">
        {!! Form::open([
            'id' => 'cmsCreateRoleForm',
            'route' => 'cms.roles.store',
            'method' => 'post',
            'class' => 'col-lg-10 col-xl-8'
        ]) !!}

        <div class="row g-3">
            <h2 class="fs-3 fw-light col-12 mb-0">
                {{ __('Role details') }}
            </h2>

            {{-- name --}}
            <div class="col-md-6">
                {!! Form::label('name', __('Name'), ['class' => 'form-label']) !!}
                {!! Form::text('name', null, [
                    'aria-label' => 'name',
                    'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control',
                    $errors->any() ? '' : 'autofocus',
                    'required',
                    'maxlength' => '32'
                    ]) !!}
                {!! $errors->first('name', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
            </div>

            <h2 class="fs-3 fw-light col-12 mb-0">
                {{ __('Role permissions') }}
            </h2>

            {{-- permissions --}}
            <div class="col-12">
                @forelse($permissions as $permission)
                    <div class="form-check mb-1">
                        {!! Form::checkbox('permissions[]', $permission->id, null, [
                            'id' => 'permissionCheck'.$permission->id,
                            'class' => $errors->has('permissions[]') ? 'form-check-input is-invalid' : 'form-check-input',
                        ]) !!}
                        {!! Form::label('permissionCheck'.$permission->id, $permission->name, ['class' => 'form-check-label']) !!}
                    </div>

                @empty
                    <p class="fw-bold fst-italic">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ __('No permissions found') }}
                    </p>
                @endforelse

                {!! $errors->first('permissions.*', '<span class="invalid-feedback d-block"><strong>:message</strong></span>') !!}
            </div>

            {{-- buttons --}}
            <div class="col-12 d-flex">
                {!! Form::button('<i class="bi bi-save"></i>  '.__('Save'), [
                    'type' => 'submit',
                    'class' => 'btn btn-primary me-auto',
                    'id' => 'cmsCreateRoleSubmit'
                ]) !!}

                <a href="{{ route('cms.roles.index') }}"
                   class="btn btn-outline-dark">
                    <i class="bi bi-x-circle"></i>
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</x-cms-layout>
