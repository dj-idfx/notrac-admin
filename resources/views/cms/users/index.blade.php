<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-people"></i> {{ __('Users') }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        @can('manage users')
            <div><a class="btn btn-outline-primary btn-sm lh-sm" href="{{ route('cms.users.create') }}">
                    <i class="bi bi-plus-circle"></i> {{ __('Create new user') }}
                </a></div>
        @endcan
    </x-slot>

    <h2 class="fs-3 fw-light">
        {{ __('All users') }}
    </h2>

    @forelse($users as $user)
        @if($loop->first)<ul>@endif
            <li>
                <a href="{{ route('cms.users.show', $user) }}" class="link-dark">
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
