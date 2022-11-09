<nav class="l-navbar navbar navbar-expand-lg bg-light">
    <div class="container-md">
        {{-- App Logo + Name--}}
        <a class="navbar-brand d-flex align-items-center p-0" href="{{ route('home') }}">
            <x-svg.brand-icon width="36" height="36" class="me-2"/>
            <span style="font-weight: 500; padding-bottom: 0.15rem;">
                {{ config('app.name', 'Notrac') }}
            </span>
        </a>

        {{-- Collapse toggle --}}
        <button class="navbar-toggler" type="button" style="--bs-navbar-toggler-focus-width: 0.1rem;"
                data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-2"></i>
        </button>

        {{-- Collapse container --}}
        <div class="collapse navbar-collapse" id="navbarCollapse">
            {{-- Main navigation --}}
            <div class="navbar-nav">
                <x-nav.nav-link route="home" title="{{ __('Home') }}" />
                <x-nav.nav-link route="dashboard" title="{{ __('Dashboard') }}" />

                {{-- Todo: dropdown component --}}
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>

            {{-- User navigation --}}
            <div class="navbar-nav ms-auto">
                @auth
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('dashboard') }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>

                            <li><hr class="dropdown-divider"></li>

                            {{-- Logout --}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>

                @elseguest
                    @if (Route::has('login'))
                        <a class="nav-link" href="{{ route('login') }}">
                            {{ __('Log In') }}
                        </a>

                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
