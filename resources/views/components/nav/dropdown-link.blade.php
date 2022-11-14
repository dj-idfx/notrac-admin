@php
    $attributes = $attributes ?? null;

    $class = $attributes['class'] ?? '';
    $route = $attributes['route'] ?? null;
    $href = $attributes['href'] ?? '#';
    $title = $attributes['title'] ?? '';
    $active = $attributes['active'] ?? request()->routeIs($route);

    $attributes = $attributes->except(['class', 'route', 'href', 'title', 'active']);
@endphp

<a @class(['dropdown-item', 'active' => $active, $class]) href="{{ $route ? route($route) : $href}}" @if($active)aria-current="page"@endif {{ $attributes }}>{!! $title !!}</a>
