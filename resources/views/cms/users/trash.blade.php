<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-people-fill text-danger"></i> {{ __('User trash') }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        {{-- Index user link --}}
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.users.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('All users') }}
            </a></div>

        {{-- Delete All users toggle modal --}}
        <div class="ms-sm-auto"><button class="btn btn-outline-danger btn-sm lh-sm" type="button"
                                        data-bs-toggle="modal" data-bs-target="#deleteAllUsersModal">
                <i class="bi bi-trash-fill"></i> {{ __('Empty user trash') }}
            </button></div>
    </x-slot>

    <h2 class="fs-3 fw-light">
        {{ __('All trashed users') }}
    </h2>

    @forelse($users as $user)
        @if($loop->first)<ul class="list-unstyled">@endif
            <li class="mb-3">
                {{-- Restore user --}}
                {!! Form::open([
                    'id' => 'cmsRestoreUserForm'.$user->id,
                    'route' => ['cms.users.restore', $user->id],
                    'method' => 'patch',
                    'class' => 'd-inline',
                    ]) !!}
                {!! Form::button('<i class="bi bi-arrow-counterclockwise"></i> ', [
                    'type' => 'submit',
                    'class' => 'btn btn-warning btn-sm',
                    'id' => 'cmsRestoreUsersSubmit'.$user->id,
                    ]) !!}
                {!! Form::close() !!}

                {{-- Delete user --}}
                {!! Form::open([
                    'id' => 'cmsDeleteUserForm'.$user->id,
                    'route' => ['cms.users.delete', $user->id],
                    'method' => 'delete',
                    'class' => 'd-inline mx-1',
                    ]) !!}
                {!! Form::button('<i class="bi bi-trash"></i> ', [
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'id' => 'cmsDeleteUsersSubmit'.$user->id,
                    ]) !!}
                {!! Form::close() !!}

                <strong>{{ $user->full_name_rev }}</strong>
            </li>
            @if($loop->last)</ul>@endif

    @empty
        <p class="fst-italic">
            {{ __('No trashed users found') }}
        </p>
    @endforelse

    {{-- Delete all users modal--}}
    <div class="modal fade" id="deleteAllUsersModal" tabindex="-1" aria-labelledby="deleteAllUsersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h2 class="modal-title fs-5" id="deleteAllUsersModalLabel">
                        {{ __('Empty user trash') }}
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
                        'id' => 'cmsDeleteAllUsersForm',
                        'route' => 'cms.users.trash.empty',
                        'method' => 'delete']) !!}
                    {!! Form::button('<i class="bi bi-trash"></i>  '.__('Empty user trash'), [
                        'type' => 'submit',
                        'class' => 'btn btn-danger',
                        'id' => 'cmsDeleteAllUsersSubmit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-cms-layout>
