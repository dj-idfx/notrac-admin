@php
    $attributes = $attributes ?? null;

    $class = $attributes['class'] ?? '';
    $route = $attributes['route'] ?? null;
    $activeRoutes = [
        $route,
        /* Set active attribute on child routes */
        $route ? (Str::beforeLast($route, '.') .'.*') : null,
    ];
    $routeParam = $attributes['routeParam'] ?? null;
    $href = $attributes['href'] ?? '#';
    $title = $attributes['title'] ?? '';
    $active = $attributes['active'] ?? request()->routeIs($activeRoutes);

    $attributes = $attributes->except(['class', 'route', 'routeParam', 'href', 'title', 'active']);
@endphp

<a @class(['nav-link', 'active' => $active, $class]) href="{{ $route ? route($route, $routeParam) : $href}}" @if($active)aria-current="page"@endif {{ $attributes }}>{!! $title !!}</a>
