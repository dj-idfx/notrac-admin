<nav class="l-navbar navbar navbar-expand-lg bg-light">
    <div class="container-md">
        {{-- App Logo + Name--}}
        <a class="navbar-brand d-flex align-items-center p-0" href="{{ route('home') }}">
            <x-svg.brand-icon width="36" height="36" class="me-2"/>
            <span style="font-weight: 500; padding-bottom: 0.15rem;">{{ config('app.name', 'Notrac') }}</span>
        </a>

        {{-- Collapse toggle --}}
        <button class="navbar-toggler" type="button" style="--bs-navbar-toggler-focus-width: 0.1rem;"
                data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-2"></i>
        </button>

        {{-- Collapse container --}}
        <div class="collapse navbar-collapse" id="navbarCollapse">
            {{-- Main navigation --}}
            <div class="navbar-nav">
                <x-nav.nav-link title="{{ __('Home') }}" route="home" />
                <x-nav.nav-link title="{{ __('Dashboard') }}" route="dashboard" />

                {{-- Dropdown example--}}
                <div class="dropdown">
                    <x-nav.nav-link title="{{ __('Dropdown') }}" class="dropdown-toggle"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false" />
                    <div class="dropdown-menu">
                        <x-nav.dropdown-link title="{{ __('Home') }}" route="home" />
                        <x-nav.dropdown-link title="{{ __('Dashboard') }}" route="dashboard" />
                        <x-nav.dropdown-link title="{{ __('Another action') }}" />
                        <hr class="dropdown-divider">
                        <x-nav.dropdown-link title="{{ __('Something else here') }}" />
                    </div>
                </div>
            </div>

            {{-- User menu --}}
            <div class="navbar-nav ms-auto">
                @auth
                    <div class="dropdown">
                        <x-nav.nav-link title="{{ Auth::user()->name }}" route="dashboard" class="dropdown-toggle"
                                        role="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" />
                        <div class="dropdown-menu dropdown-menu-end">
                            <x-nav.dropdown-link title="{{ __('Dashboard') }}" route="dashboard" />
                            <hr class="dropdown-divider">
                            {{-- Logout --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-form.button class="dropdown-item" title="{{ __('Log Out') }}" />
                            </form>
                        </div>
                    </div>

                @elseguest
                    @if (Route::has('login'))
                        <x-nav.nav-link title="{{ __('Log In') }}" route="login" />

                        @if (Route::has('register'))
                            <x-nav.nav-link title="{{ __('Register') }}" route="register" />
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
