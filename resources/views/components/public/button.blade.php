@props([
    'variant' => 'primary', // primary, secondary, outline, soft, whatsapp, accent, link
    'href' => null,
    'type' => 'button',
    'disabled' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 font-semibold text-sm transition-all rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-1 cursor-pointer';
    
    $variants = [
        'primary' => 'bg-[#9377AD] text-white hover:bg-[#796092] active:bg-[#684681] shadow-sm focus:ring-[#9377AD]/30 disabled:bg-[#E7E3EA] disabled:text-[#66676B] disabled:cursor-not-allowed',
        'secondary' => 'bg-[#2A923F] text-white hover:bg-[#217333] active:bg-[#1E662D] shadow-sm focus:ring-[#2A923F]/30 disabled:bg-[#E7E3EA] disabled:text-[#66676B] disabled:cursor-not-allowed',
        'outline' => 'bg-white border border-[#E7E3EA] text-[#202124] hover:bg-[#FAF9FB] hover:border-[#9377AD]/40 focus:ring-[#9377AD]/20 disabled:border-[#E7E3EA] disabled:text-[#66676B] disabled:cursor-not-allowed',
        'soft' => 'bg-[#F4F0F7] text-[#684681] hover:bg-[#ECE5F2] focus:ring-[#9377AD]/20',
        'whatsapp' => 'bg-[#2A923F] text-white hover:bg-[#217333] shadow-sm focus:ring-[#2A923F]/30',
        'accent' => 'bg-[#4779B5] text-white hover:bg-[#396497] shadow-sm focus:ring-[#4779B5]/30',
        'link' => 'text-[#9377AD] hover:text-[#796092] hover:underline p-0 text-xs font-semibold focus:ring-[#9377AD]/20',
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
