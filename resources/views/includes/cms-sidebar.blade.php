<div class="cms-sidebar d-flex flex-column">
    <div class="cms-sidebar-header d-flex align-items-center justify-content-center p-1">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <x-svg.brand-icon width="20" height="20" class="me-2"/>
            <span >{{ config('app.name', 'Notrac') }}</span>
        </a>
    </div>

    <nav class="cms-sidebar-nav nav nav-pills lh-sm flex-column px-2 py-3"
         style=" --cms-nav-link-padding-x: 1rem; --cms-nav-link-padding-y: .375rem; --cms-nav-link-color: var(--cms-gray-200); --cms-nav-link-hover-color: var(--cms-white);">
        <a class="nav-link mb-2 active" aria-current="page" href="{{ route('cms.index') }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a class="nav-link mb-2" href="#">Link</a>
        <a class="nav-link mb-2" href="#">Link</a>
        <a class="nav-link mb-2 disabled">Disabled</a>

        <a class="nav-link mb-2" href="{{ route('blv.index') }}">
            <i class="bi bi-journal-code"></i>
            Log Viewer
        </a>
    </nav>

    <div class="cms-sidebar-footer text-center mt-auto p-2">
        Sidebar Footer
    </div>
</div>
