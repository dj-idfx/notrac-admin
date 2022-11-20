<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-hash text-danger"></i> {{ __('Hashed users') }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        {{-- Index user link --}}
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.users.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('All users') }}
            </a></div>
    </x-slot>

    <h2 class="fs-3 fw-light">
        {{ __('All hashed users') }}
    </h2>

    @forelse($users as $user)
        @if($loop->first)<ul class="list-unstyled">@endif
            <li class="mb-2">
                {{-- Un-hash user --}}
                {!! Form::open([
                    'id' => 'cmsUnhashUserForm'.$user->id,
                    'route' => ['cms.users.unhash', $user->id],
                    'method' => 'patch',
                    'class' => 'd-inline',
                    ]) !!}
                {!! Form::button('<i class="bi bi-arrow-counterclockwise"></i> ', [
                    'type' => 'submit',
                    'class' => 'btn btn-warning btn-sm',
                    'id' => 'cmsUnhashUsersSubmit'.$user->id,
                    ]) !!}
                {!! Form::close() !!}

                <strong>{{ $user->id }}:</strong> {{ Str::limit($user->email, 32) }} <br>
                <small class="fst-italic">{{ $user->hashed_at }}</small>
            </li>
            @if($loop->last)</ul>@endif

    @empty
        <p class="fst-italic">
            {{ __('No hashed users found') }}
        </p>
    @endforelse
</x-cms-layout>
<x-cms-layout>
    <x-slot name="header">
        <h1 class="fs-2 text-center mb-0">
            <i class="bi bi-hash text-danger"></i> {{ __('Hashed users') }}
        </h1>
    </x-slot>

    <x-slot name="actionButtons">
        {{-- Index user link --}}
        <div><a class="btn btn-sm lh-sm ps-0" href="{{ route('cms.users.index') }}" style="--cms-btn-active-border-color: transparent;">
                <i class="bi bi-arrow-left"></i> {{ __('All users') }}
            </a></div>
    </x-slot>

    <h2 class="fs-3 fw-light">
        {{ __('All hashed users') }}
    </h2>

    @forelse($users as $user)
        @if($loop->first)<ul class="list-unstyled">@endif
            <li class="mb-2">
                {{-- Un-hash user --}}
                {!! Form::open([
                    'id' => 'cmsUnhashUserForm'.$user->id,
                    'route' => ['cms.users.unhash', $user->id],
                    'method' => 'patch',
                    'class' => 'd-inline',
                    ]) !!}
                {!! Form::button('<i class="bi bi-arrow-counterclockwise"></i> ', [
                    'type' => 'submit',
                    'class' => 'btn btn-warning btn-sm',
                    'id' => 'cmsUnhashUsersSubmit'.$user->id,
                    ]) !!}
                {!! Form::close() !!}

                <strong>{{ $user->id }}:</strong> {{ Str::limit($user->email, 32) }} <br>
                <small class="fst-italic">{{ $user->hashed_at }}</small>
            </li>
            @if($loop->last)</ul>@endif

    @empty
        <p class="fst-italic">
            {{ __('No hashed users found') }}
        </p>
    @endforelse
</x-cms-layout>
