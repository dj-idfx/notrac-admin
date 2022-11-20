<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-bricks"></i>

            {{ $role->name }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        {{-- Index role link --}}
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.roles.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('All roles') }}
            </a></div>

        @can('manage roles')
            {{-- Edit role link --}}
            <div><a class="btn btn-outline-primary btn-sm lh-sm" href="{{ route('cms.roles.edit', $role) }}">
                    <i class="bi bi-pencil-square"></i> {{ __('Edit role') }}
                </a></div>

            {{-- Delete role toggle modal --}}
            <div class="ms-auto"><button class="btn btn-outline-danger btn-sm lh-sm" type="button"
                                         data-bs-toggle="modal" data-bs-target="#deleteRoleModal">
                    <i class="bi bi-trash"></i> {{ __('Delete role') }}
                </button></div>
        @endcan
    </x-slot>

    {{-- $slot --}}
    <div class="row">
        <div class="col">
            <h2 class="fs-3 fw-light">
                {{ __('Role details') }}
            </h2>

            {{-- Roles table fields --}}
            <table class="table table-sm w-auto">
                <tr>
                    <th>{{ __('ID') }}:</th>
                    <td>{{ $role->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('Name') }}:</th>
                    <td>{{ $role->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('Guard') }}:</th>
                    <td>{{ $role->guard_name }}</td>
                </tr>
                <tr>
                    <th>{{ __('Created at') }}:</th>
                    <td>{{ $role->created_at }}</td>
                </tr>
                <tr>
                    <th>{{ __('Updated at') }}:</th>
                    <td>{{ $role->updated_at }}</td>
                </tr>
            </table>

            {{-- Role permissions --}}
            @can('manage roles')
                <h3 class="fs-4 fw-light">
                    {{ __('Role permissions') }}
                </h3>

                @forelse($role->permissions as $permission)
                    @if($loop->first)<ul>@endif
                        <li>{{ $permission->name }}</li>
                        @if($loop->last)</ul>@endif

                @empty
                    <p class="fw-bold fst-italic">
                        {{ __('No permissions found') }}
                    </p>
                @endforelse
            @endcan
        </div>

        <div class="col">
            <h3 class="fs-4 fw-light">
                {{ __('Role users') }}
            </h3>

            {{-- All users with this role --}}
            @forelse($users as $user)
                @if($loop->first)<ul class="list-unstyled">@endif
                    <li>
                        @if(! $user->active)
                            <i class="bi bi-person-fill-slash text-danger"></i>
                        @elseif(! $user->email_verified_at)
                            <i class="bi bi-person-dash text-warning"></i>
                        @else
                            <i class="bi bi-person-check text-success"></i>
                        @endif

                        <a href="{{ route('cms.users.show', $user) }}" class="link-dark ms-1">
                            {{ $user->full_name_rev }}
                        </a>
                    </li>
                    @if($loop->last)</ul>@endif

            @empty
                <p class="fw-bold fst-italic">
                    {{ __('No users found') }}
                </p>
            @endforelse
        </div>
    </div>

    {{-- Delete role modal--}}
    <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="deleteRoleModalLabel">
                        {{ __('Delete role') .': ' . $role->name }}
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
                        'id' => 'cmsDeleteRoleForm',
                        'route' => ['cms.roles.destroy', $role],
                        'method' => 'delete']) !!}
                    {!! Form::button('<i class="bi bi-trash"></i>  '.__('Delete role'), [
                        'type' => 'submit',
                        'class' => 'btn btn-danger',
                        'id' => 'cmsDeleteRoleSubmit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-cms-layout>
