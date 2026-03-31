@props([
    'variant' => 'primary',
])

@php
    $baseClasses =
        'inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus:outline-hidden focus:ring-2 focus:ring-accent focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none px-4 py-2';

    $variantClasses = match ($variant) {
        'primary' => 'bg-copas-base hover:bg-copas-dark text-white',
        'outline' => 'border border-copas-base text-copas-base hover:bg-copas-base hover:text-white',
        default => 'bg-copas-base hover:bg-copas-dark text-white',
    };
@endphp

<button {{ $attributes->merge(['class' => $baseClasses . ' ' . $variantClasses]) }}>
    {{ $slot }}
</button>
