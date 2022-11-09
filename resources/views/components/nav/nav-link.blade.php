@php
    $classes = $attributes['class'] ?? '';
    $route = $attributes['route'] ?? null;
    $href = $attributes['href'] ?? '#';
    $title = $attributes['title'] ?? 'nav-link';
    $active = request()->routeIs($route);
@endphp

<a href="{{ $route ? route($route) : $href}}"
   @class(['nav-link', 'active' => $active, $classes])
   @if($active)aria-current="page"@endif
>
    {{ $title }}
</a>
