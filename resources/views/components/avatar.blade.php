@props([
    'src',
    'alt' => 'Avatar'
])

<img
    {!! $attributes->merge(['class' => 'inline-block h-10 w-10 rounded-md']) !!}
    src="{{ $src }}"
    alt="{{ $alt }}"
/>
