<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-people"></i> {{ __('Users') }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        {{-- Dashboard link --}}
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.dashboard.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('Dashboard') }}
            </a></div>

        @can('manage users')
            <div><a class="btn btn-outline-primary btn-sm lh-sm" href="{{ route('cms.users.create') }}">
                    <i class="bi bi-plus-circle"></i> {{ __('Create new user') }}
                </a></div>

            @can('manage roles')
                <div><a class="btn btn-outline-secondary btn-sm lh-sm" href="{{ route('cms.roles.index') }}">
                        <i class="bi bi-bricks"></i> {{ __('Manage roles') }}
                    </a></div>
            @endcan

            <div class="ms-sm-auto"><a class="btn btn-outline-danger btn-sm lh-sm" href="{{ route('cms.users.trash') }}">
                    <i class="bi bi-trash"></i> {{ __('User trash') }}
                </a></div>

            @can('access admin')
                <div><a class="btn btn-outline-danger btn-sm lh-sm" href="{{ route('cms.users.hashed') }}">
                        <i class="bi bi-hash"></i> {{ __('Hashed users') }}
                    </a></div>
            @endcan
        @endcan
    </x-slot>

    <h2 class="fs-3 fw-light">
        {{ __('All users') }}
    </h2>

    @forelse($users as $user)
        @if($loop->first)<ul class="list-unstyled">@endif
            <li class="mb-1">
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
            <i class="bi bi-exclamation-circle-fill"></i> {{ __('No users found') }}
        </p>
    @endforelse
</x-cms-layout>
