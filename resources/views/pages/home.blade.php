@extends('layouts.public')

@section('title', 'SMP Islam Al-Madinah BSD — Mendidik dengan Adab, Membina dengan Ilmu')
@section('meta_description', 'Portal Resmi SMP Islam Al-Madinah BSD di Sektor XIV BSD City, Serpong, Tangerang Selatan. Memadukan kurikulum nasional, tahfidz Al-Qur\'an, dwibahasa, dan pembentukan karakter Islami unggul.')
@section('canonical', url('/'))

@section('content')
@php
    $schoolName = $profile->name ?? 'SMP Islam Al-Madinah BSD';
    $foundation = 'Islamic Center KKMB • Sektor XIV BSD';
    $academicYear = $ppdbSetting->academic_year ?? '2027/2028';

    // WhatsApp Configuration
    $whatsapp = !empty($profile?->whatsapp) ? $profile->whatsapp : '0812-9988-7766';
    $whatsappClean = $profile?->whatsapp_ppdb_clean ?? '6281299887766';
    $waUrlPanitia = $profile?->whatsapp_panitia_url ?? ('https://wa.me/' . $whatsappClean);

    // Hero Assets
    $heroImageFallback = asset('images/banner-almadinah.png');
    $heroImageSrc = !empty($profile?->hero_image) ? asset('storage/' . $profile->hero_image) : $heroImageFallback;
    $logoSrc = !empty($profile?->logo) ? asset('storage/' . $profile->logo) : asset('images/logo-almadinah.png');

    // Posts distribution
    $featuredPost = $posts->first();
    $recentNews = $posts->take(5);
    $gridPosts = $posts->slice(0, 3);
@endphp

<!-- ========================================================
     01. HERO SECTION (TWILIGHT SKY + EMBLEM + BUILDING BANNER)
     Sesuai Referensi SMAN 2 Kebumen
     ======================================================== -->
<section class="relative bg-gradient-to-b from-[#2E1F42] via-[#48315E] to-[#60427D] text-white pt-12 pb-16 lg:pt-16 lg:pb-20 overflow-hidden">
    <!-- Starfield & Subtle Architectural Glow -->
    <div class="absolute inset-0 pointer-events-none opacity-20">
        <div class="absolute top-6 left-12 w-1.5 h-1.5 bg-white rounded-full"></div>
        <div class="absolute top-16 right-20 w-2 h-2 bg-white rounded-full"></div>
        <div class="absolute top-24 left-1/3 w-1 h-1 bg-amber-200 rounded-full"></div>
        <div class="absolute top-10 right-1/4 w-1.5 h-1.5 bg-white rounded-full"></div>
        <div class="absolute top-32 right-12 w-1 h-1 bg-white rounded-full"></div>
        <div class="absolute top-4 left-1/2 -translate-x-1/2 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <!-- Floating School Crest in the Sky -->
        <div class="inline-flex flex-col items-center justify-center mb-5 sm:mb-6">
            <div class="w-20 h-20 sm:w-28 sm:h-28 rounded-full bg-white/10 p-2 backdrop-blur-md border border-white/20 shadow-2xl flex items-center justify-center">
                <img src="{{ $logoSrc }}" 
                     alt="Logo {{ $schoolName }}" 
                     class="w-16 h-16 sm:w-22 sm:h-22 object-contain drop-shadow"
                     onerror="this.src='{{ asset('images/logo-almadinah.png') }}'">
            </div>
            <div class="mt-2.5 sm:mt-3 text-[11px] sm:text-sm font-bold text-emerald-200 tracking-wider uppercase">
                Yayasan Kerukunan Keluarga Muslim BSD
            </div>
        </div>

        <!-- School Building Visual Banner -->
        <div class="max-w-4xl mx-auto rounded-3xl overflow-hidden border-2 border-white/20 shadow-2xl bg-[#1E142B] p-1.5 sm:p-2 relative group">
            <div class="relative h-60 sm:h-80 md:h-96 rounded-2xl overflow-hidden">
                <img src="{{ $heroImageSrc }}" 
                     alt="Gedung {{ $schoolName }}" 
                     class="w-full h-full object-cover object-center group-hover:scale-102 transition-transform duration-700"
                     onerror="this.src='{{ asset('images/banner-almadinah.png') }}'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-black/20"></div>
                
                <div class="absolute bottom-3 left-3 right-3 sm:bottom-4 sm:left-4 sm:right-4 flex items-center justify-between text-left">
                    <div class="text-white">
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-full text-[9px] sm:text-[10px] font-extrabold uppercase tracking-wider bg-[#2A923F] text-white shadow-sm mb-1">
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span>Akreditasi A Unggul</span>
                        </span>
                        <h1 class="text-base sm:text-2xl font-black text-white drop-shadow-md">
                            SMP Islam Al-Madinah BSD
                        </h1>
                    </div>
                    <a href="{{ route('ppdb.index') }}" 
                       class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#2A923F] hover:bg-[#217333] text-white text-xs font-black uppercase tracking-wider transition-all shadow-lg shrink-0">
                        <span>Daftar PPDB</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Green Ribbon Banner Strip -->
        <div class="max-w-2xl mx-auto -mt-5 sm:-mt-7 relative z-20 px-2 sm:px-0">
            <div class="bg-[#2A923F] text-white py-2.5 sm:py-3.5 px-3 sm:px-6 rounded-2xl shadow-xl border border-[#217333] text-center font-black tracking-wider text-[11px] sm:text-sm uppercase flex items-center justify-center gap-2">
                <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-white animate-pulse shrink-0"></span>
                <span class="truncate sm:whitespace-normal">SMP ISLAM AL-MADINAH BSD • SEKTOR XIV BSD CITY</span>
                <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-white animate-pulse shrink-0"></span>
            </div>
        </div>

        <!-- Mobile Quick CTAs -->
        <div class="mt-4 flex sm:hidden items-center justify-center gap-2.5">
            <a href="{{ route('ppdb.index') }}" 
               class="flex-1 max-w-[200px] py-2.5 px-4 rounded-full bg-[#2A923F] text-white font-extrabold text-xs uppercase tracking-wider shadow-md text-center">
                Daftar PPDB
            </a>
            <a href="{{ route('about') }}" 
               class="flex-1 max-w-[200px] py-2.5 px-4 rounded-full bg-white/15 border border-white/25 text-white font-bold text-xs uppercase tracking-wider text-center">
                Profil Sekolah
            </a>
        </div>
    </div>
</section>

<!-- ========================================================
     02. PROFIL SEKOLAH (SPLIT INTRO SECTION)
     Sesuai Referensi SMAN 2 Kebumen
     ======================================================== -->
<section class="py-14 sm:py-16 bg-white border-b border-[#E7E3EA]">
    <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left: Profil Thumbnail Card -->
            <div class="md:col-span-5 flex justify-center">
                <div class="w-full max-w-sm rounded-2xl border border-[#E7E3EA] p-4 bg-[#FAF9FB] shadow-sm space-y-3">
                    <div class="relative h-60 rounded-xl overflow-hidden bg-slate-100 border border-[#E7E3EA]">
                        <img src="{{ asset('images/banner-almadinah.png') }}" 
                             alt="Profil SMP Islam Al-Madinah BSD" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent flex flex-col justify-end p-4 text-white">
                            <span class="text-[10px] uppercase font-bold text-emerald-300 tracking-wider">PROFIL SEKOLAH</span>
                            <h4 class="text-sm font-black leading-snug">SMP Islam Al-Madinah</h4>
                            <p class="text-[11px] text-white/80">Islamic Center KKMB BSD</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between text-xs text-[#66676B] px-1">
                        <span>NPSN: <strong>20613809</strong></span>
                        <span class="text-[#2A923F] font-bold">Terakreditasi A</span>
                    </div>
                </div>
            </div>

            <!-- Right: Text Description & Action -->
            <div class="md:col-span-7 space-y-4 text-left">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-black text-[#202124] tracking-tight">
                        Profil Sekolah
                    </h2>
                    <div class="w-16 h-1 bg-[#2A923F] rounded-full mt-2"></div>
                </div>

                <p class="text-sm text-[#66676B] leading-relaxed">
                    SMP Islam Al-Madinah BSD berada di bawah naungan <strong>Yayasan Kerukunan Keluarga Muslim BSD (YKKM BSD)</strong>. Kami berkomitmen menyelenggarakan pendidikan holistik yang memadukan keunggulan adab Islami, hafalan Al-Qur'an (Tahfidz), kemahiran dwibahasa (Arab & Inggris), serta penguasaan sains dan teknologi terkini.
                </p>

                <p class="text-sm text-[#66676B] leading-relaxed">
                    Dengan rasio maksimal 24 santri per kelas, proses pembelajaran dirancang personal, interaktif, dan berorientasi pada pembentukan karakter mandiri yang siap bersaing di era global.
                </p>

                <div class="pt-2">
                    <a href="{{ route('about') }}" 
                       class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full border-2 border-[#2A923F] text-[#2A923F] hover:bg-[#2A923F] hover:text-white font-bold text-xs uppercase tracking-wider transition-all shadow-xs">
                        <span>Lihat Profil Lengkap</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ========================================================
     03. WARTA PILIHAN (FEATURED EDITORIAL HIGHLIGHT)
     ======================================================== -->
@if ($featuredPost)
<section class="py-12 bg-[#FAF9FB] border-b border-[#E7E3EA]">
    <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center bg-white rounded-3xl border border-[#E7E3EA] p-6 sm:p-8 shadow-sm">
            
            <!-- Left: Content & Excerpt -->
            <div class="md:col-span-7 space-y-3.5">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-[#EAF6EC] text-[#2A923F] border border-[#CDE8D2]">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span>Warta Pilihan</span>
                </span>
                <h3 class="text-xl sm:text-2xl font-black text-[#202124] leading-snug">
                    {{ $featuredPost->title }}
                </h3>
                <p class="text-xs sm:text-sm text-[#66676B] leading-relaxed line-clamp-3">
                    {{ $featuredPost->excerpt ?: Str::limit(strip_tags($featuredPost->content), 180) }}
                </p>
                <div class="pt-2">
                    <a href="{{ route('news.show', $featuredPost->slug ?: $featuredPost->id) }}" 
                       class="inline-flex items-center gap-2 px-5 py-2 rounded-full border border-[#2A923F] text-[#2A923F] hover:bg-[#2A923F] hover:text-white font-bold text-xs uppercase tracking-wider transition-all">
                        <span>Selengkapnya</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Right: Image Card -->
            <div class="md:col-span-5">
                @php
                    $featImg = $featuredPost->featured_image 
                        ? asset('storage/' . $featuredPost->featured_image) 
                        : 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80';
                @endphp
                <div class="h-56 sm:h-64 rounded-2xl overflow-hidden border border-[#E7E3EA] bg-slate-100 shadow-inner">
                    <img src="{{ $featImg }}" 
                         alt="{{ $featuredPost->title }}" 
                         class="w-full h-full object-cover">
                </div>
            </div>

        </div>
    </div>
</section>
@endif

<!-- ========================================================
     04. ICON QUICK NAVIGATION BAR (OPEN-SOURCE HEROICONS)
     Sesuai Referensi SMAN 2 Kebumen
     ======================================================== -->
<section class="py-10 bg-white border-b border-[#E7E3EA]">
    <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-6 max-w-4xl mx-auto">
            
            <!-- Kejuaraan -->
            <a href="#kejuaraan" 
               class="flex flex-col items-center justify-center p-3.5 sm:p-5 rounded-2xl bg-white border border-[#E7E3EA] hover:border-[#2A923F] shadow-xs hover:shadow-md hover:-translate-y-1 transition-all group">
                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#EAF6EC] text-[#2A923F] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.504-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.982-3.172M15 4.5a3 3 0 11-6 0 3 3 0 016 0zm6 3a3 3 0 11-6 0 3 3 0 016 0zm-12 0a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <span class="mt-2.5 sm:mt-3 text-xs sm:text-sm font-bold text-[#202124] group-hover:text-[#2A923F] transition-colors">
                    Kejuaraan
                </span>
            </a>

            <!-- Ekstrakurikuler -->
            <a href="#ekstrakurikuler" 
               class="flex flex-col items-center justify-center p-3.5 sm:p-5 rounded-2xl bg-white border border-[#E7E3EA] hover:border-[#2A923F] shadow-xs hover:shadow-md hover:-translate-y-1 transition-all group">
                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#EDF4FC] text-[#4779B5] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                </div>
                <span class="mt-2.5 sm:mt-3 text-xs sm:text-sm font-bold text-[#202124] group-hover:text-[#2A923F] transition-colors">
                    Ekstrakurikuler
                </span>
            </a>

            <!-- Berita -->
            <a href="#berita" 
               class="flex flex-col items-center justify-center p-3.5 sm:p-5 rounded-2xl bg-white border border-[#E7E3EA] hover:border-[#2A923F] shadow-xs hover:shadow-md hover:-translate-y-1 transition-all group">
                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#F4F0F7] text-[#9377AD] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                </div>
                <span class="mt-2.5 sm:mt-3 text-xs sm:text-sm font-bold text-[#202124] group-hover:text-[#2A923F] transition-colors">
                    Berita
                </span>
            </a>

            <!-- Agenda -->
            <a href="#agenda" 
               class="flex flex-col items-center justify-center p-3.5 sm:p-5 rounded-2xl bg-white border border-[#E7E3EA] hover:border-[#2A923F] shadow-xs hover:shadow-md hover:-translate-y-1 transition-all group">
                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                </div>
                <span class="mt-2.5 sm:mt-3 text-xs sm:text-sm font-bold text-[#202124] group-hover:text-[#2A923F] transition-colors">
                    Agenda
                </span>
            </a>

        </div>
    </div>
</section>

<!-- ========================================================
     05. KEJUARAAN (ACHIEVEMENTS WITH REAL PHOTO & METRICS)
     Dinamis dari Filament Resource: App\Models\Achievement
     ======================================================== -->
<section id="kejuaraan" class="py-16 bg-[#FAF9FB] border-b border-[#E7E3EA]">
    <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <!-- Section Heading -->
        <div class="text-center space-y-2">
            <h2 class="text-2xl sm:text-3xl font-black text-[#202124] tracking-tight">
                Kejuaraan & Rekam Jejak Prestasi
            </h2>
            <div class="w-14 h-1 bg-[#2A923F] rounded-full mx-auto"></div>
            <p class="text-xs sm:text-sm text-[#66676B] max-w-xl mx-auto">
                Membina potensi santri berprestasi dalam bidang tahfidz Al-Qur'an, sains, riset teknologi, bahasa, dan olahraga.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 items-start max-w-5xl mx-auto">
            
            <!-- Left: Authentic Achievement Stats Card -->
            <div class="md:col-span-5 flex justify-center">
                <div class="w-full max-w-sm bg-gradient-to-br from-[#3E2B52] to-[#543A70] text-white rounded-3xl p-6 sm:p-8 shadow-xl space-y-6 relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-36 h-36 bg-white/5 rounded-full blur-xl pointer-events-none"></div>

                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-amber-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-200">REKAM JEJAK PRESTASI</span>
                            <h3 class="text-base font-black text-white">{{ $profile->name ?? 'SMP Al-Madinah' }}</h3>
                        </div>
                    </div>

                    <!-- Metrics Grid (Dynamic from Database / Profile) -->
                    <div class="grid grid-cols-2 gap-2.5 sm:gap-3.5 pt-2">
                        <div class="p-2.5 sm:p-3.5 rounded-2xl bg-white/10 border border-white/10 text-center">
                            <div class="text-xl sm:text-2xl font-black text-white">
                                {{ $profile->statistic_achievements ?? ($achievements->count() > 0 ? $achievements->count() . '+' : '45+') }}
                            </div>
                            <div class="text-[10px] sm:text-[11px] text-white/80 mt-0.5">Juara Kota & Daerah</div>
                        </div>
                        <div class="p-2.5 sm:p-3.5 rounded-2xl bg-white/10 border border-white/10 text-center">
                            <div class="text-xl sm:text-2xl font-black text-emerald-300">
                                {{ ($nationalAchievementsCount ?? 0) > 0 ? $nationalAchievementsCount . '+' : '12+' }}
                            </div>
                            <div class="text-[10px] sm:text-[11px] text-white/80 mt-0.5">Tingkat Nasional</div>
                        </div>
                        <div class="p-2.5 sm:p-3.5 rounded-2xl bg-white/10 border border-white/10 text-center">
                            <div class="text-xl sm:text-2xl font-black text-amber-300">100%</div>
                            <div class="text-[10px] sm:text-[11px] text-white/80 mt-0.5">Santri Berprestasi</div>
                        </div>
                        <div class="p-2.5 sm:p-3.5 rounded-2xl bg-white/10 border border-white/10 text-center">
                            <div class="text-xl sm:text-2xl font-black text-white">3 Juz</div>
                            <div class="text-[10px] sm:text-[11px] text-white/80 mt-0.5">Target Tahfidz Mutqin</div>
                        </div>
                    </div>

                    <p class="text-xs text-white/80 leading-relaxed italic">
                        {{ $profile->motto ?? '"Membentuk santri berakhlak mulia dengan prestasi akademik dan Al-Qur\'an yang unggul."' }}
                    </p>
                </div>
            </div>

            <!-- Right: Interactive Dynamic Achievement Slider -->
            <div class="md:col-span-7 w-full"
                 id="achievements-carousel"
                 x-data="{
                    activeIndex: 0,
                    total: {{ max($achievements->count(), 1) }},
                    timer: null,
                    init() {
                        this.startAuto();
                    },
                    next() {
                        this.activeIndex = (this.activeIndex + 1) % this.total;
                        this.restartAuto();
                    },
                    prev() {
                        this.activeIndex = (this.activeIndex - 1 + this.total) % this.total;
                        this.restartAuto();
                    },
                    startAuto() {
                        if (this.total > 1) {
                            this.timer = setInterval(() => {
                                this.activeIndex = (this.activeIndex + 1) % this.total;
                            }, 6000);
                        }
                    },
                    stopAuto() {
                        if (this.timer) clearInterval(this.timer);
                    },
                    restartAuto() {
                        this.stopAuto();
                        this.startAuto();
                    }
                 }"
                 @mouseenter="stopAuto()"
                 @mouseleave="startAuto()">

                @if($achievements->isNotEmpty())
                    @foreach($achievements as $index => $achieve)
                        <div id="achievement-item-{{ $index }}"
                             x-show="activeIndex === {{ $index }}"
                             :class="{ 'hidden': activeIndex !== {{ $index }} }"
                             x-cloak
                             class="achievement-item-card bg-white rounded-3xl border border-[#E7E3EA] p-4 sm:p-7 shadow-sm space-y-4 relative {{ $index > 0 ? 'hidden' : '' }}">
                            
                            <!-- Card Header: Rank / Level Badge & Year -->
                            <div class="flex items-center justify-between gap-2">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-[#2A923F] text-white">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/></svg>
                                    <span>{{ $achieve->rank ? $achieve->rank . ' • ' : '' }}{{ $achieve->level_label }}</span>
                                </span>
                                <span class="text-xs font-semibold text-[#66676B] bg-slate-50 px-2.5 py-1 rounded-full border border-slate-200">
                                    Tahun {{ $achieve->year }}
                                </span>
                            </div>

                            <!-- Photo Showcase -->
                            <div class="h-48 sm:h-56 rounded-2xl overflow-hidden bg-slate-100 border border-[#E7E3EA] relative group">
                                <img src="{{ $achieve->photo_url }}" 
                                     alt="{{ $achieve->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>
                                @if(!empty($achieve->category))
                                    <span class="absolute bottom-3 left-3 px-2.5 py-0.5 rounded-md bg-black/60 backdrop-blur-xs text-[10px] font-semibold text-white uppercase tracking-wider">
                                        {{ $achieve->category_label }}
                                    </span>
                                @endif
                            </div>

                            <!-- Title, Student & Details -->
                            <div class="space-y-1.5">
                                <h4 class="text-base sm:text-lg font-black text-[#202124] leading-snug line-clamp-2">
                                    {{ $achieve->title }}
                                </h4>
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-[#66676B]">
                                    <span>Peraih: <strong class="text-[#202124]">{{ $achieve->student_name }}</strong></span>
                                    @if(!empty($achieve->organizer))
                                        <span class="hidden sm:inline text-slate-300">•</span>
                                        <span class="text-slate-500 italic">{{ $achieve->organizer }}</span>
                                    @endif
                                </div>
                                @if(!empty($achieve->description))
                                    <p class="text-xs text-[#66676B] line-clamp-2 leading-relaxed pt-0.5">
                                        {{ $achieve->description }}
                                    </p>
                                @endif
                            </div>

                            <!-- Footer: Link & Dynamic Slider Controls -->
                            <div class="pt-3 flex items-center justify-between border-t border-[#E7E3EA]">
                                <a href="{{ route('achievements') }}" class="text-xs font-bold text-[#2A923F] hover:underline flex items-center gap-1.5 group">
                                    <span>Lihat Semua Kejuaraan</span>
                                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>

                                <div class="flex items-center gap-2">
                                    <span class="text-[11px] font-semibold text-[#66676B] bg-slate-100 px-2.5 py-0.5 rounded-md tabular-nums achievement-counter">
                                        {{ $index + 1 }} / {{ $achievements->count() }}
                                    </span>

                                    <button type="button" 
                                            @click="prev()" 
                                            onclick="if(window.cycleAchievement) window.cycleAchievement(-1)"
                                            class="w-8 h-8 rounded-full border border-[#E7E3EA] flex items-center justify-center text-[#202124] hover:bg-[#2A923F] hover:text-white hover:border-[#2A923F] transition-all text-xs cursor-pointer shadow-2xs" 
                                            title="Prestasi Sebelumnya" 
                                            aria-label="Prestasi Sebelumnya">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    </button>
                                    <button type="button" 
                                            @click="next()" 
                                            onclick="if(window.cycleAchievement) window.cycleAchievement(1)"
                                            class="w-8 h-8 rounded-full border border-[#E7E3EA] flex items-center justify-center text-[#202124] hover:bg-[#2A923F] hover:text-white hover:border-[#2A923F] transition-all text-xs cursor-pointer shadow-2xs" 
                                            title="Prestasi Berikutnya" 
                                            aria-label="Prestasi Berikutnya">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback State -->
                    <div class="bg-white rounded-3xl border border-[#E7E3EA] p-6 sm:p-8 shadow-sm space-y-4 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-50 text-[#2A923F] flex items-center justify-center">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                        </div>
                        <h4 class="text-base font-bold text-[#202124]">Belum Ada Data Prestasi</h4>
                        <p class="text-xs text-[#66676B] max-w-sm mx-auto">
                            Data prestasi dan kejuaraan santri dapat ditambahkan langsung melalui panel admin Filament.
                        </p>
                        <a href="{{ route('achievements') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#2A923F] hover:underline">
                            <span>Buka Etalase Prestasi</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                @endif

            </div>

        </div>
    </div>
</section>

<!-- ========================================================
     06. EKSTRAKURIKULER (WITH ORGANIC CURVED WAVE CONTAINER)
     Dinamis dari Filament Resource: App\Models\Extracurricular
     ======================================================== -->
@php
    $getEkskulMeta = function ($category, $name = '') {
        $text = strtolower(($category ?? '') . ' ' . ($name ?? ''));
        if (str_contains($text, 'wajib') || str_contains($text, 'pramuka') || str_contains($text, 'scout')) {
            return [
                'bg' => 'bg-[#EBF5EE]',
                'text' => 'text-[#2A923F]',
                'type' => 'scout',
            ];
        }
        if (str_contains($text, 'qur') || str_contains($text, 'tahfidz') || str_contains($text, 'agama') || str_contains($text, 'hifdz')) {
            return [
                'bg' => 'bg-[#EAF6EC]',
                'text' => 'text-[#2A923F]',
                'type' => 'quran',
            ];
        }
        if (str_contains($text, 'robot') || str_contains($text, 'sains') || str_contains($text, 'it') || str_contains($text, 'cod') || str_contains($text, 'stem')) {
            return [
                'bg' => 'bg-[#EDF4FC]',
                'text' => 'text-[#4779B5]',
                'type' => 'tech',
            ];
        }
        if (str_contains($text, 'futsal') || str_contains($text, 'bola') || str_contains($text, 'panah') || str_contains($text, 'olahraga') || str_contains($text, 'archery') || str_contains($text, 'silat') || str_contains($text, 'bela diri')) {
            return [
                'bg' => 'bg-[#F4F0F7]',
                'text' => 'text-[#9377AD]',
                'type' => 'sport',
            ];
        }
        if (str_contains($text, 'pmr') || str_contains($text, 'uks') || str_contains($text, 'sehat') || str_contains($text, 'relawan') || str_contains($text, 'medis')) {
            return [
                'bg' => 'bg-red-50',
                'text' => 'text-red-600',
                'type' => 'health',
            ];
        }
        if (str_contains($text, 'bahasa') || str_contains($text, 'speech') || str_contains($text, 'inggris') || str_contains($text, 'arab') || str_contains($text, 'english')) {
            return [
                'bg' => 'bg-amber-50',
                'text' => 'text-amber-600',
                'type' => 'language',
            ];
        }
        if (str_contains($text, 'seni') || str_contains($text, 'desain') || str_contains($text, 'multi') || str_contains($text, 'jurnalistik') || str_contains($text, 'kreatif')) {
            return [
                'bg' => 'bg-purple-50',
                'text' => 'text-purple-600',
                'type' => 'art',
            ];
        }
        return [
            'bg' => 'bg-emerald-50',
            'text' => 'text-[#2A923F]',
            'type' => 'default',
        ];
    };
@endphp

<section id="ekstrakurikuler" class="relative py-16 lg:py-20 bg-white overflow-hidden">
    <!-- Top Curved Wave Separator -->
    <div class="absolute top-0 left-0 right-0 h-10 overflow-hidden leading-none z-10 pointer-events-none">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-10 text-[#FAF9FB] fill-current">
            <path d="M0,0 C150,90 350,-40 500,40 C650,120 900,10 1200,40 L1200,0 L0,0 Z"></path>
        </svg>
    </div>

    <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8 space-y-12 relative z-20">
        <!-- Section Heading -->
        <div class="text-center space-y-2">
            <h2 class="text-2xl sm:text-3xl font-black text-[#202124] tracking-tight">
                Ekstrakurikuler & Pengembangan Diri
            </h2>
            <div class="w-14 h-1 bg-[#2A923F] rounded-full mx-auto"></div>
            <p class="text-xs sm:text-sm text-[#66676B] max-w-xl mx-auto">
                Wadah bakat, karakter, kepemimpinan, dan kecintaan terhadap Al-Qur'an serta sains santri.
            </p>
        </div>

        @if($extracurriculars->isNotEmpty())
            <!-- Dynamic Interactive Component connecting Left Featured Card and Right Grid -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 items-start max-w-5xl mx-auto"
                 id="ekstrakurikuler-container"
                 x-data="{
                    selected: 0,
                    total: {{ $extracurriculars->count() }},
                    next() { this.selected = (this.selected + 1) % this.total },
                    prev() { this.selected = (this.selected - 1 + this.total) % this.total },
                    select(idx) { this.selected = idx }
                 }">
                
                <!-- Left: Interactive Featured Extracurricular Card -->
                <div class="md:col-span-6 flex justify-center w-full">
                    <div class="w-full max-w-md bg-[#FAF9FB] rounded-3xl border border-[#E7E3EA] p-5 sm:p-8 px-8 sm:px-10 text-center space-y-4 sm:space-y-5 shadow-sm relative min-h-[460px] flex flex-col justify-between">
                        
                        <!-- Side Navigation Arrows -->
                        <button type="button" 
                                @click="prev()" 
                                onclick="if(window.cycleEkskul) window.cycleEkskul(-1)"
                                class="absolute left-2.5 sm:left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white border border-[#E7E3EA] text-[#202124] hover:bg-[#2A923F] hover:text-white flex items-center justify-center transition-all shadow-xs cursor-pointer z-10" 
                                title="Ekstrakurikuler Sebelumnya" 
                                aria-label="Ekstrakurikuler Sebelumnya">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button type="button" 
                                @click="next()" 
                                onclick="if(window.cycleEkskul) window.cycleEkskul(1)"
                                class="absolute right-2.5 sm:right-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white border border-[#E7E3EA] text-[#202124] hover:bg-[#2A923F] hover:text-white flex items-center justify-center transition-all shadow-xs cursor-pointer z-10" 
                                title="Ekstrakurikuler Berikutnya" 
                                aria-label="Ekstrakurikuler Berikutnya">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>

                        @foreach($extracurriculars as $index => $ekskul)
                            @php
                                $meta = $getEkskulMeta($ekskul->category, $ekskul->name);
                            @endphp
                            <div id="ekskul-slide-{{ $index }}"
                                 x-show="selected === {{ $index }}"
                                 :class="{ 'hidden': selected !== {{ $index }} }"
                                 x-cloak
                                 class="ekskul-slide-item space-y-4 flex-1 flex flex-col justify-center {{ $index > 0 ? 'hidden' : '' }}">

                                <!-- Photo / Icon Emblem -->
                                @if(!empty($ekskul->image))
                                    <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto rounded-2xl overflow-hidden border-2 border-white shadow-sm bg-white">
                                        <img src="{{ $ekskul->image_url }}" alt="{{ $ekskul->name }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-2xl bg-white border border-[#E7E3EA] p-3 sm:p-4 shadow-2xs flex items-center justify-center {{ $meta['text'] }}">
                                        @if($meta['type'] === 'scout')
                                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21a9 9 0 100-18 9 9 0 000 18z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18.364 5.636l-3.536 8.486-8.485 3.535 3.535-8.485 8.486-3.536z"/></svg>
                                        @elseif($meta['type'] === 'quran')
                                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        @elseif($meta['type'] === 'tech')
                                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        @elseif($meta['type'] === 'sport')
                                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z"/></svg>
                                        @elseif($meta['type'] === 'health')
                                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        @elseif($meta['type'] === 'language')
                                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                        @elseif($meta['type'] === 'art')
                                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 21a4 4 0 01-4-4 4 4 0 014-4h14a4 4 0 014 4 4 4 0 01-4 4H7zm0 0a4 4 0 01-4-4 4 4 0 014-4 4 4 0 014 4 4 4 0 01-4 4zM7 5a2 2 0 100-4 2 2 0 000 4z"/></svg>
                                        @else
                                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                        @endif
                                    </div>
                                @endif

                                <div class="space-y-1.5">
                                    <h3 class="text-lg sm:text-xl font-black text-[#202124] uppercase tracking-wide">
                                        {{ $ekskul->name }}
                                    </h3>
                                    <p class="text-xs text-[#2A923F] font-bold">
                                        {{ $ekskul->category_label }} • SMP Al-Madinah
                                    </p>
                                    
                                    @if(!empty($ekskul->coach_name) || !empty($ekskul->schedule))
                                        <div class="flex flex-wrap items-center justify-center gap-x-3 gap-y-1 text-[11px] text-[#66676B] bg-white py-1 px-3 rounded-full border border-[#E7E3EA] inline-flex max-w-xs mx-auto">
                                            @if(!empty($ekskul->coach_name))
                                                <span><strong>Pelatih:</strong> {{ $ekskul->coach_name }}</span>
                                            @endif
                                            @if(!empty($ekskul->schedule))
                                                <span><strong>Jadwal:</strong> {{ $ekskul->schedule }}</span>
                                            @endif
                                        </div>
                                    @endif

                                    <p class="text-xs text-[#66676B] leading-relaxed max-w-xs mx-auto line-clamp-3">
                                        {{ $ekskul->description ?? 'Membina kemandirian, karakter tangguh, dan potensi santri berlandaskan nilai-nilai Islam.' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        <!-- Bottom Action & Dots -->
                        <div class="pt-2 space-y-3">
                            <div>
                                <a href="{{ route('programs') }}" 
                                   class="inline-flex items-center gap-2 px-6 py-2 rounded-full border border-[#2A923F] text-[#2A923F] hover:bg-[#2A923F] hover:text-white font-bold text-xs uppercase tracking-wider transition-all shadow-2xs">
                                    <span>Lihat Semua Program & Ekskul</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>

                            <!-- Indicator Dots -->
                            <div class="flex items-center justify-center gap-1.5 pt-1">
                                @foreach($extracurriculars as $index => $ekskul)
                                    <button type="button" 
                                            id="ekskul-dot-{{ $index }}"
                                            @click="select({{ $index }})" 
                                            onclick="if(window.selectEkskul) window.selectEkskul({{ $index }})"
                                            :class="selected === {{ $index }} ? 'w-5 bg-[#2A923F]' : 'w-1.5 bg-slate-300 hover:bg-slate-400'"
                                            class="ekskul-dot-indicator h-1.5 rounded-full transition-all cursor-pointer {{ $index === 0 ? 'w-5 bg-[#2A923F]' : 'w-1.5 bg-slate-300 hover:bg-slate-400' }}" 
                                            title="{{ $ekskul->name }}"
                                            aria-label="{{ $ekskul->name }}"></button>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right: Dynamic Grid of Extracurricular Activities from Filament -->
                <div class="md:col-span-6 w-full space-y-3.5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-3.5">
                        @foreach($extracurriculars->take(6) as $index => $item)
                            @php
                                $itemMeta = $getEkskulMeta($item->category, $item->name);
                            @endphp
                            <div id="ekskul-card-{{ $index }}"
                                 @click="select({{ $index }})"
                                 onclick="if(window.selectEkskul) window.selectEkskul({{ $index }})"
                                 :class="selected === {{ $index }} ? 'border-[#2A923F] bg-white ring-2 ring-[#2A923F]/20 shadow-sm' : 'border-[#E7E3EA] bg-[#FAF9FB] hover:border-[#2A923F] hover:bg-white'"
                                 class="ekskul-card-item p-4 rounded-2xl border transition-all space-y-2 group cursor-pointer text-left relative {{ $index === 0 ? 'border-[#2A923F] bg-white ring-2 ring-[#2A923F]/20 shadow-sm' : 'border-[#E7E3EA] bg-[#FAF9FB] hover:border-[#2A923F] hover:bg-white' }}">
                                
                                <div class="flex items-center justify-between">
                                    <div class="w-10 h-10 rounded-xl {{ $itemMeta['bg'] }} {{ $itemMeta['text'] }} flex items-center justify-center p-2">
                                        @if(!empty($item->image))
                                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-full h-full object-cover rounded-lg">
                                        @elseif($itemMeta['type'] === 'scout')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21a9 9 0 100-18 9 9 0 000 18z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18.364 5.636l-3.536 8.486-8.485 3.535 3.535-8.485 8.486-3.536z"/></svg>
                                        @elseif($itemMeta['type'] === 'quran')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        @elseif($itemMeta['type'] === 'tech')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        @elseif($itemMeta['type'] === 'sport')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z"/></svg>
                                        @elseif($itemMeta['type'] === 'health')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        @elseif($itemMeta['type'] === 'language')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                        @elseif($itemMeta['type'] === 'art')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 21a4 4 0 01-4-4 4 4 0 014-4h14a4 4 0 014 4 4 4 0 01-4 4H7zm0 0a4 4 0 01-4-4 4 4 0 014-4 4 4 0 014 4 4 4 0 01-4 4zM7 5a2 2 0 100-4 2 2 0 000 4z"/></svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                        @endif
                                    </div>

                                    <span :class="selected === {{ $index }} ? 'opacity-100 text-[#2A923F] font-bold' : 'opacity-0 group-hover:opacity-100 text-slate-400'"
                                          class="ekskul-card-status text-[10px] uppercase tracking-wider transition-opacity flex items-center gap-1 {{ $index === 0 ? 'opacity-100 text-[#2A923F] font-bold' : 'opacity-0 group-hover:opacity-100 text-slate-400' }}">
                                        <span x-text="selected === {{ $index }} ? 'Aktif' : 'Pilih'">{{ $index === 0 ? 'Aktif' : 'Pilih' }}</span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </span>
                                </div>

                                <div>
                                    <h4 class="text-xs font-bold text-[#202124] group-hover:text-[#2A923F] transition-colors line-clamp-1">
                                        {{ $item->name }}
                                    </h4>
                                    <p class="text-[11px] text-[#66676B] mt-0.5 line-clamp-1">
                                        {{ $item->schedule ?? $item->coach_name ?? $item->category_label }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Right Column Bottom Link -->
                    <div class="pt-2 flex items-center justify-between border-t border-[#E7E3EA]/80">
                        <span class="text-[11px] text-[#66676B]">
                            Tersedia {{ $extracurriculars->count() }} kegiatan ekstrakurikuler santri
                        </span>
                        <a href="{{ route('programs') }}" class="text-xs font-bold text-[#2A923F] hover:underline flex items-center gap-1 group">
                            <span>Buka Halaman Program</span>
                            <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

            </div>
        @else
            <!-- Fallback State -->
            <div class="max-w-md mx-auto bg-[#FAF9FB] rounded-3xl border border-[#E7E3EA] p-8 text-center space-y-4">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-50 text-[#2A923F] flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h4 class="text-base font-bold text-[#202124]">Belum Ada Data Ekstrakurikuler</h4>
                <p class="text-xs text-[#66676B]">
                    Kelola dan tambahkan kegiatan ekstrakurikuler santri melalui menu Filament di panel admin.
                </p>
                <a href="{{ route('programs') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#2A923F] hover:underline">
                    <span>Lihat Halaman Program</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        @endif

    </div>

    <!-- Bottom Curved Wave Separator -->
    <div class="absolute bottom-0 left-0 right-0 h-10 overflow-hidden leading-none z-10 pointer-events-none">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-10 text-[#FAF9FB] fill-current">
            <path d="M0,0 C150,90 350,-40 500,40 C650,120 900,10 1200,40 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- ========================================================
     07. BERITA (NUMBERED LIST 1-5 WITH EDITORIAL CARD)
     Sesuai Referensi SMAN 2 Kebumen
     ======================================================== -->
<section id="berita" class="py-16 bg-[#FAF9FB] border-b border-[#E7E3EA]">
    <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <!-- Section Heading -->
        <div class="text-center space-y-2">
            <h2 class="text-2xl sm:text-3xl font-black text-[#202124] tracking-tight">
                Berita & Warta
            </h2>
            <div class="w-14 h-1 bg-[#2A923F] rounded-full mx-auto"></div>
            <p class="text-xs sm:text-sm text-[#66676B] max-w-xl mx-auto">
                Kanal warta resmi seputar agenda akademik, pengumuman yayasan, dan catatan dinamika santri.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 items-center max-w-5xl mx-auto">
            
            <!-- Left: Editorial Highlights Card (Dinamis dari Warta / Featured Post) -->
            <div class="md:col-span-5 flex justify-center">
                <div class="w-full max-w-sm rounded-3xl bg-white border border-[#E7E3EA] p-6 shadow-sm space-y-4">
                    <div class="flex items-center gap-2 text-xs font-bold text-[#2A923F]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <span>PUBLIKASI TERVERIFIKASI</span>
                    </div>

                    @php
                        $editorialPost = $featuredPost ?? $posts->first();
                        $editorialImg = !empty($editorialPost?->featured_image) 
                            ? (Str::startsWith($editorialPost->featured_image, ['http://', 'https://']) ? $editorialPost->featured_image : asset('storage/' . $editorialPost->featured_image)) 
                            : asset('images/banner-almadinah.png');
                        $editorialUrl = $editorialPost ? route('news.show', $editorialPost->slug ?: $editorialPost->id) : route('news');
                    @endphp

                    <div class="h-44 rounded-2xl overflow-hidden bg-slate-100 border border-[#E7E3EA] relative group">
                        <img src="{{ $editorialImg }}" 
                             alt="{{ $editorialPost?->title ?? 'Warta SMP Islam Al-Madinah BSD' }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @if($editorialPost && $editorialPost->categories->isNotEmpty())
                            <span class="absolute bottom-2.5 left-2.5 px-2.5 py-0.5 rounded-md bg-black/60 backdrop-blur-xs text-[10px] font-semibold text-white uppercase tracking-wider">
                                {{ $editorialPost->categories->first()->name }}
                            </span>
                        @endif
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between text-[10px] text-[#66676B]">
                            <span>{{ $editorialPost?->author?->name ?? 'Humas SMP Islam Al-Madinah BSD' }}</span>
                            @if($editorialPost?->published_at)
                                <span>{{ $editorialPost->published_at->translatedFormat('d M Y') }}</span>
                            @endif
                        </div>
                        <h4 class="text-sm font-black text-[#202124] leading-snug line-clamp-2">
                            <a href="{{ $editorialUrl }}" class="hover:text-[#2A923F] transition-colors">
                                {{ $editorialPost?->title ?? 'Laporan Kegiatan Akademik & Pembiasaan Adab Santri' }}
                            </a>
                        </h4>
                        <p class="text-xs text-[#66676B] leading-relaxed line-clamp-2">
                            {{ $editorialPost?->excerpt ?: (strip_tags($editorialPost?->content ?? '') ?: 'Mendokumentasikan seluruh dinamika kelas dan tahfidz untuk transparansi wali santri.') }}
                        </p>
                    </div>

                    <div class="pt-2 flex items-center justify-between border-t border-[#E7E3EA]">
                        <a href="{{ $editorialUrl }}" class="text-xs font-bold text-[#2A923F] hover:underline flex items-center gap-1.5 group">
                            <span>Baca Selengkapnya</span>
                            <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('news') }}" class="text-[11px] font-semibold text-[#66676B] hover:text-[#2A923F] transition-colors">
                            Buka Arsip Warta
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Numbered 1-5 News List (Dinamis dari Filament CMS) -->
            <div class="md:col-span-7 space-y-3">
                @php
                    $listPosts = $posts->count() > 1 ? $posts->skip(1)->take(5) : $posts->take(5);
                @endphp
                @forelse ($listPosts as $newsItem)
                    @php
                        $newsUrl = route('news.show', $newsItem->slug ?: $newsItem->id);
                        $itemDate = $newsItem->published_at?->translatedFormat('d M Y') ?? $newsItem->created_at?->translatedFormat('d M Y');
                        $itemCat = $newsItem->categories->first()?->name ?? 'Warta Sekolah';
                    @endphp
                    <div class="bg-white rounded-2xl border border-[#E7E3EA] p-3.5 sm:p-4 shadow-2xs hover:border-[#2A923F] hover:shadow-xs transition-all flex items-center gap-3.5 group">
                        <!-- Square Numbered Badge -->
                        <div class="w-10 h-10 rounded-xl border border-[#E7E3EA] bg-[#FAF9FB] group-hover:bg-[#2A923F] group-hover:text-white group-hover:border-[#2A923F] text-[#202124] font-black text-sm flex items-center justify-center shrink-0 transition-colors">
                            {{ sprintf('%02d', $loop->iteration) }}
                        </div>

                        <!-- Title & Meta with Heroicons -->
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs sm:text-sm font-bold text-[#202124] group-hover:text-[#2A923F] transition-colors leading-snug line-clamp-2">
                                <a href="{{ $newsUrl }}" class="hover:underline">
                                    {{ $newsItem->title }}
                                </a>
                            </h4>
                            <div class="flex items-center gap-2 text-[10px] text-[#66676B] mt-1">
                                <span class="font-semibold text-[#2A923F]">{{ $itemCat }}</span>
                                <span class="text-slate-300">•</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 text-[#2A923F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ $itemDate }}</span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ $newsUrl }}" class="text-[#66676B] group-hover:text-[#2A923F] transition-colors shrink-0 p-1" title="Buka warta">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                @empty
                    @php
                        $fallbackNews = [
                            ['title' => 'Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran Baru Resmi Dibuka', 'cat' => 'PPDB Online'],
                            ['title' => 'Santri SMP Islam Al-Madinah Raih Juara 1 Olimpiade Sains & Riset Tingkat Provinsi', 'cat' => 'Prestasi Santri'],
                            ['title' => 'Tasmi\' Akbar 3 Juz Sekali Duduk dan Munaqasyah Tahfidz Al-Qur\'an Angkatan X', 'cat' => 'Keagamaan & Tahfidz'],
                            ['title' => 'Laporan Rekapitulasi dan Transparansi Realisasi Penggunaan Dana BOSP Sekolah', 'cat' => 'Akademik & BOS'],
                            ['title' => 'Workshop Robotika & Coding: Membangun Pemikiran Komputasional Santri di Era AI', 'cat' => 'Sains & Teknologi'],
                        ];
                    @endphp
                    @foreach ($fallbackNews as $index => $item)
                        <div class="bg-white rounded-2xl border border-[#E7E3EA] p-3.5 sm:p-4 shadow-2xs hover:border-[#2A923F] transition-all flex items-center gap-3.5 group">
                            <div class="w-10 h-10 rounded-xl border border-[#E7E3EA] bg-[#FAF9FB] group-hover:bg-[#2A923F] group-hover:text-white group-hover:border-[#2A923F] text-[#202124] font-black text-sm flex items-center justify-center shrink-0 transition-colors">
                                {{ sprintf('%02d', $index + 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs sm:text-sm font-bold text-[#202124] group-hover:text-[#2A923F] transition-colors leading-snug line-clamp-2">
                                    <a href="{{ route('news') }}" class="hover:underline">
                                        {{ $item['title'] }}
                                    </a>
                                </h4>
                                <div class="flex items-center gap-2 text-[10px] text-[#66676B] mt-1">
                                    <span class="font-semibold text-[#2A923F]">{{ $item['cat'] }}</span>
                                    <span class="text-slate-300">•</span>
                                    <span>Warta Sekolah</span>
                                </div>
                            </div>
                            <a href="{{ route('news') }}" class="text-[#66676B] group-hover:text-[#2A923F] transition-colors shrink-0 p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    @endforeach
                @endforelse
            </div>

        </div>
    </div>
</section>

<!-- ========================================================
     08. POSTINGAN (3-COLUMN CARDS WITH CLEAN OPEN-SOURCE ICONS)
     Sesuai Referensi SMAN 2 Kebumen
     ======================================================== -->
<section class="py-16 bg-white border-b border-[#E7E3EA]">
    <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <!-- Section Heading -->
        <div class="text-center space-y-2">
            <h2 class="text-2xl sm:text-3xl font-black text-[#202124] tracking-tight">
                Postingan
            </h2>
            <div class="w-14 h-1 bg-[#2A923F] rounded-full mx-auto"></div>
        </div>

        <!-- 3 Columns Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @forelse ($gridPosts as $postItem)
                @php
                    $postCat = $postItem->categories->first()?->name ?? 'Warta Sekolah';
                    $postImg = $postItem->featured_image 
                        ? asset('storage/' . $postItem->featured_image) 
                        : 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80';
                    $postUrl = route('news.show', $postItem->slug ?: $postItem->id);
                @endphp
                <div class="bg-white rounded-2xl border border-[#E7E3EA] overflow-hidden shadow-xs hover:shadow-md hover:border-[#2A923F] transition-all flex flex-col justify-between group">
                    <div>
                        <div class="h-44 bg-slate-100 relative overflow-hidden">
                            <img src="{{ $postImg }}" 
                                 alt="{{ $postItem->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <span class="absolute top-3 left-3 bg-[#2A923F] text-white px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow inline-flex items-center gap-1">
                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/></svg>
                                <span>{{ ucfirst($postCat) }}</span>
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="text-sm font-bold text-[#202124] group-hover:text-[#2A923F] transition-colors leading-snug line-clamp-2">
                                <a href="{{ $postUrl }}">
                                    {{ $postItem->title }}
                                </a>
                            </h3>
                            <p class="text-xs text-[#66676B] line-clamp-2">
                                {{ $postItem->excerpt ?: Str::limit(strip_tags($postItem->content), 90) }}
                            </p>
                        </div>
                    </div>
                    <div class="px-5 pb-5 pt-1">
                        <a href="{{ $postUrl }}" class="text-xs font-bold text-[#2A923F] hover:underline inline-flex items-center gap-1.5">
                            <span>Baca Lengkap</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-[#E7E3EA] overflow-hidden shadow-xs p-5 text-center space-y-3">
                    <span class="inline-block bg-[#2A923F] text-white px-3 py-1 rounded-full text-[10px] font-bold">DANA BOSP</span>
                    <h4 class="text-xs font-bold text-[#202124]">Laporan Rekapitulasi dan Realisasi Penggunaan Dana BOS</h4>
                </div>
                <div class="bg-white rounded-2xl border border-[#E7E3EA] overflow-hidden shadow-xs p-5 text-center space-y-3">
                    <span class="inline-block bg-[#2A923F] text-white px-3 py-1 rounded-full text-[10px] font-bold">AKADEMIK</span>
                    <h4 class="text-xs font-bold text-[#202124]">Upacara Peringatan Hari Pendidikan dan Prestasi Santri</h4>
                </div>
                <div class="bg-white rounded-2xl border border-[#E7E3EA] overflow-hidden shadow-xs p-5 text-center space-y-3">
                    <span class="inline-block bg-[#2A923F] text-white px-3 py-1 rounded-full text-[10px] font-bold">KEISLAMAN</span>
                    <h4 class="text-xs font-bold text-[#202124]">Tasmi' Akbar dan Ujian Munaqasyah Tahfidz Al-Qur'an</h4>
                </div>
            @endforelse
        </div>

        <!-- Pill Button: Lihat Semua -->
        <div class="text-center pt-2">
            <a href="{{ route('news') }}" 
               class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full border border-[#2A923F] text-[#2A923F] hover:bg-[#2A923F] hover:text-white font-bold text-xs uppercase tracking-wider transition-all shadow-xs">
                <span>Lihat Semua Postingan</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ========================================================
     09. TAG CLOUD / KATEGORI PILLS (OPEN-SOURCE TAG ICON)
     Sesuai Referensi SMAN 2 Kebumen
     ======================================================== -->
<section class="py-10 bg-[#FAF9FB] border-b border-[#E7E3EA]">
    <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-center gap-2.5 max-w-4xl mx-auto">
            @php
                $tags = [
                    'Pramuka', 'Tahfidz Al-Qur\'an', 'OSIS', 'Sains & Robotik', 'Bilingual Class', 
                    'Prestasi Santri', 'PPDB Online', 'Ekstrakurikuler', 'Laboratorium', 
                    'Karakter Islami', 'Adab & Akhlak', 'Futsal', 'Memanah', 'Literasi', 
                    'Buku Pedoman', 'Kantin Sehat'
                ];
            @endphp
            @foreach ($tags as $tag)
                <a href="{{ route('news', ['q' => $tag]) }}" 
                   class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-1.5 sm:py-2 rounded-xl bg-[#2A923F] hover:bg-[#217333] text-white text-[11px] sm:text-xs font-bold transition-all shadow-2xs hover:shadow-xs">
                    <svg class="w-3.5 h-3.5 opacity-85" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <span>{{ $tag }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ========================================================
     10. CONTACT & LOCATION (DOODLE PATTERN + 2-COLUMN CARD)
     Sesuai Referensi SMAN 2 Kebumen
     ======================================================== -->
<section id="kontak" class="py-14 sm:py-16 lg:py-20 bg-slate-100 relative">
    <!-- Subtle Educational Grid Pattern -->
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#202124_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>

    <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl border border-[#E7E3EA] shadow-lg p-5 sm:p-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                
                <!-- Left: Contact Form -->
                <div class="space-y-4">
                    <h3 class="text-xl font-black text-[#202124] text-center md:text-left">
                        Hubungi Kami
                    </h3>
                    <p class="text-xs text-[#66676B]">
                        Sampaikan pertanyaan atau jadwal kunjungan konsultasi langsung dengan tim humas sekolah.
                    </p>

                    <form action="{{ $waUrlPanitia }}" method="GET" target="_blank" class="space-y-3 pt-2">
                        <div>
                            <input type="text" 
                                   name="nama" 
                                   required 
                                   placeholder="Nama Lengkap *" 
                                   class="w-full px-4 py-2.5 rounded-xl border border-[#E7E3EA] text-xs text-[#202124] focus:outline-none focus:border-[#2A923F] focus:ring-1 focus:ring-[#2A923F] bg-[#FAF9FB]">
                        </div>
                        <div>
                            <input type="text" 
                                   name="kontak" 
                                   required 
                                   placeholder="Email / No. WhatsApp *" 
                                   class="w-full px-4 py-2.5 rounded-xl border border-[#E7E3EA] text-xs text-[#202124] focus:outline-none focus:border-[#2A923F] focus:ring-1 focus:ring-[#2A923F] bg-[#FAF9FB]">
                        </div>
                        <div>
                            <textarea name="pesan" 
                                      rows="3" 
                                      required 
                                      placeholder="Pesan atau Pertanyaan Anda..." 
                                      class="w-full px-4 py-2.5 rounded-xl border border-[#E7E3EA] text-xs text-[#202124] focus:outline-none focus:border-[#2A923F] focus:ring-1 focus:ring-[#2A923F] bg-[#FAF9FB]"></textarea>
                        </div>
                        <div>
                            <button type="submit" 
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border border-[#2A923F] text-[#2A923F] hover:bg-[#2A923F] hover:text-white font-bold text-xs uppercase tracking-wider transition-all shadow-xs">
                                <span>Kirim Pesan</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right: School Info & Google Maps Embed -->
                <div class="space-y-4">
                    <div>
                        <h4 class="text-base font-black text-[#202124]">
                            SMP Islam Al-Madinah BSD
                        </h4>
                        <p class="text-xs text-[#66676B] mt-1 leading-relaxed">
                            Komplek BSD City Sektor XIV, Serpong, Kota Tangerang Selatan, Banten
                        </p>
                        <p class="text-xs text-[#2A923F] font-bold mt-1">
                            Telepon: {{ $profile?->phone ?? '(021) 538-8888' }}
                        </p>
                    </div>

                    <!-- Interactive Google Map Frame -->
                    <div class="h-56 rounded-2xl overflow-hidden border border-[#E7E3EA] shadow-inner bg-slate-100">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.8016482813137!2d106.6806782!3d-6.3028731!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fb7a2c56d787%3A0xe543596706903737!2sSMP%20Al%20Madinah%20Islamic%20Center%20KKMB!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Peta Lokasi SMP Islam Al-Madinah BSD">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Fallback script if Alpine.js is not loaded or delayed
    window.cycleAchievement = function(dir) {
        if (window.Alpine) return;
        var cards = document.querySelectorAll('.achievement-item-card');
        if (!cards.length) return;
        var currentIdx = 0;
        cards.forEach(function(card, idx) {
            if (!card.classList.contains('hidden')) {
                currentIdx = idx;
            }
        });
        var nextIdx = (currentIdx + dir + cards.length) % cards.length;
        cards.forEach(function(card, idx) {
            if (idx === nextIdx) {
                card.classList.remove('hidden');
            } else {
                card.classList.add('hidden');
            }
        });
    };

    window.cycleEkskul = function(dir) {
        if (window.Alpine) return;
        var slides = document.querySelectorAll('.ekskul-slide-item');
        if (!slides.length) return;
        var currentIdx = 0;
        slides.forEach(function(slide, idx) {
            if (!slide.classList.contains('hidden')) {
                currentIdx = idx;
            }
        });
        var nextIdx = (currentIdx + dir + slides.length) % slides.length;
        window.selectEkskul(nextIdx);
    };

    window.selectEkskul = function(targetIdx) {
        if (window.Alpine) return;
        var slides = document.querySelectorAll('.ekskul-slide-item');
        var dots = document.querySelectorAll('.ekskul-dot-indicator');
        var cards = document.querySelectorAll('.ekskul-card-item');

        slides.forEach(function(slide, idx) {
            if (idx === targetIdx) {
                slide.classList.remove('hidden');
            } else {
                slide.classList.add('hidden');
            }
        });

        dots.forEach(function(dot, idx) {
            if (idx === targetIdx) {
                dot.className = 'ekskul-dot-indicator h-1.5 rounded-full transition-all cursor-pointer w-5 bg-[#2A923F]';
            } else {
                dot.className = 'ekskul-dot-indicator h-1.5 rounded-full transition-all cursor-pointer w-1.5 bg-slate-300 hover:bg-slate-400';
            }
        });

        cards.forEach(function(card, idx) {
            var statusEl = card.querySelector('.ekskul-card-status');
            if (idx === targetIdx) {
                card.classList.add('border-[#2A923F]', 'bg-white', 'ring-2', 'ring-[#2A923F]/20', 'shadow-sm');
                card.classList.remove('border-[#E7E3EA]', 'bg-[#FAF9FB]');
                if (statusEl) {
                    statusEl.classList.add('opacity-100', 'text-[#2A923F]', 'font-bold');
                    statusEl.classList.remove('opacity-0', 'text-slate-400');
                    var span = statusEl.querySelector('span');
                    if (span) span.innerText = 'Aktif';
                }
            } else {
                card.classList.remove('border-[#2A923F]', 'bg-white', 'ring-2', 'ring-[#2A923F]/20', 'shadow-sm');
                card.classList.add('border-[#E7E3EA]', 'bg-[#FAF9FB]');
                if (statusEl) {
                    statusEl.classList.remove('opacity-100', 'text-[#2A923F]', 'font-bold');
                    statusEl.classList.add('opacity-0', 'text-slate-400');
                    var span = statusEl.querySelector('span');
                    if (span) span.innerText = 'Pilih';
                }
            }
        });
    };
</script>
@endpush

@endsection
