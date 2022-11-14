<div class="cms-sidebar d-flex flex-column">
    <div class="cms-sidebar-header d-flex align-items-center justify-content-center p-1">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <x-svg.brand-icon width="20" height="20" class="me-2"/>
            <span >{{ config('app.name', 'Notrac') }}</span>
        </a>
    </div>

    <nav class="cms-sidebar-nav nav nav-pills lh-sm flex-column px-2 py-3"
         style=" --cms-nav-link-padding-x: 1rem; --cms-nav-link-padding-y: .375rem; --cms-nav-link-color: var(--cms-gray-200); --cms-nav-link-hover-color: var(--cms-white);">

        <x-nav.nav-link title="<i class='bi bi-speedometer2'></i> {{ __('Dashboard') }}" class="mb-2" route="cms.index" />
        <x-nav.nav-link title="<i class='bi bi-people'></i> {{ __('Users') }}" class="mb-2" route="cms.users.index" />

        <x-nav.nav-link title="<i class='bi bi-link'></i> {{ __('Link') }}" class="mb-2" />
        <x-nav.nav-link title="<i class='bi bi-link'></i> {{ __('Link') }}" class="mb-2" />
        <x-nav.nav-link title="<i class='bi bi-link'></i> {{ __('Link') }}" class="mb-2" />
        <x-nav.nav-link title="<i class='bi bi-link-45deg'></i> {{ __('Disabled') }}" class="mb-2 disabled" />

        <hr class="my-2">

        @can('view logs')
            <x-nav.nav-link title="<i class='bi bi-journal-code'></i> {{ __('Log Viewer') }}" route="blv.index" />
            <hr class="my-2">
        @endcan

        @can('access admin')
            <x-nav.nav-link title="<i class='bi bi-gear'></i> {{ __('ADMIN') }}" route="cms.admin.index" />
            <hr class="my-2">
        @endcan

        <x-nav.nav-link title="<i class='bi bi-github'></i> {{ __('GitHub') }}" target="_blank" href="https://github.com/dj-idfx/notrac-admin"/>
    </nav>

    <div class="cms-sidebar-footer text-center lh-sm mt-auto p-1">
        <small>{{ config('app.name', 'Notrac') }} CMS<br>&copy; {{ now()->year }} </small>
    </div>
</div>
