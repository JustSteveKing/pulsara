@props([
    'title'
])

<a
    wire:navigate
    {!! $attributes->merge(['class' => 'font-semibold text-primary-dark hover:text-tertiary-light dark:text-primary-dark dark:hover:text-tertiary-dark']) !!}
    title="{{ $title }}"
>
    {{ $slot }}
</a>
