@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm leading-6']) }}>
    {{ $value ?? $slot }}
</label>
