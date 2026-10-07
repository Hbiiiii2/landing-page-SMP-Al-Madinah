@props([
    'profile' => null,
    'ppdbSetting' => null,
])

@php
    $schoolName = $profile->name ?? 'SMP Islam Al-Madinah BSD';
    $foundationName = 'Yayasan Kerukunan Keluarga Muslim BSD';
    $address = $profile->address ?? 'Komplek BSD City Sektor XIV, Tangerang Selatan';
    $phone = $profile->phone ?? '(021) 538-8888';
    $email = $profile->email ?? 'info@smpalmadinah.sch.id';
    $whatsapp = $profile->whatsapp ?? '0812-9988-7766';
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsapp);
    if (str_starts_with($whatsappClean, '0')) {
        $whatsappClean = '62' . substr($whatsappClean, 1);
    }
    $academicYear = $ppdbSetting->academic_year ?? '2027/2028';
    $instagram = $profile->instagram_url ?? 'https://instagram.com';
    $youtube = $profile->youtube_url ?? 'https://youtube.com';
    $facebook = $profile->facebook_url ?? 'https://facebook.com';
    $tiktok = $profile->tiktok_url ?? null;
    $logoSrc = !empty($profile?->logo) ? asset('storage/' . $profile->logo) : asset('images/logo-almadinah.png');
@endphp

<header class="w-full bg-white transition-all duration-200 shadow-sm print:hidden" id="main-header">
    <!-- Top White Bar (Brand Logo + Contact Info + Socials) -->
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 py-3.5 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <!-- Logo & School Brand -->
        <a href="{{ url('/') }}" class="flex items-center gap-3.5 group">
            <img src="{{ $logoSrc }}" 
                 alt="Logo {{ $schoolName }}" 
                 class="w-12 h-12 object-contain shrink-0 group-hover:scale-105 transition-transform"
                 onerror="this.src='https://lh3.googleusercontent.com/aida-public/AB6AXuAmbTzxzgl6wWksQemxIkN-NrASOhgrQ43jj8Ie82Cr-QQ_hO3Nldfe9ifPaO9jd5ShbMBwhbhUe95-6ZJnxMykUPQy1mucK-BSdzNVvAN-PahWS4DL6O6pZ1FEuzzjZek6KT_3GLxGyKhNz4UZcySi6KGAzmo5b4mcmlisOO0y1YY4VOIMWnxczmaESHA2jdQb68UL-7N8WImgP0evy_Cq86tebAneTuXeWKLRBlUDDyshxu9H6sNI'">
            <div>
                <div class="text-lg font-extrabold text-[#0D6B57] tracking-tight leading-none">
                    {{ $schoolName }}
                </div>
                <div class="text-[11px] text-brand-muted mt-1 tracking-wider uppercase font-semibold">
                    {{ $foundationName }} • Sektor XIV BSD
                </div>
            </div>
        </a>

        <!-- Contact Strip & Socials -->
        <div class="hidden md:flex items-center gap-6 text-xs text-brand-muted">
            <!-- Telepon / WhatsApp -->
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-[#EAF4F1] flex items-center justify-center text-[#0D6B57]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <div>
                    <div class="text-[10px] uppercase font-bold text-brand-muted/80">Hubungi Kami</div>
                    <a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="font-bold text-brand-dark hover:text-[#0D6B57] transition-colors">
                        {{ $whatsapp }}
                    </a>
                </div>
            </div>

            <!-- Email -->
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-[#EAF4F1] flex items-center justify-center text-[#0D6B57]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <div class="text-[10px] uppercase font-bold text-brand-muted/80">Kirim Email</div>
                    <span class="font-bold text-brand-dark">{{ $email }}</span>
                </div>
            </div>

            <!-- Social Media Icons -->
            <div class="flex items-center gap-1.5 pl-2 border-l border-brand-border">
                <a href="{{ $facebook }}" target="_blank" class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-[#0D6B57] hover:text-white transition-all">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                        <path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.597 0 9 1.583 9 4.615V8z" />
                    </svg>
                </a>
                <a href="{{ $instagram }}" target="_blank" class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-[#0D6B57] hover:text-white transition-all">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                    </svg>
                </a>
                <a href="{{ $youtube }}" target="_blank" class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-[#0D6B57] hover:text-white transition-all">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                    </svg>
                </a>
                @if ($tiktok)
                <a href="{{ $tiktok }}" target="_blank" class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-[#0D6B57] hover:text-white transition-all" title="TikTok">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                        <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                    </svg>
                </a>
                @endif
            </div>
        </div>

        <!-- Mobile Toggle Button (Visible on mobile) -->
        <button type="button" 
                id="mobile-menu-toggle"
                class="md:hidden self-end p-2 rounded-lg text-brand-dark hover:bg-slate-100 border border-brand-border"
                aria-label="Toggle Menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Main Navigation Bar (Full Deep Green as in reference image) -->
    <nav class="bg-[#0D6B57] text-white">
        <div class="max-w-[1280px] mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex items-center gap-1 lg:gap-2 text-xs font-semibold uppercase tracking-wider py-1">
                    <a href="{{ route('home') }}" class="px-3 py-3 rounded hover:bg-[#08493B] transition-colors {{ request()->routeIs('home') ? 'bg-[#08493B] font-bold text-amber-300' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('about') }}" class="px-3 py-3 rounded hover:bg-[#08493B] transition-colors {{ request()->routeIs('about') ? 'bg-[#08493B] font-bold text-amber-300' : '' }}">
                        Visi & Misi
                    </a>
                    <a href="{{ route('programs') }}" class="px-3 py-3 rounded hover:bg-[#08493B] transition-colors {{ request()->routeIs('programs') ? 'bg-[#08493B] font-bold text-amber-300' : '' }}">
                        Program Pendidikan
                    </a>
                    <a href="{{ url('/#unggulan') }}" class="px-3 py-3 rounded hover:bg-[#08493B] transition-colors">
                        Program Unggulan
                    </a>
                    <a href="{{ route('ppdb.index') }}" class="px-3 py-3 rounded hover:bg-[#08493B] transition-colors text-amber-300 font-bold {{ request()->routeIs('ppdb.*') ? 'bg-[#08493B]' : '' }}">
                        Pendaftaran (SPMB)
                    </a>
                    <a href="{{ route('achievements') }}" class="px-3 py-3 rounded hover:bg-[#08493B] transition-colors {{ request()->routeIs('achievements') ? 'bg-[#08493B] font-bold text-amber-300' : '' }}">
                        Prestasi
                    </a>
                    <a href="{{ route('gallery') }}" class="px-3 py-3 rounded hover:bg-[#08493B] transition-colors {{ request()->routeIs('gallery') ? 'bg-[#08493B] font-bold text-amber-300' : '' }}">
                        Galeri
                    </a>
                    <a href="{{ route('news') }}" class="px-3 py-3 rounded hover:bg-[#08493B] transition-colors {{ request()->routeIs('news*') ? 'bg-[#08493B] font-bold text-amber-300' : '' }}">
                        Berita
                    </a>
                    <a href="{{ url('/#kontak') }}" class="px-3 py-3 rounded hover:bg-[#08493B] transition-colors">
                        Kontak
                    </a>
                </div>

                <!-- Right Quick CTA inside nav -->
                <div class="hidden lg:block py-2">
                    <a href="{{ route('ppdb.index') }}" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#EAA824] hover:bg-amber-500 text-brand-dark font-extrabold text-xs uppercase tracking-wide transition-all shadow-sm">
                        <span>Daftar Sekarang</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Mobile Drawer Menu -->
            <div id="mobile-menu" class="hidden md:hidden py-3 space-y-1 border-t border-emerald-800 text-xs font-semibold uppercase">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded hover:bg-[#08493B]">Beranda</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded hover:bg-[#08493B]">Visi & Misi</a>
                <a href="{{ route('programs') }}" class="block px-3 py-2 rounded hover:bg-[#08493B]">Program Pendidikan</a>
                <a href="{{ url('/#unggulan') }}" class="block px-3 py-2 rounded hover:bg-[#08493B]">Program Unggulan</a>
                <a href="{{ route('ppdb.index') }}" class="block px-3 py-2 rounded hover:bg-[#08493B] text-amber-300 font-bold">Pendaftaran (SPMB)</a>
                <a href="{{ route('achievements') }}" class="block px-3 py-2 rounded hover:bg-[#08493B]">Prestasi Santri</a>
                <a href="{{ route('gallery') }}" class="block px-3 py-2 rounded hover:bg-[#08493B]">Galeri Kegiatan</a>
                <a href="{{ route('news') }}" class="block px-3 py-2 rounded hover:bg-[#08493B]">Berita</a>
                <a href="{{ url('/#kontak') }}" class="block px-3 py-2 rounded hover:bg-[#08493B]">Kontak</a>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        if (toggleBtn && mobileMenu) {
            toggleBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
