@props([
    'profile' => null,
])

@php
    $schoolName = $profile->name ?? 'SMP Islam Al-Madinah BSD';
    $foundationName = 'Yayasan Kerukunan Keluarga Muslim BSD';
    $address = $profile->address ?? 'Komplek BSD City Sektor XIV, Tangerang Selatan, Banten';
    $phone = $profile->phone ?? '(021) 538-8888';
    $whatsapp = $profile->whatsapp ?? '0812-9988-7766';
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsapp);
    if (str_starts_with($whatsappClean, '0')) {
        $whatsappClean = '62' . substr($whatsappClean, 1);
    }
    $email = $profile->email ?? 'info@smpalmadinah.sch.id';
    $academicYear = '2027/2028';
    $instagram = $profile->instagram_url ?? 'https://instagram.com';
    $youtube = $profile->youtube_url ?? 'https://youtube.com';
    $facebook = $profile->facebook_url ?? 'https://facebook.com';
    $tiktok = $profile->tiktok_url ?? null;
    $accreditation = $profile->accreditation ?? 'A';
    $npsn = $profile->npsn ?? '20603341';
    $logoSrc = !empty($profile?->logo) ? asset('storage/' . $profile->logo) : asset('images/logo-almadinah.png');
@endphp

<footer class="bg-[#0D6B57] text-white pt-12 transition-colors print:hidden">
    <!-- Top Bar inside Footer (Brand + Quick Subscription/Search) -->
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 pb-8 border-b border-emerald-800/80">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center font-extrabold text-amber-300 text-lg">
                    #
                </div>
                <div>
                    <h3 class="text-lg font-bold tracking-tight text-white leading-snug">
                        {{ $schoolName }}
                    </h3>
                    <p class="text-xs text-emerald-200">
                        {{ $foundationName }} • Sektor XIV BSD City
                    </p>
                </div>
            </div>

            <!-- Quick Subscribe / Search -->
            <form action="https://wa.me/{{ $whatsappClean }}" method="GET" target="_blank" class="flex items-center max-w-md w-full">
                <input type="text" 
                       name="text" 
                       placeholder="Ada pertanyaan seputar PPDB? Tulis di sini..." 
                       class="w-full px-4 py-2.5 rounded-l-full bg-white text-brand-dark text-xs focus:outline-none placeholder:text-brand-muted">
                <button type="submit" 
                        class="px-6 py-2.5 rounded-r-full bg-[#EAA824] hover:bg-amber-500 text-brand-dark font-extrabold text-xs uppercase tracking-wider transition-colors shrink-0">
                    KIRIM
                </button>
            </form>
        </div>
    </div>

    <!-- Main Footer 4 Columns -->
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-12">
            
            <!-- Col 1: Logo & Profil (4 cols) -->
            <div class="lg:col-span-4 space-y-4">
                <div class="flex items-center gap-3">
                    <img src="{{ $logoSrc }}" 
                         alt="Logo {{ $schoolName }}" 
                         class="w-14 h-14 object-contain bg-white rounded-full p-1 shadow"
                         onerror="this.src='https://lh3.googleusercontent.com/aida-public/AB6AXuAmbTzxzgl6wWksQemxIkN-NrASOhgrQ43jj8Ie82Cr-QQ_hO3Nldfe9ifPaO9jd5ShbMBwhbhUe95-6ZJnxMykUPQy1mucK-BSdzNVvAN-PahWS4DL6O6pZ1FEuzzjZek6KT_3GLxGyKhNz4UZcySi6KGAzmo5b4mcmlisOO0y1YY4VOIMWnxczmaESHA2jdQb68UL-7N8WImgP0evy_Cq86tebAneTuXeWKLRBlUDDyshxu9H6sNI'">
                    <div>
                        <div class="text-base font-bold text-white leading-tight">
                            {{ $schoolName }}
                        </div>
                        <div class="text-xs text-amber-300 font-semibold mt-0.5">
                            Akreditasi {{ $accreditation }} • NPSN {{ $npsn }}
                        </div>
                    </div>
                </div>

                <p class="text-xs text-emerald-100/90 leading-relaxed max-w-sm">
                    {{ $profile?->about ? Str::limit($profile->about, 160) : 'Lembaga pendidikan Islam menengah pertama terpadu yang memadukan kurikulum nasional dan nilai-nilai Islam untuk mencetak generasi berkarakter, cerdas, dan bertakwa.' }}
                </p>

                <!-- Social Icons -->
                <div class="flex items-center gap-2 pt-2">
                    <a href="{{ $facebook }}" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white hover:text-[#0D6B57] flex items-center justify-center transition-all" title="Facebook">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.597 0 9 1.583 9 4.615V8z" />
                        </svg>
                    </a>
                    <a href="{{ $instagram }}" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white hover:text-[#0D6B57] flex items-center justify-center transition-all" title="Instagram">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    <a href="{{ $youtube }}" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white hover:text-[#0D6B57] flex items-center justify-center transition-all" title="YouTube">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </a>
                    @if ($tiktok)
                    <a href="{{ $tiktok }}" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white hover:text-[#0D6B57] flex items-center justify-center transition-all" title="TikTok">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Col 2: Kategori & Navigasi (2 cols) -->
            <div class="lg:col-span-2 space-y-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-amber-300">Navigasi</h4>
                <ul class="space-y-2 text-xs text-emerald-100">
                    <li><a href="{{ route('about') }}" class="hover:text-amber-300 transition-colors">Visi & Misi</a></li>
                    <li><a href="{{ route('programs') }}" class="hover:text-amber-300 transition-colors">Program Pendidikan</a></li>
                    <li><a href="{{ url('/#unggulan') }}" class="hover:text-amber-300 transition-colors">Program Unggulan</a></li>
                    <li><a href="{{ route('achievements') }}" class="hover:text-amber-300 transition-colors">Prestasi Santri</a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-amber-300 transition-colors">Galeri Kegiatan</a></li>
                    <li><a href="{{ route('news') }}" class="hover:text-amber-300 transition-colors">Berita & Warta</a></li>
                </ul>
            </div>

            <!-- Col 3: Layanan & Informasi (3 cols) -->
            <div class="lg:col-span-3 space-y-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-amber-300">Informasi SPMB / PPDB</h4>
                <ul class="space-y-2 text-xs text-emerald-100">
                    <li><a href="{{ route('ppdb.index') }}" class="hover:text-amber-300 transition-colors font-semibold text-white">Pendaftaran Online</a></li>
                    <li><a href="{{ route('ppdb.check-status') }}" class="hover:text-amber-300 transition-colors">Cek Status Verifikasi</a></li>
                    <li><a href="{{ url('/#ppdb') }}" class="hover:text-amber-300 transition-colors">Persyaratan Berkas</a></li>
                    <li><a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="hover:text-amber-300 transition-colors">Konsultasi Panitia via WA</a></li>
                    <li class="pt-2 text-[11px] text-emerald-200">
                        Jam Layanan: Senin – Jumat (07.15 – 15.30 WIB)
                    </li>
                </ul>
            </div>

            <!-- Col 4: Kantor, Kontak & Pin Maps (3 cols) -->
            <div class="lg:col-span-3 space-y-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-amber-300">Alamat & Lokasi</h4>
                <div class="space-y-2.5 text-xs text-emerald-100">
                    <div class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-amber-300 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $address }}</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-amber-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>{{ $phone }}</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-amber-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $email }}</span>
                    </div>

                    @if (!empty($profile?->google_maps_embed))
                        <div class="pt-2">
                            <div class="w-full h-32 rounded-xl overflow-hidden shadow-inner border border-emerald-800 bg-emerald-950/40 [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
                                {!! $profile->google_maps_embed !!}
                            </div>
                            <div class="pt-1.5 flex items-center justify-between">
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($schoolName . ' ' . $address) }}" 
                                   target="_blank" 
                                   class="inline-flex items-center gap-1 text-[11px] text-amber-300 hover:text-white transition-colors font-bold">
                                    <span>Buka di Google Maps</span>
                                    <span>&rarr;</span>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- Bottom Darker Copyright Bar -->
    <div class="bg-[#08493B] py-4 text-center text-xs text-emerald-200/80 border-t border-emerald-900">
        <p>
            © 2025 – {{ date('Y') }} {{ $schoolName }} — {{ $foundationName }}. Hak Cipta Dilindungi.
        </p>
    </div>
</footer>
