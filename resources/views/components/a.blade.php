@props([
    'title'
])

<a {!! $attributes->merge(['class' => 'font-semibold text-indigo-600 hover:text-indigo-500']) !!}>
    {{ $slot }}
</a>
