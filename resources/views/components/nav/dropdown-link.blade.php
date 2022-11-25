@php
    $attributes = $attributes ?? null;

    $class = $attributes['class'] ?? '';
    $route = $attributes['route'] ?? null;
    $childsActive = $attributes['childsActive'] ?? false;
    $activeRoutes = [
        $route,
        /* Set active attribute on child routes */
        $childsActive ? ($route ? (Str::beforeLast($route, '.') .'.*') : null) : null,
    ];
    $routeParam = $attributes['routeParam'] ?? null;
    $href = $attributes['href'] ?? '#';
    $title = $attributes['title'] ?? '';
    $active = $attributes['active'] ?? request()->routeIs($activeRoutes);

    $attributes = $attributes->except(['class', 'route', 'routeParam', 'href', 'title', 'active']);
@endphp

<a @class(['dropdown-item', 'active' => $active, $class]) href="{{ $route ? route($route, $routeParam) : $href}}" @if($active)aria-current="page"@endif {{ $attributes }}>{!! $title !!}</a>
