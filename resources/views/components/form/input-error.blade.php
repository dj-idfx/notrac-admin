@props(['errors'])

@if ($errors)
    <ul {{ $attributes->merge(['class' => 'list-group small mt-1']) }}>
        @foreach ((array) $errors as $error)
            <li class="list-group-item text-bg-warning bg-opacity-50 px-2 py-1">{{ $error }}</li>
        @endforeach
    </ul>
@endif
