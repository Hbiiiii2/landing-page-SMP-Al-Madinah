@props([
    'variant' => 'primary', // primary, outline, soft, whatsapp, link
    'href' => null,
    'type' => 'button',
    'disabled' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 font-semibold text-sm transition-all rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-1';
    
    $variants = [
        'primary' => 'bg-brand-green text-white hover:bg-brand-green-dark shadow-sm focus:ring-brand-green/30 disabled:bg-brand-border disabled:text-brand-muted disabled:cursor-not-allowed',
        'outline' => 'bg-white border border-brand-border text-brand-dark hover:bg-brand-bg-soft hover:border-brand-muted/40 focus:ring-brand-green/20 disabled:border-brand-border disabled:text-brand-muted disabled:cursor-not-allowed',
        'soft' => 'bg-brand-green-light text-brand-green-dark hover:bg-emerald-100 focus:ring-brand-green/20',
        'whatsapp' => 'bg-emerald-800 text-white hover:bg-emerald-900 shadow-sm focus:ring-emerald-700/30',
        'link' => 'text-brand-green hover:underline p-0 text-xs font-semibold hover:text-brand-green-dark focus:ring-brand-green/20',
    ];

    $sizeClasses = $variant === 'link' ? '' : 'px-5 py-2.5';
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . $sizeClasses;
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
