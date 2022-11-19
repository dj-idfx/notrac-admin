<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            @if(! $user->active)
                <i class="bi bi-person-fill-slash text-danger"></i>
            @elseif(! $user->email_verified_at)
                <i class="bi bi-person-dash text-warning"></i>
            @else
                <i class="bi bi-person"></i>
            @endif

            {{ $user->full_name }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        {{-- Index user link --}}
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.users.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('All users') }}
            </a></div>

        {{-- Account profile link --}}
        @if($user->is(Auth::user()))
            <div><a class="btn btn-outline-secondary btn-sm lh-sm" href="{{ route('account.profile') }}">
                    <i class="bi bi-eye"></i> {{ __('My account') }}
                </a></div>
        @endif

        @can('manage users')
            {{-- Edit user link --}}
            <div><a class="btn btn-outline-primary btn-sm lh-sm" href="{{ route('cms.users.edit', $user) }}">
                    <i class="bi bi-pencil-square"></i> {{ __('Edit user') }}
                </a></div>

            {{-- (de)-activate user --}}
            <div class="ms-sm-auto">
                {!! Form::open([
                    'id' => 'cmsActivateUserForm',
                    'route' => ['cms.users.activate', $user],
                    'method' => 'patch']) !!}
                {!! Form::button($user->active ? '<i class="bi bi-caret-down-square"></i>  '.__('De-activate user') : '<i class="bi bi-caret-up-square"></i>  '.__('Activate user'), [
                    'type' => 'submit',
                    'class' => 'btn btn-outline-warning btn-sm lh-sm',
                    'id' => 'cmsActivateUserSubmit']) !!}
                {!! Form::close() !!}
            </div>

            {{-- Delete user toggle modal --}}
            <div><button class="btn btn-outline-danger btn-sm lh-sm" type="button"
                         data-bs-toggle="modal" data-bs-target="#deleteUserModal">
                    <i class="bi bi-trash"></i> {{ __('Delete user') }}
                </button></div>

            @can('access admin')
                {{-- Hash user toggle modal --}}
                <div><button class="btn btn-outline-danger btn-sm lh-sm" type="button"
                             data-bs-toggle="modal" data-bs-target="#hashUserModal">
                        <i class="bi bi-hash"></i>
                    </button></div>
            @endcan
        @endcan
    </x-slot>

    {{-- $slot --}}
    <div class="row">
        <div class="col">
            <h2 class="fs-3 fw-light">
                {{ __('User details') }}
            </h2>

            <table class="table table-sm w-auto">
                <tr>
                    <th>{{ __('ID') }}:</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('Slug') }}:</th>
                    <td>{{ $user->slug }}</td>
                </tr>
                <tr>
                    <th>{{ __('First name') }}:</th>
                    <td>{{ $user->first_name }}</td>
                </tr>
                <tr>
                    <th>{{ __('Last name') }}:</th>
                    <td>{{ $user->last_name }}</td>
                </tr>
                <tr>
                    <th>{{ __('Email') }}:</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>{{ __('Active') }}:</th>
                    <td class="{{ $user->active ? null : 'text-danger fw-bold' }}">
                        {{ $user->active ? __('Yes') : __('No')}}
                    </td>
                </tr>

                @can('manage users')
                    <tr>
                        <th>{{ __('Remember token') }}:</th>
                        <td style="overflow: hidden; max-width: 24ch; text-overflow: ellipsis; white-space: nowrap;">
                            {{ $user->remember_token }}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Email verified at') }}:</th>
                        <td class="{{ $user->email_verified_at ? null : 'text-warning fw-bold' }}">
                            {{ $user->email_verified_at ?? __('No')}}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Created at') }}:</th>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Updated at') }}:</th>
                        <td>{{ $user->updated_at }}</td>
                    </tr>

                    @if($user->deleted_at)
                        <tr>
                            <th>{{ __('Deleted at') }}:</th>
                            <td>{{ $user->deleted_at }}</td>
                        </tr>
                    @endif

                    @if($user->hashed_at)
                        <tr>
                            <th>{{ __('Hashed at') }}:</th>
                            <td>{{ $user->hashed_at }}</td>
                        </tr>
                    @endif
                @endcan
            </table>

            <h3 class="fs-4 fw-light">
                {{ __('User roles') }}
            </h3>

            @forelse($user->getRoleNames() as $role)
                @if($loop->first)<ul>@endif
                    <li>{{ $role }}</li>
                    @if($loop->last)</ul>@endif

            @empty
                <p class="fw-bold fst-italic">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ __('No roles found') }}
                </p>
            @endforelse
        </div>
    </div>

    @can('manage users')
        {{-- Delete user modal--}}
        <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="deleteUserModalLabel">
                            {{ __('Delete user') .': ' . $user->full_name }}
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
                            'id' => 'cmsDeleteUserForm',
                            'route' => ['cms.users.destroy', $user],
                            'method' => 'delete']) !!}
                        {!! Form::button('<i class="bi bi-trash"></i>  '.__('Delete user'), [
                            'type' => 'submit',
                            'class' => 'btn btn-danger',
                            'id' => 'cmsDeleteUserSubmit']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        @can('access admin')
            {{-- Hash user modal--}}
            <div class="modal fade" id="hashUserModal" tabindex="-1" aria-labelledby="hashUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-light">
                            <h2 class="modal-title fs-5" id="hashUserModalLabel">
                                {{ __('Hash user') .': ' . $user->full_name }}
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
                                'id' => 'cmsHashUserForm',
                                'route' => ['cms.users.hash', $user],
                                'method' => 'patch']) !!}
                            {!! Form::button('<i class="bi bi-hash"></i>  '.__('Hash user'), [
                                'type' => 'submit',
                                'class' => 'btn btn-danger',
                                'id' => 'cmsHashUserSubmit']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    @endcan
</x-cms-layout>
