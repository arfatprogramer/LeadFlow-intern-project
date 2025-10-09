@props(['active','href'])

@php
$classes = ($active ?? false)
            ? ' block px-4 py-2 rounded transition bg-blue-600 text-white border border-blue-700 hover:bg-blue-700'
            : ' bg-white block px-4 py-2 rounded hover:bg-blue-500 transition border-b border-blue-700';
@endphp

<a href={{ $href }} {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
