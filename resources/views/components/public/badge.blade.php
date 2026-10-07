@props([
    'variant' => 'active', // active, upcoming, pillar, gold, silver, default
    'pulse' => false,
])

@php
    $baseClasses = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-xs font-bold transition-colors';

    $variants = [
        'active' => 'rounded-full px-3 py-1 bg-brand-green-light text-brand-green-dark border border-emerald-200',
        'upcoming' => 'rounded-full px-3 py-1 bg-gray-100 text-brand-muted border border-gray-200 font-semibold',
        'pillar' => 'bg-brand-purple-light text-brand-purple-dark border border-purple-200 uppercase tracking-wide text-[11px]',
        'gold' => 'bg-amber-50 text-amber-700 border border-amber-200',
        'silver' => 'bg-slate-100 text-slate-700 border border-slate-200',
        'default' => 'bg-brand-bg-soft text-brand-muted border border-brand-border',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['default']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    @if ($variant === 'active' || $pulse)
        <span class="w-2 h-2 rounded-full bg-brand-green animate-pulse shrink-0"></span>
    @endif
    {{ $slot }}
</span>
