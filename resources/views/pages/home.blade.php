@extends('layouts.public')

@section('title', 'SMP Islam Al-Madinah BSD — Mendidik dengan Adab, Membina dengan Ilmu')

@section('content')
@php
    $schoolName = $profile->name ?? 'SMP Islam Al-Madinah BSD';
    $foundation = 'Yayasan Kerukunan Keluarga Muslim BSD';
    $academicYear = $ppdbSetting->academic_year ?? '2026/2027';

    // Dynamic WhatsApp Sanitization & URLs (Fully customizable via Admin Panel)
    $whatsapp = !empty($profile?->whatsapp) ? $profile->whatsapp : '0812-9988-7766';
    $whatsappClean = $profile?->whatsapp_ppdb_clean ?? '6281299887766';
    $waUrlPanitia = $profile?->whatsapp_panitia_url ?? ('https://wa.me/' . $whatsappClean);
    $waUrlBrosur = $profile?->whatsapp_brosur_url ?? ('https://wa.me/' . $whatsappClean);
    $waUrlBiaya = $profile?->whatsapp_biaya_url ?? ('https://wa.me/' . $whatsappClean);

    // PPDB Online Registration URL
    $ppdbRegistrationUrl = route('ppdb.index');

    // Brochure & Fee files
    $hasBrochure = !empty($profile?->brochure_file);
    $brochureUrl = $hasBrochure ? asset('storage/' . $profile->brochure_file) : null;
    $isBrochurePdf = $hasBrochure && strtolower(pathinfo($profile->brochure_file, PATHINFO_EXTENSION)) === 'pdf';

    $hasPpdbFee = !empty($profile?->ppdb_fee_file);
    $ppdbFeeUrl = $hasPpdbFee ? asset('storage/' . $profile->ppdb_fee_file) : null;
    $isPpdbFeePdf = $hasPpdbFee && strtolower(pathinfo($profile->ppdb_fee_file, PATHINFO_EXTENSION)) === 'pdf';

    // Dynamic QR Code for Quick Scan
    if (!empty($profile?->ppdb_qr_code)) {
        $ppdbQrCodeSrc = asset('storage/' . $profile->ppdb_qr_code);
    } else {
        try {
            $ppdbQrCodeSrc = (new \chillerlan\QRCode\QRCode)->render($ppdbRegistrationUrl);
        } catch (\Throwable $e) {
            $ppdbQrCodeSrc = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($ppdbRegistrationUrl);
        }
    }

    // Hero Heading Photo & Achievement Badge
    $heroImageFallback = 'https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=800&q=80';
    $heroImageSrc = !empty($profile?->hero_image) ? asset('storage/' . $profile->hero_image) : $heroImageFallback;
    $heroBadgeTitle = $profile?->hero_badge_title ?: 'Santri Berprestasi';
    $heroBadgeSubtitle = $profile?->hero_badge_subtitle ?: 'Tahfidz 10 Juz & Juara Sains';
    $heroBadgeTag = $profile?->hero_badge_tag ?: 'Mumtaz';
    $logoSrc = !empty($profile?->logo) ? asset('storage/' . $profile->logo) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuAmbTzxzgl6wWksQemxIkN-NrASOhgrQ43jj8Ie82Cr-QQ_hO3Nldfe9ifPaO9jd5ShbMBwhbhUe95-6ZJnxMykUPQy1mucK-BSdzNVvAN-PahWS4DL6O6pZ1FEuzzjZek6KT_3GLxGyKhNz4UZcySi6KGAzmo5b4mcmlisOO0y1YY4VOIMWnxczmaESHA2jdQb68UL-7N8WImgP0evy_Cq86tebAneTuXeWKLRBlUDDyshxu9H6sNI';
@endphp

<!-- ========================================================
     01. HERO BANNER SECTION (SPMB / PPDB ISLAMIC GREEN BANNER)
     ======================================================== -->
<section class="relative bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#117C65] text-white overflow-hidden py-12 lg:py-20 border-b border-emerald-900">
    <!-- Subtle Background Islamic Pattern & Glows -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>
    <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute left-1/3 top-0 w-80 h-80 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left: Happy Students Visual Frame (5 cols) -->
            <div class="lg:col-span-5 order-2 lg:order-1 flex justify-center">
                <div class="relative w-full max-w-md">
                    <!-- Islamic Arch Frame Backdrop -->
                    <div class="absolute inset-0 bg-white/10 backdrop-blur-sm rounded-t-full border border-white/20 transform -translate-y-2"></div>
                    
                    <div class="relative rounded-t-full overflow-hidden border-4 border-amber-300/40 shadow-2xl bg-gradient-to-b from-emerald-800 to-emerald-950 p-2">
                        <img src="{{ $heroImageSrc }}" 
                             alt="Santri {{ $schoolName }}" 
                             class="w-full h-80 sm:h-96 object-cover object-center rounded-t-full"
                             onerror="this.src='{{ $heroImageFallback }}'">
                        
                        <!-- Floating Student Achievement Badges -->
                        <div class="absolute bottom-6 left-4 right-4 bg-white/95 backdrop-blur-md text-brand-dark p-3.5 rounded-xl shadow-lg border border-amber-200 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 font-extrabold text-sm shadow-sm">
                                    ★
                                </div>
                                <div class="text-left">
                                    <div class="text-xs font-extrabold text-[#0D6B57]">{{ $heroBadgeTitle }}</div>
                                    <div class="text-[10px] text-brand-muted font-medium">{{ $heroBadgeSubtitle }}</div>
                                </div>
                            </div>
                            <span class="text-[11px] font-bold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200 shadow-xs">
                                {{ $heroBadgeTag }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Hero SPMB / PPDB Announcement (7 cols) -->
            <div class="lg:col-span-7 order-1 lg:order-2 space-y-6 text-center lg:text-left">
                <!-- Eyebrow Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/15 border border-white/20 text-xs font-semibold text-emerald-100">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>Penerimaan Santri Baru Tahun Ajaran {{ $academicYear }}</span>
                </div>

                <!-- Big Headline -->
                <div class="space-y-1">
                    <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-amber-300 tracking-tight uppercase drop-shadow-sm">
                        SPMB / PPDB ONLINE
                    </div>
                    <div class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-white tracking-wide">
                        {{ $schoolName }}
                    </div>
                    <div class="text-3xl sm:text-5xl font-extrabold text-amber-400 tracking-wider">
                        {{ $academicYear }}
                    </div>
                </div>

                <p class="text-sm sm:text-base text-emerald-100/90 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    {{ $profile?->tagline ?? 'Membina generasi muslim yang kokoh dalam tauhid, mutqin hafalan Al-Qur\'an bersanad, fasih dwibahasa, serta unggul dalam nalar sains dan teknologi modern.' }}
                </p>

                <!-- Action Button & Schedule Box -->
                <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-3.5">
                    <a href="{{ route('ppdb.index') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-3.5 rounded-full bg-[#EAA824] hover:bg-amber-500 text-brand-dark font-extrabold text-sm uppercase tracking-wide transition-all shadow-lg hover:shadow-xl hover:scale-105 transform">
                        <span>DAFTAR SEKARANG</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>

                    <button type="button" 
                            onclick="openBrosurPpdbModal()" 
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-full bg-white/10 hover:bg-white/20 border border-white/25 text-white font-bold text-sm transition-all cursor-pointer">
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        <span>Unduh Brosur</span>
                        @if ($hasBrochure)
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        @endif
                    </button>

                    <a href="{{ $waUrlPanitia }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 border border-white/25 text-white font-bold text-sm transition-all">
                        <svg class="w-4 h-4 fill-current text-emerald-300" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.181-.076.355.101.173.449.742.964 1.201.662.591 1.221.774 1.394.861.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.174.231-.145.39-.087s1.011.477 1.184.564.289.13.332.203c.043.072.043.419-.101.824z" />
                        </svg>
                        <span>Konsultasi WA</span>
                    </a>

                    @if(!empty($profile?->youtube_embed) || !empty($profile?->hero_video_url))
                    <a href="#video-profil" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-full bg-amber-400/20 hover:bg-amber-400/30 border border-amber-300/40 text-amber-200 font-bold text-sm transition-all shadow-sm hover:scale-[1.02]" title="Tonton Video Profil">
                        <svg class="w-4 h-4 fill-current text-amber-300" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        <span>Video Profil</span>
                    </a>
                    @endif
                </div>

                <!-- Info Box (Schedule & QR Quick Scan) -->
                <div class="mt-6 bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-left space-y-1">
                        <div class="text-xs font-bold text-amber-300 uppercase tracking-wider">Jadwal Gelombang 1</div>
                        <div class="text-sm font-bold text-white">Oktober 2026 – Januari 2027</div>
                        <div class="text-xs text-emerald-200">Kuota Terbatas: {{ $ppdbSetting?->total_quota ?? 120 }} Santri (5 Kelas @ 24 Siswa)</div>
                    </div>

                    <!-- Fitur Scan untuk Daftar Cepat (Aktif & Interaktif) -->
                    <button type="button" 
                            onclick="openPpdbQrModal()"
                            class="group flex items-center gap-3 bg-white hover:bg-emerald-50 active:scale-95 p-2 sm:p-2.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 border border-emerald-100 text-brand-dark shrink-0 cursor-pointer text-left focus:outline-none focus:ring-2 focus:ring-amber-400"
                            title="Klik untuk membuka QR Code Pendaftaran Cepat">
                        <div class="w-12 h-12 bg-white rounded-lg p-0.5 border border-emerald-200 flex items-center justify-center overflow-hidden shrink-0 shadow-inner group-hover:scale-105 transition-transform">
                            <img src="{{ $ppdbQrCodeSrc }}" alt="QR Code PPDB" class="w-full h-full object-contain">
                        </div>
                        <div class="leading-tight pr-1">
                            <div class="text-[11px] font-bold text-[#0D6B57] flex items-center gap-1 group-hover:text-emerald-800">
                                <span>Scan untuk</span>
                                <svg class="w-3 h-3 text-amber-500 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                            <div class="text-[11px] font-extrabold text-brand-dark">
                                Daftar Cepat
                            </div>
                            <div class="text-[9px] text-emerald-600 font-semibold flex items-center gap-1 mt-0.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Klik / Scan HP</span>
                            </div>
                        </div>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ========================================================
     MODAL POPUP: SCAN QR CODE DAFTAR CEPAT PPDB ONLINE
     ======================================================== -->
<div id="ppdb-qr-modal" 
     class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm transition-opacity duration-300"
     role="dialog" 
     aria-modal="true" 
     aria-labelledby="qr-modal-title">
    
    <!-- Modal Card Box -->
    <div class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl border border-emerald-100 overflow-hidden transform transition-all duration-300 scale-95 opacity-0"
         id="ppdb-qr-modal-box">
        
        <!-- Header with Islamic Emerald Gradient -->
        <div class="bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#117C65] text-white p-5 sm:p-6 text-center relative">
            <button type="button" 
                    onclick="closePpdbQrModal()" 
                    class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 active:bg-white/30 text-white flex items-center justify-center transition-all cursor-pointer focus:outline-none"
                    aria-label="Tutup modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-[11px] font-semibold text-emerald-100 mb-2">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                <span>SPMB / PPDB Online {{ $academicYear }}</span>
            </div>
            <h3 id="qr-modal-title" class="text-lg sm:text-xl font-extrabold text-white tracking-tight">
                Scan untuk Daftar Cepat
            </h3>
            <p class="text-xs text-emerald-100/90 mt-1 max-w-xs mx-auto">
                {{ $schoolName }}
            </p>
        </div>

        <!-- Body with QR Code & Scanner Directions -->
        <div class="p-6 sm:p-7 space-y-5 text-center">
            <!-- QR Frame -->
            <div class="inline-block relative p-3 sm:p-4 bg-white rounded-2xl border-2 border-emerald-100 shadow-md">
                <div class="w-48 h-48 sm:w-56 sm:h-56 mx-auto flex items-center justify-center overflow-hidden bg-white">
                    <img id="ppdb-qr-modal-image" 
                         src="{{ $ppdbQrCodeSrc }}" 
                         alt="QR Code PPDB {{ $schoolName }}" 
                         class="w-full h-full object-contain">
                </div>
                <div class="mt-2 text-[11px] font-bold text-[#0D6B57] flex items-center justify-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                    <span>Arahkan Kamera HP / Google Lens ke Sini</span>
                </div>
            </div>

            <!-- Direction explanation -->
            <p class="text-xs text-slate-600 leading-relaxed max-w-sm mx-auto">
                Buka kamera smartphone Anda (Android / iPhone) lalu arahkan ke kode QR di atas untuk langsung membuka formulir pendaftaran PPDB tanpa repot mengetik link.
            </p>

            <!-- URL Copy Box -->
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-2.5 flex items-center justify-between gap-2 text-left">
                <div class="truncate text-xs text-slate-600 font-mono pl-1 select-all">
                    {{ $ppdbRegistrationUrl }}
                </div>
                <button type="button" 
                        onclick="copyPpdbUrl('{{ $ppdbRegistrationUrl }}')" 
                        id="btn-copy-ppdb-url"
                        class="shrink-0 px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-bold text-xs flex items-center gap-1.5 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <span id="copy-text-label">Salin Link</span>
                </button>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-2 gap-3 pt-1">
                <a href="{{ $ppdbRegistrationUrl }}" 
                   class="w-full py-3 px-4 rounded-xl bg-[#EAA824] hover:bg-amber-500 active:bg-amber-600 text-brand-dark font-extrabold text-xs uppercase tracking-wide transition-all shadow-md flex items-center justify-center gap-1.5">
                    <span>Buka Formulir</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
                <a href="{{ $ppdbQrCodeSrc }}" 
                   download="QR-Code-PPDB-{{ \Illuminate\Support\Str::slug($schoolName) }}.{{ str_starts_with($ppdbQrCodeSrc, 'data:image/svg') ? 'svg' : 'png' }}"
                   class="w-full py-3 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 active:bg-slate-300 text-slate-700 font-bold text-xs transition-all flex items-center justify-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Unduh QR</span>
                </a>
            </div>
        </div>

    </div>
</div>

<!-- ========================================================
     MODAL POPUP: UNDUH BROSUR RESMI PPDB ONLINE
     ======================================================== -->
<div id="ppdb-brosur-modal" 
     class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm transition-opacity duration-300"
     role="dialog" 
     aria-modal="true" 
     aria-labelledby="brosur-modal-title">
    
    <!-- Modal Card Box -->
    <div class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl border border-emerald-100 overflow-hidden transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] flex flex-col"
         id="ppdb-brosur-modal-box">
        
        <!-- Header with Islamic Emerald Gradient -->
        <div class="bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#117C65] text-white p-5 sm:p-6 text-center relative shrink-0">
            <button type="button" 
                    onclick="closeBrosurPpdbModal()" 
                    class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 active:bg-white/30 text-white flex items-center justify-center transition-all cursor-pointer focus:outline-none"
                    aria-label="Tutup modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-[11px] font-semibold text-emerald-100 mb-2">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                <span>Brosur Informasi PPDB {{ $academicYear }}</span>
            </div>
            <h3 id="brosur-modal-title" class="text-lg sm:text-xl font-extrabold text-white tracking-tight">
                Unduh Brosur Resmi
            </h3>
            <p class="text-xs text-emerald-100/90 mt-1 max-w-xs mx-auto">
                {{ $schoolName }}
            </p>
        </div>

        <!-- Body with Brochure Details -->
        <div class="p-6 sm:p-7 space-y-5 text-center overflow-y-auto flex-1">
            @if ($hasBrochure)
                @if (!$isBrochurePdf)
                    <!-- Image Preview -->
                    <div class="max-h-64 sm:max-h-72 overflow-hidden rounded-2xl border-2 border-emerald-100 bg-slate-50 shadow-inner group relative">
                        <img src="{{ $brochureUrl }}" 
                             alt="Brosur {{ $schoolName }}" 
                             class="w-full h-full object-contain">
                    </div>
                @else
                    <!-- PDF Document Card -->
                    <div class="p-5 rounded-2xl bg-emerald-50/70 border border-emerald-200 text-left flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-red-100 text-red-600 flex items-center justify-center font-black text-xl shrink-0 shadow-xs">
                            📄
                        </div>
                        <div class="space-y-1">
                            <div class="text-xs font-extrabold text-[#0D6B57]">Dokumen Brosur Resmi (PDF)</div>
                            <div class="text-[11px] text-slate-600 leading-relaxed">
                                Memuat profil sekolah, rincian program tahfidz, kurikulum unggulan, fasilitas kampus, dan alur pendaftaran.
                            </div>
                            <div class="text-[10px] text-emerald-700 font-bold flex items-center gap-1 pt-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>Berkas siap diunduh</span>
                            </div>
                        </div>
                    </div>
                @endif

                <p class="text-xs text-slate-600 leading-relaxed max-w-sm mx-auto">
                    Klik tombol di bawah untuk mengunduh brosur ke perangkat Anda atau konsultasi via WhatsApp jika membutuhkan informasi tambahan.
                </p>

                <!-- Actions for Uploaded Brochure -->
                <div class="space-y-2.5 pt-1">
                    <a href="{{ $brochureUrl }}" 
                       download="Brosur-PPDB-{{ \Illuminate\Support\Str::slug($schoolName) }}"
                       class="w-full py-3.5 px-6 rounded-2xl bg-[#EAA824] hover:bg-amber-500 active:bg-amber-600 text-brand-dark font-extrabold text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        <span>Unduh Berkas Brosur Sekarang</span>
                    </a>

                    <div class="grid grid-cols-2 gap-2.5">
                        <a href="{{ $brochureUrl }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="w-full py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-all flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            <span>Buka di Tab Baru</span>
                        </a>

                        <a href="{{ $waUrlBrosur }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="w-full py-2.5 px-4 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-[#0D6B57] font-bold text-xs transition-all flex items-center justify-center gap-1.5 border border-emerald-200">
                            <svg class="w-3.5 h-3.5 fill-current text-emerald-600" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.181-.076.355.101.173.449.742.964 1.201.662.591 1.221.774 1.394.861.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.174.231-.145.39-.087s1.011.477 1.184.564.289.13.332.203c.043.072.043.419-.101.824z" />
                            </svg>
                            <span>Tanya via WA</span>
                        </a>
                    </div>
                </div>
            @else
                <!-- Fallback when brochure not yet uploaded -->
                <div class="p-6 rounded-2xl bg-amber-50 border border-amber-200 text-center space-y-3">
                    <div class="w-14 h-14 mx-auto rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-2xl font-black">
                        📖
                    </div>
                    <div>
                        <h4 class="text-sm font-extrabold text-[#0D6B57]">Brosur PPDB {{ $academicYear }}</h4>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                            Brosur digital versi terlengkap dapat langsung Anda peroleh secara cepat melalui Sekretariat Panitia PPDB via chat WhatsApp.
                        </p>
                    </div>
                </div>

                <div class="space-y-2.5 pt-1">
                    <a href="{{ $waUrlBrosur }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="w-full py-3.5 px-6 rounded-2xl bg-[#EAA824] hover:bg-amber-500 active:bg-amber-600 text-brand-dark font-extrabold text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 fill-current text-brand-dark" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.181-.076.355.101.173.449.742.964 1.201.662.591 1.221.774 1.394.861.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.174.231-.145.39-.087s1.011.477 1.184.564.289.13.332.203c.043.072.043.419-.101.824z" />
                        </svg>
                        <span>Minta Brosur via WhatsApp</span>
                    </a>

                    <a href="{{ route('ppdb.index') }}" 
                       class="w-full py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-all flex items-center justify-center gap-1.5">
                        <span>Lanjut ke Formulir Online</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            @endif
        </div>

    </div>
</div>

<!-- ========================================================
     MODAL POPUP: RINCIAN BIAYA PPDB ONLINE
     ======================================================== -->
<div id="ppdb-biaya-modal" 
     class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm transition-opacity duration-300"
     role="dialog" 
     aria-modal="true" 
     aria-labelledby="biaya-modal-title">
    
    <!-- Modal Card Box -->
    <div class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl border border-emerald-100 overflow-hidden transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] flex flex-col"
         id="ppdb-biaya-modal-box">
        
        <!-- Header with Islamic Emerald Gradient -->
        <div class="bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#117C65] text-white p-5 sm:p-6 text-center relative shrink-0">
            <button type="button" 
                    onclick="closeBiayaPpdbModal()" 
                    class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 active:bg-white/30 text-white flex items-center justify-center transition-all cursor-pointer focus:outline-none"
                    aria-label="Tutup modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-[11px] font-semibold text-emerald-100 mb-2">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                <span>Transparansi Pembiayaan</span>
            </div>
            <h3 id="biaya-modal-title" class="text-lg sm:text-xl font-extrabold text-white tracking-tight">
                Rincian Biaya PPDB {{ $academicYear }}
            </h3>
            <p class="text-xs text-emerald-100/90 mt-1 max-w-xs mx-auto">
                {{ $schoolName }}
            </p>
        </div>

        <!-- Body with PPDB Fee Details -->
        <div class="p-6 sm:p-7 space-y-5 text-center overflow-y-auto flex-1">
            @if ($hasPpdbFee)
                @if (!$isPpdbFeePdf)
                    <!-- Image Preview -->
                    <div class="max-h-64 sm:max-h-72 overflow-hidden rounded-2xl border-2 border-emerald-100 bg-slate-50 shadow-inner group relative">
                        <img src="{{ $ppdbFeeUrl }}" 
                             alt="Tabel Biaya {{ $schoolName }}" 
                             class="w-full h-full object-contain">
                    </div>
                @else
                    <!-- PDF Document Card -->
                    <div class="p-5 rounded-2xl bg-emerald-50/70 border border-emerald-200 text-left flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-red-100 text-red-600 flex items-center justify-center font-black text-xl shrink-0 shadow-xs">
                            📋
                        </div>
                        <div class="space-y-1">
                            <div class="text-xs font-extrabold text-[#0D6B57]">Dokumen Rincian Biaya Resmi (PDF)</div>
                            <div class="text-[11px] text-slate-600 leading-relaxed">
                                Rincian lengkap biaya pendaftaran, uang pangkal / pengembangan sarana, SPP bulanan, biaya seragam, dan buku paket.
                            </div>
                            <div class="text-[10px] text-emerald-700 font-bold flex items-center gap-1 pt-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>Tersedia untuk diunduh</span>
                            </div>
                        </div>
                    </div>
                @endif

                <p class="text-xs text-slate-600 leading-relaxed max-w-sm mx-auto">
                    Anda dapat mengunduh berkas rincian biaya resmi atau berkonsultasi mengenai skema cicilan dan beasiswa melalui panitia PPDB.
                </p>

                <!-- Actions for Uploaded Fee File -->
                <div class="space-y-2.5 pt-1">
                    <a href="{{ $ppdbFeeUrl }}" 
                       download="Rincian-Biaya-PPDB-{{ \Illuminate\Support\Str::slug($schoolName) }}"
                       class="w-full py-3.5 px-6 rounded-2xl bg-[#EAA824] hover:bg-amber-500 active:bg-amber-600 text-brand-dark font-extrabold text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        <span>Unduh Berkas Rincian Biaya</span>
                    </a>

                    <div class="grid grid-cols-2 gap-2.5">
                        <a href="{{ $ppdbFeeUrl }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="w-full py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-all flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            <span>Buka di Tab Baru</span>
                        </a>

                        <a href="{{ $waUrlBiaya }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="w-full py-2.5 px-4 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-[#0D6B57] font-bold text-xs transition-all flex items-center justify-center gap-1.5 border border-emerald-200">
                            <svg class="w-3.5 h-3.5 fill-current text-emerald-600" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.181-.076.355.101.173.449.742.964 1.201.662.591 1.221.774 1.394.861.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.174.231-.145.39-.087s1.011.477 1.184.564.289.13.332.203c.043.072.043.419-.101.824z" />
                            </svg>
                            <span>Tanya Biaya via WA</span>
                        </a>
                    </div>
                </div>
            @else
                <!-- Fallback when fee schedule not yet uploaded -->
                <div class="p-6 rounded-2xl bg-amber-50 border border-amber-200 text-center space-y-3">
                    <div class="w-14 h-14 mx-auto rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-2xl font-black">
                        💳
                    </div>
                    <div>
                        <h4 class="text-sm font-extrabold text-[#0D6B57]">Rincian Biaya PPDB {{ $academicYear }}</h4>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                            Rincian resmi mengenai uang pangkal, SPP bulanan, subsidi gelombang 1, serta skema beasiswa prestasi/tahfidz dapat Anda konsultasikan langsung bersama Panitia PPDB.
                        </p>
                    </div>
                </div>

                <div class="space-y-2.5 pt-1">
                    <a href="{{ $waUrlBiaya }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="w-full py-3.5 px-6 rounded-2xl bg-[#EAA824] hover:bg-amber-500 active:bg-amber-600 text-brand-dark font-extrabold text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 fill-current text-brand-dark" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.181-.076.355.101.173.449.742.964 1.201.662.591 1.221.774 1.394.861.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.174.231-.145.39-.087s1.011.477 1.184.564.289.13.332.203c.043.072.043.419-.101.824z" />
                        </svg>
                        <span>Konsultasi Biaya via WhatsApp</span>
                    </a>

                    <a href="{{ route('ppdb.index') }}" 
                       class="w-full py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-all flex items-center justify-center gap-1.5">
                        <span>Lanjut ke Formulir Online</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            @endif
        </div>

    </div>
</div>


<!-- ========================================================
     02. TICKER / RUNNING TEXT BAR (Pengumuman Berjalan)
     ======================================================== -->
<div class="bg-white border-b border-brand-border py-2.5 px-4 lg:px-8">
    <div class="max-w-[1280px] mx-auto flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
        <div class="flex items-center gap-2 overflow-hidden">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-[#EAF4F1] text-[#0D6B57] font-bold shrink-0">
                <span class="w-2 h-2 rounded-full bg-[#0D6B57] animate-ping"></span>
                INFO TERBARU:
            </span>
            <span class="text-brand-dark font-medium truncate">
                Penerimaan Siswa Baru (PPDB) SMP Islam Al-Madinah BSD Tahun Ajaran {{ $academicYear }} telah dibuka. Pendaftaran gelombang 1 mendapatkan subsidi perlengkapan belajar.
            </span>
        </div>
        <a href="{{ route('ppdb.index') }}" class="text-[#0D6B57] font-bold hover:underline shrink-0 flex items-center gap-1">
            <span>Informasi Pendaftaran Lengkap</span>
            <span>&gt;</span>
        </a>
    </div>
</div>

<!-- ========================================================
     02B. COUNTER STATISTIK CAPAIAN SEKOLAH
     ======================================================== -->
<section class="py-8 bg-white border-b border-brand-border">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center">
            <div class="p-4 sm:p-5 rounded-2xl bg-[#F8FAF8] border border-brand-border shadow-xs hover:border-[#0D6B57] transition-all">
                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#0D6B57] font-mono">
                    {{ $profile?->statistic_students ?? 350 }}+
                </div>
                <div class="text-xs font-bold text-brand-dark mt-1">Murid Aktif</div>
                <div class="text-[10px] text-brand-muted">Mendapatkan pembinaan intensif</div>
            </div>
            <div class="p-4 sm:p-5 rounded-2xl bg-[#F8FAF8] border border-brand-border shadow-xs hover:border-[#0D6B57] transition-all">
                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#0D6B57] font-mono">
                    {{ $profile?->statistic_teachers ?? 25 }}
                </div>
                <div class="text-xs font-bold text-brand-dark mt-1">Asatidz & Pendidik</div>
                <div class="text-[10px] text-brand-muted">Tersertifikasi & musyrif tahfidz</div>
            </div>
            <div class="p-4 sm:p-5 rounded-2xl bg-[#F8FAF8] border border-brand-border shadow-xs hover:border-[#0D6B57] transition-all">
                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#EAA824] font-mono">
                    {{ $profile?->statistic_achievements ?? 48 }}+
                </div>
                <div class="text-xs font-bold text-brand-dark mt-1">Prestasi Siswa</div>
                <div class="text-[10px] text-brand-muted">Tingkat kota hingga nasional</div>
            </div>
            <div class="p-4 sm:p-5 rounded-2xl bg-[#F8FAF8] border border-brand-border shadow-xs hover:border-[#0D6B57] transition-all">
                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#0D6B57] font-mono">
                    {{ $profile?->statistic_year_founded ?? 2012 }}
                </div>
                <div class="text-xs font-bold text-brand-dark mt-1">Tahun Berdiri</div>
                <div class="text-[10px] text-brand-muted">Akreditasi {{ $profile?->accreditation ?? 'A' }} BAN-S/M</div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     03. TENTANG YAYASAN & 4 QUICK FEATURES (#tentang)
     ======================================================== -->
<section id="tentang" class="py-16 lg:py-20 bg-[#F8FAF8] border-b border-brand-border">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Left: Circular Photo with Ribbon Badge (5 cols) -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-72 sm:w-80 h-72 sm:h-80">
                    <!-- Circle Border Ring -->
                    <div class="absolute inset-0 rounded-full border-4 border-[#0D6B57] p-2">
                        <img src="{{ !empty($profile?->headmaster_photo) ? asset('storage/' . $profile->headmaster_photo) : (!empty($profile?->logo) ? asset('storage/' . $profile->logo) : 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=700&q=80') }}" 
                             alt="{{ $profile?->headmaster_name ?? $schoolName }}" 
                             class="w-full h-full object-cover rounded-full shadow-lg"
                             onerror="this.src='https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=700&q=80'">
                    </div>
                    
                    <!-- Curved Badge Ribbon at bottom -->
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-[#EAA824] text-brand-dark px-6 py-2 rounded-full font-extrabold text-xs uppercase tracking-wider shadow-md whitespace-nowrap border-2 border-white">
                        {{ $profile?->headmaster_name ?? $schoolName }}
                    </div>
                </div>
            </div>

            <!-- Right: Description & Gold Button (7 cols) -->
            <div class="lg:col-span-7 space-y-5 text-left">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0D6B57] tracking-tight">
                        Tentang Profil Sekolah
                    </h2>
                    <h3 class="text-base sm:text-lg font-bold text-brand-dark mt-1">
                        {{ $profile?->tagline ?? 'Mendidik Karakter Cerdas, Beradab, dan Berdaya Saing Global' }}
                    </h3>
                </div>

                @if(!empty($profile?->headmaster_welcome))
                <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-200 text-xs text-brand-dark italic space-y-1">
                    <div class="font-bold text-[#0D6B57] not-italic text-[10px] uppercase tracking-wider">Sambutan Kepala Sekolah ({{ $profile->headmaster_name }}):</div>
                    <p class="leading-relaxed">"{{ Str::limit($profile->headmaster_welcome, 240) }}"</p>
                </div>
                @endif

                <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                    {{ $profile?->about ?? 'SMP Islam Al-Madinah BSD bernaung di bawah Yayasan Kerukunan Keluarga Muslim BSD (YKKM BSD). Didirikan di kawasan asri Sektor XIV BSD City, kami bertekad memberikan layanan pendidikan terpadu yang memadukan kurikulum nasional, penguasaan sains teknologi, serta kedalaman pemahaman agama Islam.' }}
                </p>

                <div class="pt-2">
                    <a href="{{ route('about') }}" 
                       class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-[#EAA824] hover:bg-amber-500 text-brand-dark font-extrabold text-xs uppercase tracking-wider transition-all shadow-sm">
                        <span>SELENGKAPNYA</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        <!-- 4 Quick Feature Cards in a row (Teal header / cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 pt-6">
            <!-- 1. Pendidikan Berkarakter -->
            <div class="bg-white rounded-xl border border-brand-border p-5 shadow-sm hover:border-[#0D6B57] transition-all space-y-3">
                <div class="w-11 h-11 rounded-lg bg-[#EAF4F1] text-[#0D6B57] flex items-center justify-center font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-brand-dark">Pendidikan Berkarakter</h4>
                    <p class="text-xs text-brand-muted mt-1 leading-relaxed">
                        Penanaman adab dan keteladanan akhlak sebelum ilmu dalam seluruh aktivitas belajar.
                    </p>
                </div>
            </div>

            <!-- 2. Pengembangan Bakat -->
            <div class="bg-white rounded-xl border border-brand-border p-5 shadow-sm hover:border-[#0D6B57] transition-all space-y-3">
                <div class="w-11 h-11 rounded-lg bg-[#EAF4F1] text-[#0D6B57] flex items-center justify-center font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-brand-dark">Pengembangan Bakat</h4>
                    <p class="text-xs text-brand-muted mt-1 leading-relaxed">
                        Eksplorasi minat siswa melalui sains, robotika, bahasa, seni islami, dan olahraga.
                    </p>
                </div>
            </div>

            <!-- 3. Program Unggulan -->
            <div class="bg-white rounded-xl border border-brand-border p-5 shadow-sm hover:border-[#0D6B57] transition-all space-y-3">
                <div class="w-11 h-11 rounded-lg bg-[#EAF4F1] text-[#0D6B57] flex items-center justify-center font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-brand-dark">Tahfidz Bersanad</h4>
                    <p class="text-xs text-brand-muted mt-1 leading-relaxed">
                        Halaqah Qur'ani setiap pagi dengan target mutqin 3 hingga 10 Juz bersama musyrif bersertifikat.
                    </p>
                </div>
            </div>

            <!-- 4. Pengajar Berpengalaman -->
            <div class="bg-white rounded-xl border border-brand-border p-5 shadow-sm hover:border-[#0D6B57] transition-all space-y-3">
                <div class="w-11 h-11 rounded-lg bg-[#EAF4F1] text-[#0D6B57] flex items-center justify-center font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-brand-dark">Asatidz Berpengalaman</h4>
                    <p class="text-xs text-brand-muted mt-1 leading-relaxed">
                        Tenaga pendidik tersertifikasi dari universitas terkemuka dalam dan luar negeri.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- ========================================================
     04. PROGRAM PENDIDIKAN (DEEP GREEN SECTION WITH WHITE ARCHED CARDS) (#program)
     ======================================================== -->
<section id="program" class="py-16 lg:py-24 bg-[#0D6B57] text-white">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-12">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                Program Pendidikan
            </h2>
            <p class="text-xs sm:text-sm text-emerald-100">
                Menyediakan jenjang pendidikan menengah pertama Islam terpadu yang adaptif terhadap kurikulum nasional dan tantangan masa depan.
            </p>
        </div>

        <!-- 3 White Arched Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- CARD 1: Program Reguler Kurikulum Merdeka -->
            <div class="bg-white text-brand-dark rounded-2xl overflow-hidden shadow-xl flex flex-col justify-between group">
                <div>
                    <!-- Islamic Arched Top Visual -->
                    <div class="h-48 relative overflow-hidden bg-emerald-100">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80" 
                             alt="Kelas Reguler Merdeka" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <span class="absolute top-3 left-3 bg-[#0D6B57] text-white px-3 py-1 rounded-full text-xs font-bold uppercase">
                            Kelas Reguler
                        </span>
                    </div>

                    <div class="p-6 text-center space-y-3">
                        <h3 class="text-lg font-extrabold text-[#0D6B57]">
                            Kurikulum Merdeka & Sains
                        </h3>
                        <p class="text-xs text-brand-muted leading-relaxed">
                            Mengintegrasikan standar capaian kompetensi Kemendikbudristek dengan pendalaman literasi sains, numerasi, dan proyek penguatan karakter (P5).
                        </p>
                    </div>
                </div>

                <div class="p-6 pt-0 text-center">
                    <a href="{{ route('programs') }}" 
                       class="inline-block w-full py-2.5 rounded-full bg-[#0D6B57] hover:bg-[#08493B] text-white font-bold text-xs uppercase tracking-wider transition-colors shadow">
                        SELENGKAPNYA
                    </a>
                </div>
            </div>

            <!-- CARD 2: Program Tahfidz Bersanad & Bahasa (FEATURED) -->
            <div class="bg-white text-brand-dark rounded-2xl overflow-hidden shadow-2xl flex flex-col justify-between border-2 border-amber-400 group transform md:-translate-y-2">
                <div>
                    <!-- Islamic Arched Top Visual -->
                    <div class="h-48 relative overflow-hidden bg-emerald-100">
                        <img src="https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=600&q=80" 
                             alt="Tahfidz Bersanad & Bahasa" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <span class="absolute top-3 left-3 bg-[#EAA824] text-brand-dark px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                            Program Unggulan
                        </span>
                    </div>

                    <div class="p-6 text-center space-y-3">
                        <h3 class="text-lg font-extrabold text-[#0D6B57]">
                            Tahfidz Bersanad & Bilingual
                        </h3>
                        <p class="text-xs text-brand-muted leading-relaxed">
                            Halaqah Al-Qur'an intensif dengan target hafalan 3 hingga 10 Juz mutqin talaqqi asatidz bersanad, dipadu habituasi bahasa Inggris dan Arab aktif harian.
                        </p>
                    </div>
                </div>

                <div class="p-6 pt-0 text-center">
                    <a href="{{ route('programs') }}" 
                       class="inline-block w-full py-2.5 rounded-full bg-[#EAA824] hover:bg-amber-500 text-brand-dark font-extrabold text-xs uppercase tracking-wider transition-colors shadow">
                        SELENGKAPNYA
                    </a>
                </div>
            </div>

            <!-- CARD 3: STEM & Robotika -->
            <div class="bg-white text-brand-dark rounded-2xl overflow-hidden shadow-xl flex flex-col justify-between group">
                <div>
                    <!-- Islamic Arched Top Visual -->
                    <div class="h-48 relative overflow-hidden bg-emerald-100">
                        <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=600&q=80" 
                             alt="STEM & Robotika" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <span class="absolute top-3 left-3 bg-[#0D6B57] text-white px-3 py-1 rounded-full text-xs font-bold uppercase">
                            Teknologi
                        </span>
                    </div>

                    <div class="p-6 text-center space-y-3">
                        <h3 class="text-lg font-extrabold text-[#0D6B57]">
                            Sains, Robotika & Coding
                        </h3>
                        <p class="text-xs text-brand-muted leading-relaxed">
                            Pengembangan kemampuan computational thinking, merakit robot mikro-kontroler, dan persiapan siswa mengikuti kompetisi teknologi nasional.
                        </p>
                    </div>
                </div>

                <div class="p-6 pt-0 text-center">
                    <a href="{{ route('programs') }}" 
                       class="inline-block w-full py-2.5 rounded-full bg-[#0D6B57] hover:bg-[#08493B] text-white font-bold text-xs uppercase tracking-wider transition-colors shadow">
                        SELENGKAPNYA
                    </a>
                </div>
            </div>

        </div>

        <!-- Pagination dots indicator -->
        <div class="flex items-center justify-center gap-2 pt-4">
            <span class="w-3 h-3 rounded-full bg-amber-400"></span>
            <span class="w-2.5 h-2.5 rounded-full bg-white/40"></span>
            <span class="w-2.5 h-2.5 rounded-full bg-white/40"></span>
        </div>
    </div>
</section>


<!-- ========================================================
     05. MENGAPA MEMILIH KAMI (Checklist & Student Photo)
     ======================================================== -->
<section class="py-16 lg:py-20 bg-white border-b border-brand-border">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8">
        <div class="bg-[#F8FAF8] rounded-3xl border border-brand-border p-8 lg:p-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Left: Checklist Content (7 cols) -->
                <div class="lg:col-span-7 space-y-6">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0D6B57] tracking-tight">
                            Mengapa Memilih SMP Islam Al-Madinah BSD?
                        </h2>
                        <p class="text-xs sm:text-sm text-brand-muted mt-1.5">
                            Komitmen kami dalam menghadirkan lingkungan pendidikan yang kondusif, berprestasi, dan berakhlakul karimah.
                        </p>
                    </div>

                    <!-- Checklist with Gold Dots -->
                    <div class="space-y-3 text-xs sm:text-sm text-brand-dark">
                        <div class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-[#EAA824] text-brand-dark flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5">
                                ✓
                            </span>
                            <span>Kurikulum Terpadu: Paduan Kurikulum Merdeka Nasional & Kurikulum Khas Islam Terpadu.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-[#EAA824] text-brand-dark flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5">
                                ✓
                            </span>
                            <span>Bimbingan intensif Tahfidz Al-Qur'an bersanad talaqqi target 3–10 Juz mutqin.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-[#EAA824] text-brand-dark flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5">
                                ✓
                            </span>
                            <span>Pembiasaan adab dan akhlak mulia dalam pergaulan nyata maupun etika digital.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-[#EAA824] text-brand-dark flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5">
                                ✓
                            </span>
                            <span>Rasio kelas emas: maksimal 24 siswa per kelas demi pendampingan optimal.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-[#EAA824] text-brand-dark flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5">
                                ✓
                            </span>
                            <span>Fasilitas modern: Laboratorium sains, lab CBT, masjid kampus luas, dan arena olahraga.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-[#EAA824] text-brand-dark flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5">
                                ✓
                            </span>
                            <span>Lingkungan belajar yang asri, tenang, dan aman di Komplek Sektor XIV BSD City.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-[#EAA824] text-brand-dark flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5">
                                ✓
                            </span>
                            <span>Dewan asatidz dan pendidik bersertifikasi profesional serta berdedikasi tinggi.</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Cheerful Student Portrait (5 cols) -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative w-full max-w-sm">
                        <img src="{{ $profile?->why_choose_us_image_src ?? 'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=700&q=80' }}" 
                             alt="Siswa Ceria {{ $schoolName }}" 
                             class="w-full h-80 sm:h-96 object-cover rounded-2xl shadow-lg border-4 border-white"
                             onerror="this.src='https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=700&q=80'">
                        <div class="absolute -bottom-4 right-4 bg-white p-3 rounded-xl shadow-md border border-brand-border flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#0D6B57] text-white flex items-center justify-center font-extrabold text-sm">
                                {{ substr($profile?->accreditation ?? 'A', 0, 1) }}
                            </div>
                            <div>
                                <div class="text-xs font-bold text-brand-dark">{{ $profile?->why_choose_us_badge_title ?: 'Akreditasi ' . ($profile?->accreditation ?? 'A') . ' Unggul' }}</div>
                                <div class="text-[10px] text-brand-muted">{{ $profile?->why_choose_us_badge_subtitle ?: 'BAN-S/M Kemendikbud' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- ========================================================
     06. PROGRAM UNGGULAN (6 CARDS WITH TEAL HEADER STRIP) (#unggulan)
     ======================================================== -->
<section id="unggulan" class="py-16 lg:py-24 bg-white border-b border-brand-border">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-12">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0D6B57] tracking-tight">
                Program Unggulan
            </h2>
            <p class="text-xs sm:text-sm text-brand-muted">
                Kembangkan potensi terbaik siswa melalui program unggulan SMP Islam Al-Madinah BSD.
            </p>
        </div>

        <!-- 6 Distinctive Cards (2 Rows x 3 Cols) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- 1. Tahfidz Al-Quran Bersanad -->
            <div class="bg-white rounded-xl border border-brand-border overflow-hidden shadow-sm hover:shadow-md transition-all">
                <div class="bg-[#0D6B57] text-white px-5 py-3 flex items-center gap-3">
                    <span class="text-lg">🌙</span>
                    <h3 class="text-sm font-bold tracking-wide">Tahfidz Al-Qur'an Bersanad</h3>
                </div>
                <div class="p-5 text-xs text-brand-muted leading-relaxed">
                    Halaqah tahfidz intensif setiap pagi dibimbing langsung oleh musyrif dan asatidz bersanad dengan target mutqin 3 hingga 10 Juz pilihan.
                </div>
            </div>

            <!-- 2. Kelas Bilingual -->
            <div class="bg-white rounded-xl border border-brand-border overflow-hidden shadow-sm hover:shadow-md transition-all">
                <div class="bg-[#0D6B57] text-white px-5 py-3 flex items-center gap-3">
                    <span class="text-lg">🗣️</span>
                    <h3 class="text-sm font-bold tracking-wide">Kelas Bilingual Inggris & Arab</h3>
                </div>
                <div class="p-5 text-xs text-brand-muted leading-relaxed">
                    Pembiasaan percakapan harian berbahasa Arab dan Inggris, dilengkapi pelatihan public speaking dan persiapan kompetisi pidato dwibahasa.
                </div>
            </div>

            <!-- 3. Sains & Robotika -->
            <div class="bg-white rounded-xl border border-brand-border overflow-hidden shadow-sm hover:shadow-md transition-all">
                <div class="bg-[#0D6B57] text-white px-5 py-3 flex items-center gap-3">
                    <span class="text-lg">🤖</span>
                    <h3 class="text-sm font-bold tracking-wide">Sains, Coding & Robotika</h3>
                </div>
                <div class="p-5 text-xs text-brand-muted leading-relaxed">
                    Laboratorium sains interaktif, perakitan robot mikrokontroler, dan coding dasar untuk mengasah nalar kritis dan logika komputasional.
                </div>
            </div>

            <!-- 4. Pembinaan Adab & Akhlak -->
            <div class="bg-white rounded-xl border border-brand-border overflow-hidden shadow-sm hover:shadow-md transition-all">
                <div class="bg-[#0D6B57] text-white px-5 py-3 flex items-center gap-3">
                    <span class="text-lg">📖</span>
                    <h3 class="text-sm font-bold tracking-wide">Pembinaan Adab & Akhlak Mulia</h3>
                </div>
                <div class="p-5 text-xs text-brand-muted leading-relaxed">
                    Penanaman adab pergaulan islami, habituasi shalat berjamaah tepat waktu, dzikir ma'tsurat, dan buku pantauan mutaba'ah yaumiyah.
                </div>
            </div>

            <!-- 5. Kepanduan & Leadership Camp -->
            <div class="bg-white rounded-xl border border-brand-border overflow-hidden shadow-sm hover:shadow-md transition-all">
                <div class="bg-[#0D6B57] text-white px-5 py-3 flex items-center gap-3">
                    <span class="text-lg">⛺</span>
                    <h3 class="text-sm font-bold tracking-wide">Kepanduan & Leadership Camp</h3>
                </div>
                <div class="p-5 text-xs text-brand-muted leading-relaxed">
                    Kegiatan kepanduan Pramuka SIT, latihan dasar kepemimpinan (LDK), dan kemah bakti sosial untuk membentuk jiwa mandiri siswa.
                </div>
            </div>

            <!-- 6. Literasi & CBT Digital -->
            <div class="bg-white rounded-xl border border-brand-border overflow-hidden shadow-sm hover:shadow-md transition-all">
                <div class="bg-[#0D6B57] text-white px-5 py-3 flex items-center gap-3">
                    <span class="text-lg">💻</span>
                    <h3 class="text-sm font-bold tracking-wide">Literasi Digital & Ujian CBT</h3>
                </div>
                <div class="p-5 text-xs text-brand-muted leading-relaxed">
                    Pemanfaatan e-library, platform e-learning modern, dan sistem ujian berbasis komputer (CBT) dengan koneksi serat optik dedicated.
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ========================================================
     07. DAFTAR SEKARANG JUGA! (4-PHOTO COLLAGE + CTA PPDB)
     ======================================================== -->
<section class="py-16 lg:py-20 bg-[#F8FAF8] border-b border-brand-border">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Left: 4-Photo Collage (5 cols) -->
            <div class="lg:col-span-5">
                <div class="grid grid-cols-2 gap-3.5 max-w-md mx-auto">
                    <img src="{{ $profile?->getCtaCollageImage(1) ?? 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=400&q=80' }}" 
                         alt="Foto Siswa 1" 
                         class="w-full h-36 sm:h-44 object-cover rounded-2xl shadow-sm"
                         onerror="this.src='https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=400&q=80'">
                    <img src="{{ $profile?->getCtaCollageImage(2) ?? 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=400&q=80' }}" 
                         alt="Foto Siswa 2" 
                         class="w-full h-36 sm:h-44 object-cover rounded-2xl shadow-sm"
                         onerror="this.src='https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=400&q=80'">
                    <img src="{{ $profile?->getCtaCollageImage(3) ?? 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=400&q=80' }}" 
                         alt="Foto Siswa 3" 
                         class="w-full h-36 sm:h-44 object-cover rounded-2xl shadow-sm"
                         onerror="this.src='https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=400&q=80'">
                    <img src="{{ $profile?->getCtaCollageImage(4) ?? 'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=400&q=80' }}" 
                         alt="Foto Siswa 4" 
                         class="w-full h-36 sm:h-44 object-cover rounded-2xl shadow-sm"
                         onerror="this.src='https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=400&q=80'">
                </div>
            </div>

            <!-- Right: Title + 4 Pill Buttons (7 cols) -->
            <div class="lg:col-span-7 space-y-6 text-left">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0D6B57] tracking-tight leading-tight">
                        Daftar SMP Islam Al-Madinah BSD <br>
                        <span class="text-amber-500">Sekarang Juga!</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-brand-muted mt-2 leading-relaxed">
                        Segera daftarkan putra-putri Anda pada Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran {{ $academicYear }}. Kuota terbatas demi menjamin kualitas pendidikan terbaik.
                    </p>
                </div>

                <!-- 4 Action Pill Buttons -->
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('ppdb.index') }}" 
                       class="px-5 py-2.5 rounded-full bg-[#0D6B57] hover:bg-[#08493B] active:scale-95 text-white font-extrabold text-xs uppercase tracking-wide transition-all shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>DAFTAR ONLINE</span>
                    </a>

                    <button type="button" 
                            onclick="openBrosurPpdbModal()" 
                            class="px-5 py-2.5 rounded-full bg-[#0D6B57] hover:bg-[#08493B] active:scale-95 text-white font-extrabold text-xs uppercase tracking-wide transition-all shadow-sm flex items-center gap-2 cursor-pointer">
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        <span>UNDUH BROSUR</span>
                        @if ($hasBrochure)
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        @endif
                    </button>

                    <button type="button" 
                            onclick="openBiayaPpdbModal()" 
                            class="px-5 py-2.5 rounded-full bg-[#0D6B57] hover:bg-[#08493B] active:scale-95 text-white font-extrabold text-xs uppercase tracking-wide transition-all shadow-sm flex items-center gap-2 cursor-pointer">
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>BIAYA PPDB</span>
                        @if ($hasPpdbFee)
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        @endif
                    </button>

                    <a href="{{ $waUrlPanitia }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="px-5 py-2.5 rounded-full bg-[#EAA824] hover:bg-amber-500 active:scale-95 text-brand-dark font-extrabold text-xs uppercase tracking-wide transition-all shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 fill-current text-brand-dark" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.181-.076.355.101.173.449.742.964 1.201.662.591 1.221.774 1.394.861.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.174.231-.145.39-.087s1.011.477 1.184.564.289.13.332.203c.043.072.043.419-.101.824z" />
                        </svg>
                        <span>CHAT WA PANITIA</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ========================================================
     08. GALERI KEGIATAN (PHOTO GRID) (#galeri)
     ======================================================== -->
<section id="galeri" class="py-16 lg:py-24 bg-white border-b border-brand-border">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-10">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0D6B57] tracking-tight">
                Galeri Kegiatan
            </h2>
            <p class="text-xs sm:text-sm text-brand-muted">
                Dokumentasi dinamika pembelajaran, pembiasaan ibadah, dan keceriaan siswa di kampus Al-Madinah BSD.
            </p>
        </div>

        <!-- 3 Rows x 4 Cols (12 Photos) Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3.5">
            @php
                $galleryPhotos = [
                    'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=400&q=80',
                ];
            @endphp

            @foreach ($galleryPhotos as $photo)
                <div class="h-36 sm:h-44 rounded-xl overflow-hidden shadow-sm group relative">
                    <img src="{{ $photo }}" 
                         alt="Kegiatan Siswa" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                        SMP Al-Madinah
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center pt-2">
            <a href="{{ route('gallery') }}" class="text-xs font-bold text-[#0D6B57] hover:underline uppercase tracking-wider inline-flex items-center gap-1">
                <span>LIHAT SEMUA FOTO</span>
                <span>&gt;</span>
            </a>
        </div>
    </div>
</section>


<!-- ========================================================
     08B. MULTIMEDIA RESMI: VIDEO PROFIL & INSTAGRAM RESMI (#video-profil / #media)
     ======================================================== -->
<section id="video-profil" class="py-16 lg:py-24 bg-gradient-to-b from-[#F7FAF9] via-white to-[#F7FAF9] border-b border-brand-border relative overflow-hidden">
    <!-- Subtle Background Glows -->
    <div class="absolute -top-24 right-0 w-96 h-96 bg-emerald-100/40 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 left-0 w-96 h-96 bg-amber-100/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 relative z-10 space-y-12">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-[#0D6B57] text-xs font-bold uppercase tracking-wider">
                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                <span>MULTIMEDIA & KABAR MEDIA SOSIAL</span>
            </div>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0D6B57] tracking-tight">
                Video Profil & Aktivitas Terkini
            </h2>
            <p class="text-xs sm:text-sm text-brand-muted">
                Saksikan lingkungan belajar, pembinaan akhlak santri, dan ikuti kabar terbaru SMP Al-Madinah langsung melalui saluran YouTube dan Instagram resmi kami.
            </p>
        </div>

        <!-- 2-Columns Grid: Video Profil & Instagram Embed -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            <!-- LEFT (7 Cols): YouTube Video Profile Player -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-7 shadow-lg border border-emerald-100/80 hover:shadow-xl transition-shadow flex flex-col justify-between">
                <div class="space-y-4">
                    <!-- Card Top Header -->
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 shadow-xs">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-slate-900 leading-snug">
                                    Video Profil SMP Al-Madinah
                                </h3>
                                <p class="text-xs text-brand-muted">
                                    Mengenal lebih dekat lingkungan dan budaya sekolah
                                </p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-700 text-[11px] font-bold border border-rose-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-600 animate-ping"></span>
                            YouTube
                        </span>
                    </div>

                    <!-- Video Player Container (16:9 Aspect Ratio) -->
                    @php
                        $ytEmbedUrl = $profile?->youtube_embed_url;
                        $hasRawIframe = !empty($profile?->youtube_embed) && str_contains($profile->youtube_embed, '<iframe');
                    @endphp

                    @if(!empty($ytEmbedUrl))
                        <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-900 shadow-md border border-slate-200">
                            <iframe 
                                src="{{ $ytEmbedUrl }}" 
                                title="Video Profil {{ $schoolName }}"
                                class="w-full h-full border-0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen
                                loading="lazy">
                            </iframe>
                        </div>
                    @elseif($hasRawIframe)
                        <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-900 shadow-md border border-slate-200 [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
                            {!! $profile->youtube_embed !!}
                        </div>
                    @else
                        <!-- Graceful Fallback if video hasn't been set by admin yet -->
                        <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-gradient-to-tr from-[#08493B] to-[#117C65] shadow-md border border-emerald-800 flex flex-col items-center justify-center text-center p-6 text-white group">
                            <img src="{{ $heroImageSrc }}" alt="{{ $schoolName }}" class="absolute inset-0 w-full h-full object-cover opacity-25 group-hover:scale-105 transition-transform duration-500">
                            <div class="relative z-10 space-y-3">
                                <a href="{{ $profile?->youtube_url ?? 'https://youtube.com' }}" target="_blank" rel="noopener noreferrer" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-white/20 backdrop-blur-md hover:bg-rose-600 text-white flex items-center justify-center mx-auto shadow-2xl transition-all transform hover:scale-110">
                                    <svg class="w-8 h-8 sm:w-10 sm:h-10 fill-current translate-x-0.5" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </a>
                                <div>
                                    <div class="text-base sm:text-lg font-bold text-white drop-shadow-sm">Saksikan Video Profil Sekolah</div>
                                    <div class="text-xs text-emerald-100 drop-shadow-sm">Kunjungi kanal YouTube resmi SMP Al-Madinah</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Video Card Footer -->
                <div class="mt-6 pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-slate-500 text-center sm:text-left">
                        Dukung channel kami dengan menonton kegiatan dan inovasi santri.
                    </p>
                    <a href="{{ $profile?->youtube_url ?? 'https://youtube.com' }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-sm transition-all hover:scale-102 shrink-0">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                        <span>Buka Channel YouTube</span>
                    </a>
                </div>
            </div>

            <!-- RIGHT (5 Cols): Instagram Feed / Post Embed -->
            <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-7 shadow-lg border border-pink-100/80 hover:shadow-xl transition-shadow flex flex-col justify-between">
                <div class="space-y-4">
                    <!-- Card Top Header -->
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 flex items-center justify-center text-white shadow-xs">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-slate-900 leading-snug">
                                    Instagram Resmi
                                </h3>
                                <p class="text-xs text-brand-muted">
                                    {{ '@' . ($profile?->instagram_handle ?? 'smpalmadinah') }}
                                </p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-pink-50 text-pink-700 text-[11px] font-bold border border-pink-200">
                            Terbaru
                        </span>
                    </div>

                    <!-- Instagram Embed Container -->
                    @php
                        $igHtml = $profile?->getInstagramEmbedHtml();
                    @endphp

                    @if(!empty($igHtml))
                        <div class="w-full flex justify-center items-center py-2 min-h-[380px] max-h-[520px] overflow-y-auto rounded-2xl bg-slate-50 border border-slate-100">
                            {!! $igHtml !!}
                        </div>
                    @else
                        <!-- Graceful Fallback if Instagram Embed not configured yet -->
                        <div class="rounded-2xl p-5 bg-gradient-to-b from-slate-50 to-white border border-slate-200 space-y-4">
                            <!-- Account Snapshot -->
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full p-0.5 bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600">
                                    <img src="{{ $logoSrc }}" alt="Logo" class="w-full h-full object-contain rounded-full bg-white p-1">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-sm font-extrabold text-slate-900 truncate">{{ $schoolName }}</span>
                                        <svg class="w-4 h-4 text-sky-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="text-xs text-brand-muted truncate">{{ '@' . ($profile?->instagram_handle ?? 'smpalmadinah') }}</p>
                                </div>
                            </div>

                            <p class="text-xs text-slate-600 leading-relaxed">
                                Ikuti dokumentasi visual, reels motivasi santri, liputan prestasi, dan info pendaftaran PPDB terhangat langsung dari tim humas kami.
                            </p>

                            <!-- Mini Photo Grid Mockup -->
                            <div class="grid grid-cols-3 gap-2 pt-1">
                                <div class="aspect-square rounded-xl overflow-hidden bg-slate-100 border border-slate-200">
                                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=300&q=80" alt="Santri" class="w-full h-full object-cover hover:scale-105 transition-transform">
                                </div>
                                <div class="aspect-square rounded-xl overflow-hidden bg-slate-100 border border-slate-200">
                                    <img src="https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=300&q=80" alt="Kegiatan" class="w-full h-full object-cover hover:scale-105 transition-transform">
                                </div>
                                <div class="aspect-square rounded-xl overflow-hidden bg-slate-100 border border-slate-200">
                                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=300&q=80" alt="Prestasi" class="w-full h-full object-cover hover:scale-105 transition-transform">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Instagram Card Footer -->
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between gap-3">
                    <p class="text-xs text-slate-500 truncate">
                        {{ '@' . ($profile?->instagram_handle ?? 'smpalmadinah') }}
                    </p>
                    <a href="{{ $profile?->instagram_url ?? 'https://instagram.com' }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full bg-gradient-to-r from-amber-500 via-rose-500 to-purple-600 hover:opacity-95 text-white text-xs font-bold shadow-sm transition-all hover:scale-102 shrink-0">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                        <span>Lihat Instagram</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Instagram Embed Script Loader -->
    <script async src="//www.instagram.com/embed.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.instgrm && window.instgrm.Embeds) {
                window.instgrm.Embeds.process();
            }
        });
    </script>
</section>


<!-- ========================================================
     09. HORIZONTAL PROMO BANNER (Green & Gold Arch Motif)
     ======================================================== -->
<section class="py-10 bg-white">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8">
        <div class="rounded-3xl bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#0A5344] text-white p-6 sm:p-10 shadow-xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 text-center md:text-left z-10">
                <div class="text-xs font-bold uppercase tracking-wider text-amber-300">
                    PENERIMAAN siswa BARU (PPDB)
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    SMP Islam Al-Madinah BSD — {{ $academicYear }}
                </h3>
                <p class="text-xs sm:text-sm text-emerald-100 max-w-xl">
                    Daftarkan ananda sekarang juga. Kuota kelas terbatas 24 siswa per kelas untuk memastikan perhatian penuh dewan asatidz.
                </p>
            </div>

            <div class="flex items-center gap-4 z-10 shrink-0">
                <a href="{{ route('ppdb.index') }}" 
                   class="px-8 py-3.5 rounded-full bg-[#EAA824] hover:bg-amber-500 text-brand-dark font-extrabold text-xs uppercase tracking-wider transition-all shadow-lg hover:scale-105 transform">
                    DAFTAR SEKARANG
                </a>
            </div>

            <!-- Background subtle ornament -->
            <div class="absolute right-0 top-0 bottom-0 w-80 bg-white/5 rounded-l-full pointer-events-none"></div>
        </div>
    </div>
</section>


<!-- ========================================================
     10. INFO TERBARU & BERITA (3 Articles + Sidebar) (#berita)
     ======================================================== -->
<section id="berita" class="py-16 lg:py-24 bg-[#F8FAF8] border-b border-brand-border">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-10">
        <div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0D6B57] tracking-tight">
                Info Terbaru & Berita
            </h2>
            <p class="text-xs sm:text-sm text-brand-muted mt-1">
                Kabar terkini seputar aktivitas pembelajaran, prestasi siswa, dan pengumuman sekolah.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: 3 Articles Grid (8 cols) -->
            <div class="lg:col-span-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    @forelse ($posts ?? [] as $post)
                        @php
                            $catName = $post->categories->first()?->name ?? 'Warta';
                            $imgSrc = $post->featured_image 
                                ? asset('storage/' . $post->featured_image) 
                                : 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=500&q=80';
                            $postUrl = route('news.show', $post->slug ?: $post->id);
                            $dateStr = $post->published_at?->translatedFormat('d F Y') ?? $post->created_at?->translatedFormat('d F Y');
                            $authorStr = $post->author?->name ?? 'Humas';
                            $excerptStr = $post->excerpt ?: Str::limit(strip_tags($post->content), 90);
                        @endphp
                        <!-- Dynamic Article Card -->
                        <div class="bg-white rounded-xl border border-brand-border overflow-hidden shadow-sm hover:border-[#0D6B57] transition-all flex flex-col justify-between group">
                            <div>
                                <div class="h-36 bg-slate-100 overflow-hidden relative">
                                    <img src="{{ $imgSrc }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                         onerror="this.src='https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=500&q=80'">
                                    <span class="absolute top-2.5 left-2.5 bg-[#0D6B57] text-white px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">
                                        {{ ucfirst($catName) }}
                                    </span>
                                </div>
                                <div class="p-4 space-y-1.5">
                                    <div class="text-[10px] text-brand-muted">{{ $dateStr }} • {{ $authorStr }}</div>
                                    <h4 class="text-xs font-bold text-brand-dark group-hover:text-[#0D6B57] transition-colors leading-snug line-clamp-2">
                                        <a href="{{ $postUrl }}">
                                            {{ $post->title }}
                                        </a>
                                    </h4>
                                    <p class="text-[11px] text-brand-muted line-clamp-2 leading-relaxed">
                                        {{ $excerptStr }}
                                    </p>
                                </div>
                            </div>
                            <div class="px-4 pb-3 pt-1">
                                <a href="{{ $postUrl }}" class="text-[11px] font-bold text-[#0D6B57] hover:underline inline-flex items-center gap-1">
                                    <span>Baca Selengkapnya</span>
                                    <span>&gt;</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <!-- Fallback jika belum ada berita CMS -->
                        <div class="bg-white rounded-xl border border-brand-border overflow-hidden shadow-sm hover:border-[#0D6B57] transition-all flex flex-col justify-between group">
                            <div>
                                <div class="h-36 bg-slate-100 overflow-hidden relative">
                                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=500&q=80" 
                                         alt="Berita 1" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                </div>
                                <div class="p-4 space-y-1.5">
                                    <div class="text-[10px] text-brand-muted">Humas Al-Madinah</div>
                                    <h4 class="text-xs font-bold text-brand-dark group-hover:text-[#0D6B57] transition-colors leading-snug">
                                        Pelepasan Kontingen Siswa Jambore Sains & Tahfidz Banten
                                    </h4>
                                    <p class="text-[11px] text-brand-muted line-clamp-2">
                                        Sebanyak 15 siswa terpilih siap berkompetisi pada ajang sains dan tahfidz tingkat wilayah.
                                    </p>
                                </div>
                            </div>
                            <div class="px-4 pb-3 pt-1">
                                <a href="{{ route('news') }}" class="text-[11px] font-bold text-[#0D6B57] hover:underline">
                                    Baca Selengkapnya &gt;
                                </a>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl border border-brand-border overflow-hidden shadow-sm hover:border-[#0D6B57] transition-all flex flex-col justify-between group">
                            <div>
                                <div class="h-36 bg-slate-100 overflow-hidden relative">
                                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=500&q=80" 
                                         alt="Berita 2" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                </div>
                                <div class="p-4 space-y-1.5">
                                    <div class="text-[10px] text-brand-muted">PPDB Al-Madinah</div>
                                    <h4 class="text-xs font-bold text-brand-dark group-hover:text-[#0D6B57] transition-colors leading-snug">
                                        Open House & Parenting Talkshow Pendidikan Adab Digital
                                    </h4>
                                    <p class="text-[11px] text-brand-muted line-clamp-2">
                                        Mengenal lebih dekat kurikulum tahfidz bersanad dan sistem pendampingan siswa.
                                    </p>
                                </div>
                            </div>
                            <div class="px-4 pb-3 pt-1">
                                <a href="{{ route('news') }}" class="text-[11px] font-bold text-[#0D6B57] hover:underline">
                                    Baca Selengkapnya &gt;
                                </a>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl border border-brand-border overflow-hidden shadow-sm hover:border-[#0D6B57] transition-all flex flex-col justify-between group">
                            <div>
                                <div class="h-36 bg-slate-100 overflow-hidden relative">
                                    <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?auto=format&fit=crop&w=500&q=80" 
                                         alt="Berita 3" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                </div>
                                <div class="p-4 space-y-1.5">
                                    <div class="text-[10px] text-brand-muted">Tahfidz Al-Madinah</div>
                                    <h4 class="text-xs font-bold text-brand-dark group-hover:text-[#0D6B57] transition-colors leading-snug">
                                        Wisuda Khotmil Qur'an & Syahadah Tahfidz Angkatan VIII
                                    </h4>
                                    <p class="text-[11px] text-brand-muted line-clamp-2">
                                        Sebanyak 42 siswa berhasil menyelesaikan setoran hafalan mutqin bersanad.
                                    </p>
                                </div>
                            </div>
                            <div class="px-4 pb-3 pt-1">
                                <a href="{{ route('news') }}" class="text-[11px] font-bold text-[#0D6B57] hover:underline">
                                    Baca Selengkapnya &gt;
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right: Sidebar (4 cols) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Search Box -->
                <div class="bg-white p-4 rounded-xl border border-brand-border shadow-sm">
                    <label class="text-xs font-bold text-brand-dark block mb-2">Cari Informasi</label>
                    <form action="{{ route('news') }}" method="GET" class="relative">
                        <input type="text" 
                               name="q"
                               placeholder="Ketik kata kunci..." 
                               class="w-full px-3.5 py-2 pr-9 rounded-lg border border-brand-border text-xs focus:outline-none focus:border-[#0D6B57]">
                        <button type="submit" class="absolute right-3 top-2.5 text-brand-muted hover:text-[#0D6B57] transition-colors" title="Cari">
                            🔍
                        </button>
                    </form>
                </div>

                <!-- Categories List -->
                <div class="bg-white p-5 rounded-xl border border-brand-border shadow-sm space-y-3">
                    <div class="flex items-center justify-between">
                        <h4 class="text-xs font-bold text-brand-dark uppercase tracking-wider">Kategori Berita</h4>
                        <a href="{{ route('news') }}" class="text-[11px] font-semibold text-[#0D6B57] hover:underline">Lihat Semua</a>
                    </div>
                    <ul class="space-y-2 text-xs text-brand-muted">
                        @forelse ($categories ?? [] as $cat)
                            <li>
                                <a href="{{ route('news', ['kategori' => $cat->slug]) }}" class="hover:text-[#0D6B57] flex items-center justify-between transition-colors">
                                    <span>{{ ucfirst($cat->name) }}</span>
                                    <span class="font-mono text-[11px] text-brand-muted/70">({{ $cat->posts_count }})</span>
                                </a>
                            </li>
                        @empty
                            <li><a href="{{ route('news') }}" class="hover:text-[#0D6B57] flex items-center justify-between"><span>Penerimaan Siswa (PPDB)</span><span class="font-mono text-[11px] text-brand-muted/70">(1)</span></a></li>
                            <li><a href="{{ route('news') }}" class="hover:text-[#0D6B57] flex items-center justify-between"><span>Prestasi & Kejuaraan</span><span class="font-mono text-[11px] text-brand-muted/70">(0)</span></a></li>
                            <li><a href="{{ route('news') }}" class="hover:text-[#0D6B57] flex items-center justify-between"><span>Kegiatan & Dinamika Siswa</span><span class="font-mono text-[11px] text-brand-muted/70">(0)</span></a></li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ========================================================
     11. FORMULIR PENDAFTARAN & KONSULTASI (#ppdb)
     ======================================================== -->
<section id="ppdb" class="py-16 lg:py-24 bg-white border-b border-brand-border">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-10">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-[#0D6B57]">
                FORMULIR ONLINE RESMI
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-brand-dark tracking-tight">
                Pendaftaran & Konsultasi SPMB {{ $academicYear }}
            </h2>
            <p class="text-xs sm:text-sm text-brand-muted">
                Isi formulir di bawah ini untuk memulai proses pendaftaran atau konsultasi langsung dengan panitia PPDB.
            </p>
        </div>

        <div class="bg-[#F8FAF8] rounded-2xl border border-brand-border p-6 sm:p-10 shadow-sm max-w-3xl mx-auto">
            <form action="{{ $profile?->whatsapp_custom_url ?: ('https://wa.me/' . $whatsappClean) }}" method="GET" target="_blank" class="space-y-5" id="ppdb-form">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-brand-dark flex items-center justify-between">
                        <span>Nama Lengkap Calon Siswa</span>
                        <span class="text-red-500 text-[11px]">*Wajib</span>
                    </label>
                    <input type="text" 
                           id="nama_santri"
                           required
                           placeholder="Contoh: Muhammad Fatih Rayhan" 
                           class="w-full px-4 py-2.5 rounded-lg border border-brand-border text-sm text-brand-dark focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-200 bg-white">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-brand-dark">Pilihan Jalur Program</label>
                        <select id="jalur_program" 
                                class="w-full px-4 py-2.5 rounded-lg border border-brand-border text-sm text-brand-dark focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-200 bg-white">
                            <option value="Tahfidz Bersanad & Bilingual">Tahfidz Bersanad & Bilingual (Unggulan)</option>
                            <option value="Kurikulum Merdeka Reguler">Kurikulum Merdeka Reguler & Sains</option>
                            <option value="Sains, STEM & Robotika">Sains, STEM & Robotika</option>
                            <option value="Konsultasi Umum PPDB">Konsultasi Umum PPDB</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-brand-dark flex items-center justify-between">
                            <span>Nomor WhatsApp Wali Siswa</span>
                            <span class="text-red-500 text-[11px]">*Wajib</span>
                        </label>
                        <input type="tel" 
                               id="whatsapp_wali"
                               required
                               placeholder="Contoh: 081299887766" 
                               class="w-full px-4 py-2.5 rounded-lg border border-brand-border text-sm text-brand-dark focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-200 bg-white">
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit" 
                            class="w-full py-3.5 rounded-full bg-[#EAA824] hover:bg-amber-500 text-brand-dark font-black text-sm uppercase tracking-wider transition-all shadow-md">
                        HUBUNGKAN DENGAN PANITIA PPDB SEKARANG
                    </button>
                    <p class="text-[11px] text-brand-muted text-center mt-2.5">
                        Panitia PPDB SMP Islam Al-Madinah BSD akan segera merespons konfirmasi Anda.
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- ========================================================
     12. LOKASI KAMPUS & PETA INTERAKTIF (#lokasi)
     ======================================================== -->
<section id="lokasi" class="py-16 lg:py-24 bg-[#F8FAF8] border-b border-brand-border">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-10">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-[#0D6B57]">
                KUNJUNGI KAMPUS KAMI
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-brand-dark tracking-tight">
                Lokasi & Peta Interaktif Kampus
            </h2>
            <p class="text-xs sm:text-sm text-brand-muted">
                Kampus asri dan modern {{ $schoolName }} berlokasi strategis di kawasan Sektor XIV BSD City, Serpong, Tangerang Selatan.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Left Info Card (5 cols) -->
            <div class="lg:col-span-5 bg-white p-6 sm:p-8 rounded-3xl border border-brand-border shadow-sm space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-brand-dark flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#EAF4F1] text-[#0D6B57] flex items-center justify-center font-bold text-sm">📍</span>
                        <span>Alamat Resmi Sekolah</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-brand-muted mt-2 leading-relaxed">
                        {{ $profile?->address ?? 'Komplek BSD City Sektor XIV, Serpong, Kota Tangerang Selatan, Banten' }}
                    </p>
                </div>

                <div class="space-y-3 pt-2 border-t border-brand-border text-xs">
                    <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                        <span class="text-brand-muted">Telepon Kantor:</span>
                        <strong class="text-brand-dark">{{ $profile?->phone ?? '(021) 538-8888' }}</strong>
                    </div>
                    <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                        <span class="text-brand-muted">WhatsApp Layanan:</span>
                        <strong class="text-[#0D6B57]">{{ $profile?->whatsapp ?? '0812-9988-7766' }}</strong>
                    </div>
                    <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                        <span class="text-brand-muted">Email Resmi:</span>
                        <strong class="text-brand-dark">{{ $profile?->email ?? 'info@smpalmadinah.sch.id' }}</strong>
                    </div>
                    <div class="flex items-center justify-between py-1.5">
                        <span class="text-brand-muted">Jam Layanan Tamu:</span>
                        <span class="text-brand-dark font-medium">Senin – Jumat (07.15 – 15.30 WIB)</span>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($schoolName . ' ' . ($profile?->address ?? 'Al Madinah Islamic Centre BSD')) }}" 
                       target="_blank" 
                       class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-[#0D6B57] hover:bg-[#08493B] text-white font-bold text-xs uppercase tracking-wider transition-all shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Petunjuk Arah Google Maps</span>
                    </a>
                </div>
            </div>

            <!-- Right Interactive Maps Frame (7 cols) -->
            <div class="lg:col-span-7">
                <div class="w-full h-[380px] sm:h-[440px] rounded-3xl overflow-hidden shadow-xl border-4 border-white bg-slate-100 relative [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
                    @if (!empty($profile?->google_maps_embed))
                        {!! $profile->google_maps_embed !!}
                    @else
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d495.7268564616415!2d106.67262261897964!3d-6.288050860278647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fb2125c0a82d%3A0x635e8df9edaa3b7f!2sAl%20Madinah%20Islamic%20centre%20BSD!5e0!3m2!1sid!2sid!4v1791386907445!5m2!1sid!2sid" 
                                width="600" 
                                height="450" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PPDB Fast WhatsApp Form Submission & Modal Scripts -->
<script>
    // 1. QR Code Modal
    function openPpdbQrModal() {
        const modal = document.getElementById('ppdb-qr-modal');
        const box = document.getElementById('ppdb-qr-modal-box');
        if (!modal || !box) return;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => {
            box.classList.remove('scale-95', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closePpdbQrModal() {
        const modal = document.getElementById('ppdb-qr-modal');
        const box = document.getElementById('ppdb-qr-modal-box');
        if (!modal || !box) return;
        
        box.classList.remove('scale-100', 'opacity-100');
        box.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }, 200);
    }

    // 2. Brosur Modal
    function openBrosurPpdbModal() {
        const modal = document.getElementById('ppdb-brosur-modal');
        const box = document.getElementById('ppdb-brosur-modal-box');
        if (!modal || !box) return;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => {
            box.classList.remove('scale-95', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeBrosurPpdbModal() {
        const modal = document.getElementById('ppdb-brosur-modal');
        const box = document.getElementById('ppdb-brosur-modal-box');
        if (!modal || !box) return;
        
        box.classList.remove('scale-100', 'opacity-100');
        box.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }, 200);
    }

    // 3. Biaya PPDB Modal
    function openBiayaPpdbModal() {
        const modal = document.getElementById('ppdb-biaya-modal');
        const box = document.getElementById('ppdb-biaya-modal-box');
        if (!modal || !box) return;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => {
            box.classList.remove('scale-95', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeBiayaPpdbModal() {
        const modal = document.getElementById('ppdb-biaya-modal');
        const box = document.getElementById('ppdb-biaya-modal-box');
        if (!modal || !box) return;
        
        box.classList.remove('scale-100', 'opacity-100');
        box.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }, 200);
    }

    function copyPpdbUrl(url) {
        const label = document.getElementById('copy-text-label');
        const btn = document.getElementById('btn-copy-ppdb-url');

        const onSuccess = () => {
            if (label && btn) {
                const prev = label.textContent;
                label.textContent = 'Tersalin!';
                btn.classList.add('bg-amber-500');
                btn.classList.remove('bg-emerald-600');
                setTimeout(() => {
                    label.textContent = prev;
                    btn.classList.remove('bg-amber-500');
                    btn.classList.add('bg-emerald-600');
                }, 2000);
            }
        };

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(url).then(onSuccess).catch(() => fallbackCopy(url, onSuccess));
        } else {
            fallbackCopy(url, onSuccess);
        }
    }

    function fallbackCopy(text, callback) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-9999px';
        textArea.style.top = '0';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            if (callback) callback();
        } catch (err) {
            console.error('Failed to copy text', err);
        }
        document.body.removeChild(textArea);
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Modal backdrops & ESC click handlers
        const modals = [
            { id: 'ppdb-qr-modal', close: closePpdbQrModal },
            { id: 'ppdb-brosur-modal', close: closeBrosurPpdbModal },
            { id: 'ppdb-biaya-modal', close: closeBiayaPpdbModal },
        ];

        modals.forEach(({ id, close }) => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('click', (e) => {
                    if (e.target === el) close();
                });
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closePpdbQrModal();
                closeBrosurPpdbModal();
                closeBiayaPpdbModal();
            }
        });

        // WhatsApp Form Handler
        const form = document.getElementById('ppdb-form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const nama = document.getElementById('nama_santri')?.value || '';
                const jalur = document.getElementById('jalur_program')?.value || '';
                const wa = document.getElementById('whatsapp_wali')?.value || '';
                
                const text = encodeURIComponent(
                    `Assalamu'alaikum Panitia PPDB {{ $schoolName }},\n` +
                    `Saya ingin mendaftarkan calon siswa:\n` +
                    `• Nama Siswa: ${nama}\n` +
                    `• Jalur Peminatan: ${jalur}\n` +
                    `• No. WA Wali: ${wa}\n\n` +
                    `Mohon petunjuk langkah pendaftaran selanjutnya. Terima kasih.`
                );

                const waCustomUrl = @json($profile?->whatsapp_custom_url);
                if (waCustomUrl) {
                    const sep = waCustomUrl.includes('?') ? '&' : '?';
                    window.open(`${waCustomUrl}${sep}text=${text}`, '_blank');
                } else {
                    const waTarget = "{{ $whatsappClean }}";
                    window.open(`https://wa.me/${waTarget}?text=${text}`, '_blank');
                }
            });
        }
    });
</script>
@endsection
