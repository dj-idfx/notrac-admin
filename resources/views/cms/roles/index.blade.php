<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-bricks"></i> {{ __('Roles') }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        {{-- Index user link --}}
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.users.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('All users') }}
            </a></div>

        {{-- Create role link--}}
        <div><a class="btn btn-outline-primary btn-sm lh-sm" href="{{ route('cms.roles.create') }}">
                <i class="bi bi-plus-circle"></i> {{ __('Create new role') }}
            </a></div>
    </x-slot>

    <h2 class="fs-3 fw-light">
        {{ __('All roles') }}
    </h2>

    @forelse($roles as $role)
        @if($loop->first)<ul class="list-unstyled">@endif
            <li class="mb-1">
                <a href="{{ route('cms.roles.show', $role) }}" class="link-dark ms-1">
                    {{ $role->name }}
                </a>
            </li>
            @if($loop->last)</ul>@endif

    @empty
        <p class="fw-bold fst-italic">
            <i class="bi bi-exclamation-circle-fill"></i> {{ __('No roles found') }}
        </p>
    @endforelse
</x-cms-layout>
