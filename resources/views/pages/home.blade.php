@extends('layouts.public')

@section('title', 'SMP Islam Al-Madinah BSD — Mendidik dengan Adab, Membina dengan Ilmu')

@section('content')
@php
    $schoolName = $profile->name ?? 'SMP Islam Al-Madinah BSD';
    $foundation = 'Yayasan Kerukunan Keluarga Muslim BSD';
    $academicYear = $ppdbSetting->academic_year ?? '2027/2028';
    $whatsapp = $profile->whatsapp ?? '0812-9988-7766';
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsapp);
    if (str_starts_with($whatsappClean, '0')) {
        $whatsappClean = '62' . substr($whatsappClean, 1);
    }
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
                        <img src="{{ !empty($profile?->hero_image) ? asset('storage/' . $profile->hero_image) : 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=800&q=80' }}" 
                             alt="Santri {{ $schoolName }}" 
                             class="w-full h-80 sm:h-96 object-cover rounded-t-full"
                             onerror="this.src='https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=800&q=80'">
                        
                        <!-- Floating Student Achievement Badges -->
                        <div class="absolute bottom-6 left-4 right-4 bg-white/95 backdrop-blur-md text-brand-dark p-3.5 rounded-xl shadow-lg border border-amber-200 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 font-extrabold text-sm">
                                    ★
                                </div>
                                <div>
                                    <div class="text-xs font-extrabold text-[#0D6B57]">Santri Berprestasi</div>
                                    <div class="text-[10px] text-brand-muted font-medium">Tahfidz 10 Juz & Juara Sains</div>
                                </div>
                            </div>
                            <span class="text-[11px] font-bold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200">
                                Mumtaz
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
                <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <a href="#ppdb" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-3.5 rounded-full bg-[#EAA824] hover:bg-amber-500 text-brand-dark font-extrabold text-sm uppercase tracking-wide transition-all shadow-lg hover:shadow-xl hover:scale-105 transform">
                        <span>DAFTAR SEKARANG</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>

                    <a href="https://wa.me/{{ $whatsappClean }}?text=Assalamu%27alaikum%20Panitia%20PPDB%20{{ urlencode($schoolName) }}" 
                       target="_blank" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 border border-white/25 text-white font-bold text-sm transition-all">
                        <svg class="w-4 h-4 fill-current text-emerald-300" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.181-.076.355.101.173.449.742.964 1.201.662.591 1.221.774 1.394.861.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.174.231-.145.39-.087s1.011.477 1.184.564.289.13.332.203c.043.072.043.419-.101.824z" />
                        </svg>
                        <span>Konsultasi WhatsApp</span>
                    </a>

                    @if(!empty($profile?->hero_video_url))
                    <a href="{{ $profile->hero_video_url }}" 
                       target="_blank" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-full bg-amber-400/20 hover:bg-amber-400/30 border border-amber-300/40 text-amber-200 font-bold text-sm transition-all" title="Video Profil">
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
                        <div class="text-xs text-emerald-200">Kuota Terbatas: 120 Santri (5 Kelas @ 24 Siswa)</div>
                    </div>
                    <div class="flex items-center gap-3 bg-white p-2.5 rounded-xl shadow text-brand-dark shrink-0">
                        <div class="w-12 h-12 bg-slate-900 rounded p-1 flex items-center justify-center text-white text-[9px] font-mono text-center leading-tight">
                            QR CODE PPDB
                        </div>
                        <div class="text-[11px] font-bold text-[#0D6B57] leading-tight text-left">
                            Scan untuk <br>Daftar Cepat
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


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
                Penerimaan Santri Baru (PPDB) SMP Islam Al-Madinah BSD Tahun Ajaran {{ $academicYear }} telah dibuka. Pendaftaran gelombang 1 mendapatkan subsidi perlengkapan belajar.
            </span>
        </div>
        <a href="#ppdb" class="text-[#0D6B57] font-bold hover:underline shrink-0 flex items-center gap-1">
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
                <div class="text-xs font-bold text-brand-dark mt-1">Santri Aktif</div>
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
                <div class="text-xs font-bold text-brand-dark mt-1">Prestasi Santri</div>
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
                        Tentang Yayasan & Profil Sekolah
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
                        Eksplorasi minat santri melalui sains, robotika, bahasa, seni islami, dan olahraga.
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
                    <a href="#ppdb" 
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
                    <a href="#ppdb" 
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
                            Pengembangan kemampuan computational thinking, merakit robot mikro-kontroler, dan persiapan santri mengikuti kompetisi teknologi nasional.
                        </p>
                    </div>
                </div>

                <div class="p-6 pt-0 text-center">
                    <a href="#ppdb" 
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
                            <span>Rasio kelas emas: maksimal 24 santri per kelas demi pendampingan optimal.</span>
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
                        <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=700&q=80" 
                             alt="Santri Ceria Al-Madinah" 
                             class="w-full h-80 sm:h-96 object-cover rounded-2xl shadow-lg border-4 border-white">
                        <div class="absolute -bottom-4 right-4 bg-white p-3 rounded-xl shadow-md border border-brand-border flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#0D6B57] text-white flex items-center justify-center font-extrabold text-sm">
                                A
                            </div>
                            <div>
                                <div class="text-xs font-bold text-brand-dark">Akreditasi A Unggul</div>
                                <div class="text-[10px] text-brand-muted">BAN-S/M Kemendikbud</div>
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
                Kembangkan potensi terbaik santri melalui program unggulan SMP Islam Al-Madinah BSD.
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
                    Kegiatan kepanduan Pramuka SIT, latihan dasar kepemimpinan (LDK), dan kemah bakti sosial untuk membentuk jiwa mandiri santri.
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
                    <img src="https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=400&q=80" 
                         alt="Foto Santri 1" 
                         class="w-full h-36 sm:h-44 object-cover rounded-2xl shadow-sm">
                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=400&q=80" 
                         alt="Foto Santri 2" 
                         class="w-full h-36 sm:h-44 object-cover rounded-2xl shadow-sm">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=400&q=80" 
                         alt="Foto Santri 3" 
                         class="w-full h-36 sm:h-44 object-cover rounded-2xl shadow-sm">
                    <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=400&q=80" 
                         alt="Foto Santri 4" 
                         class="w-full h-36 sm:h-44 object-cover rounded-2xl shadow-sm">
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
                <div class="flex flex-wrap gap-3">
                    <a href="#ppdb" 
                       class="px-5 py-2.5 rounded-full bg-[#0D6B57] hover:bg-[#08493B] text-white font-extrabold text-xs uppercase tracking-wide transition-all shadow-sm">
                        DAFTAR ONLINE
                    </a>
                    <a href="#kurikulum" 
                       class="px-5 py-2.5 rounded-full bg-[#0D6B57] hover:bg-[#08493B] text-white font-extrabold text-xs uppercase tracking-wide transition-all shadow-sm">
                        UNDUH BROSUR
                    </a>
                    <a href="#ppdb" 
                       class="px-5 py-2.5 rounded-full bg-[#0D6B57] hover:bg-[#08493B] text-white font-extrabold text-xs uppercase tracking-wide transition-all shadow-sm">
                        BIAYA PPDB
                    </a>
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Assalamu%27alaikum%20Panitia%20PPDB%20SMP%20Al-Madinah%20BSD" 
                       target="_blank" 
                       class="px-5 py-2.5 rounded-full bg-[#EAA824] hover:bg-amber-500 text-brand-dark font-extrabold text-xs uppercase tracking-wide transition-all shadow-sm">
                        CHAT WA PANITIA
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
                Dokumentasi dinamika pembelajaran, pembiasaan ibadah, dan keceriaan santri di kampus Al-Madinah BSD.
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
                         alt="Kegiatan Santri" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                        SMP Al-Madinah
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center pt-2">
            <a href="#ppdb" class="text-xs font-bold text-[#0D6B57] hover:underline uppercase tracking-wider">
                LIHAT SEMUA FOTO &gt;
            </a>
        </div>
    </div>
</section>


<!-- ========================================================
     09. HORIZONTAL PROMO BANNER (Green & Gold Arch Motif)
     ======================================================== -->
<section class="py-10 bg-white">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8">
        <div class="rounded-3xl bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#0A5344] text-white p-6 sm:p-10 shadow-xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 text-center md:text-left z-10">
                <div class="text-xs font-bold uppercase tracking-wider text-amber-300">
                    PENERIMAAN SANTRI BARU (PPDB)
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    SMP Islam Al-Madinah BSD — {{ $academicYear }}
                </h3>
                <p class="text-xs sm:text-sm text-emerald-100 max-w-xl">
                    Daftarkan ananda sekarang juga. Kuota kelas terbatas 24 santri per kelas untuk memastikan perhatian penuh dewan asatidz.
                </p>
            </div>

            <div class="flex items-center gap-4 z-10 shrink-0">
                <a href="#ppdb" 
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
                Kabar terkini seputar aktivitas pembelajaran, prestasi santri, dan pengumuman sekolah.
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
                                        Pelepasan Kontingen Santri Jambore Sains & Tahfidz Banten
                                    </h4>
                                    <p class="text-[11px] text-brand-muted line-clamp-2">
                                        Sebanyak 15 santri terpilih siap berkompetisi pada ajang sains dan tahfidz tingkat wilayah.
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
                                        Mengenal lebih dekat kurikulum tahfidz bersanad dan sistem pendampingan santri.
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
                                        Sebanyak 42 santri berhasil menyelesaikan setoran hafalan mutqin bersanad.
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
                            <li><a href="{{ route('news') }}" class="hover:text-[#0D6B57] flex items-center justify-between"><span>Penerimaan Santri (PPDB)</span><span class="font-mono text-[11px] text-brand-muted/70">(1)</span></a></li>
                            <li><a href="{{ route('news') }}" class="hover:text-[#0D6B57] flex items-center justify-between"><span>Prestasi & Kejuaraan</span><span class="font-mono text-[11px] text-brand-muted/70">(0)</span></a></li>
                            <li><a href="{{ route('news') }}" class="hover:text-[#0D6B57] flex items-center justify-between"><span>Kegiatan & Dinamika Santri</span><span class="font-mono text-[11px] text-brand-muted/70">(0)</span></a></li>
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
            <form action="https://wa.me/{{ $whatsappClean }}" method="GET" target="_blank" class="space-y-5" id="ppdb-form">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-brand-dark flex items-center justify-between">
                        <span>Nama Lengkap Calon Santri</span>
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
                            <span>Nomor WhatsApp Wali Santri</span>
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

<!-- PPDB Fast WhatsApp Form Submission Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('ppdb-form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const nama = document.getElementById('nama_santri')?.value || '';
                const jalur = document.getElementById('jalur_program')?.value || '';
                const wa = document.getElementById('whatsapp_wali')?.value || '';
                
                const text = encodeURIComponent(
                    `Assalamu'alaikum Panitia PPDB SMP Islam Al-Madinah BSD,\n` +
                    `Saya ingin mendaftarkan calon santri:\n` +
                    `• Nama Santri: ${nama}\n` +
                    `• Jalur Peminatan: ${jalur}\n` +
                    `• No. WA Wali: ${wa}\n\n` +
                    `Mohon petunjuk langkah pendaftaran selanjutnya. Terima kasih.`
                );

                const waTarget = "{{ $whatsappClean }}";
                window.open(`https://wa.me/${waTarget}?text=${text}`, '_blank');
            });
        }
    });
</script>
@endsection
