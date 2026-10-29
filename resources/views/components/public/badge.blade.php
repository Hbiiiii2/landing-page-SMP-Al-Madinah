@props([
    'variant' => 'active', // active, purple, blue, gold, silver, default
    'pulse' => false,
])

@php
    $baseClasses = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold transition-colors';

    $variants = [
        'active' => 'bg-[#EAF6EC] text-[#217333] border border-[#D2EAD7]',
        'purple' => 'bg-[#F4F0F7] text-[#684681] border border-[#E3D9EC]',
        'blue' => 'bg-[#EDF4FC] text-[#325A8A] border border-[#CFE0F4]',
        'gold' => 'bg-amber-50 text-amber-800 border border-amber-200',
        'silver' => 'bg-slate-100 text-slate-700 border border-slate-200',
        'default' => 'bg-[#FAF9FB] text-[#66676B] border border-[#E7E3EA]',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['default']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    @if ($variant === 'active' || $pulse)
        <span class="w-2 h-2 rounded-full bg-[#2A923F] animate-pulse shrink-0"></span>
    @endif
    {{ $slot }}
</span>
