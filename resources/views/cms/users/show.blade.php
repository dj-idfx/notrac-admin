<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-person"></i> {{ $user->full_name }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.users.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('All users') }}
            </a></div>

        @can('manage users')
            <div><button class="btn btn-outline-secondary btn-sm lh-sm">
                    <i class="bi bi-pencil-square"></i> {{ __('Edit user') }}
                </button></div>
        @endcan

        @if($user->is(Auth::user()))
            <div><a class="btn btn-primary btn-sm lh-sm" href="{{ route('account.profile') }}">
                    <i class="bi bi-eye"></i> {{ __('Public account') }}
                </a></div>
        @endif
    </x-slot>

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
                    <td>{{ $user->active ? __('Yes') : __('No')}}</td>
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
                        <td>{{ $user->email_verified_at }}</td>
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
        </div>
    </div>
</x-cms-layout>
