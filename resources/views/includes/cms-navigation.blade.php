<nav class="cms-navbar navbar navbar-dark navbar-expand-lg">
    <div class="container-lg">
        {{-- Sidebar Toggle --}}
        <button class="navbar-toggler" type="button" style="--cms-navbar-toggler-focus-width: 0.1rem;"
                data-js-class="js-show-sidebar" aria-label="Toggle sidebar">
            <i class="bi bi-three-dots-vertical"></i>
        </button>

        {{-- Collapse toggle --}}
        <button class="navbar-toggler" type="button" style="--cms-navbar-toggler-focus-width: 0.1rem;"
                data-bs-toggle="collapse" data-bs-target="#CmsNavbarCollapse" aria-controls="CmsNavbarCollapse" aria-expanded="false" aria-label="Toggle navbar navigation">
            <i class="bi bi-list"></i>
        </button>

        {{-- Collapse container --}}
        <div class="collapse navbar-collapse" id="CmsNavbarCollapse">
            <div class="navbar-nav">
                <x-nav.nav-link title="{{ __('Example Link') }}" class="py-lg-0" />
            </div>

            {{-- User menu --}}
            <div class="navbar-nav ms-auto">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle py-lg-0" href="{{ route('cms.users.show', Auth::user()) }}"
                       role="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">{{ Auth::user()->full_name }}</a>
                    <div class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow-sm" style="--cms-dropdown-min-width: 8.25rem;">
                        <x-nav.dropdown-link title="<i class='bi bi-person'></i> {{ __('Profile') }}" route="cms.users.show" routeParam="{{ Auth::user()->slug }}" />
                        <hr class="dropdown-divider border-secondary">
                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-form.button class="dropdown-item" title="<i class='bi bi-power'></i> {{ __('Log Out') }}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
