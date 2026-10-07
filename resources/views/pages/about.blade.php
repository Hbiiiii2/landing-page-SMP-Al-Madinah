@extends('layouts.public')

@section('title', 'Tentang Kami — SMP Islam Al-Madinah BSD')

@section('content')
@php
    $schoolName = $profile->name ?? 'SMP Islam Al-Madinah BSD';
    $foundation = 'Yayasan Kerukunan Keluarga Muslim BSD';
    $headmasterPhoto = !empty($profile?->headmaster_photo) 
        ? asset('storage/' . $profile->headmaster_photo) 
        : (!empty($profile?->logo) ? asset('storage/' . $profile->logo) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=700&q=80');
@endphp

<!-- Header Banner -->
<section class="bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#117C65] text-white py-12 lg:py-16">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 text-center space-y-2">
        <span class="text-xs font-bold uppercase tracking-wider text-amber-300">PROFIL LEMBAGA</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
            Tentang {{ $schoolName }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-xl mx-auto">
            Mengenal lebih dekat visi, misi, nilai-nilai pembinaan santri, serta profil dewan guru dan asatidz.
        </p>
    </div>
</section>

<!-- Statistik Capaian Lembaga -->
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

<!-- Profil & Sambutan -->
<section class="py-14 bg-white border-b border-brand-border">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-sm">
                    <img src="{{ $headmasterPhoto }}" 
                         alt="{{ $profile->headmaster_name ?? 'Kepala Sekolah' }}" 
                         class="w-full h-80 sm:h-96 object-cover rounded-3xl shadow-lg border-4 border-[#0D6B57]"
                         onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=700&q=80'">
                    <div class="absolute -bottom-4 left-4 right-4 bg-white p-3.5 rounded-2xl shadow-md border border-brand-border text-center">
                        <div class="text-xs font-bold text-brand-dark">{{ $profile->headmaster_name ?? 'H. M. Syaifullah, M.Pd.' }}</div>
                        <div class="text-[10px] text-[#0D6B57] font-semibold">Kepala Sekolah {{ $schoolName }}</div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 space-y-4">
                <span class="text-xs font-bold text-[#0D6B57] uppercase tracking-wider">SAMBUTAN KEPALA SEKOLAH</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-brand-dark tracking-tight">
                    {{ $profile?->tagline ?? 'Mendidik Karakter Islami yang Tangguh dan Berwawasan Global' }}
                </h2>
                <div class="text-xs sm:text-sm text-brand-muted leading-relaxed space-y-3">
                    <p class="italic bg-emerald-50/60 p-4 rounded-2xl border border-emerald-100 text-brand-dark">
                        "{{ $profile->headmaster_welcome ?? 'Selamat datang di portal resmi SMP Islam Al-Madinah BSD. Kami bertekad mewujudkan lingkungan pendidikan yang menumbuhkan kecintaan terhadap Al-Qur\'an, ketajaman intelektual sains, serta keluhuran akhlak mulia.' }}"
                    </p>
                    <p>
                        {{ $profile->about ?? 'SMP Islam Al-Madinah BSD berdiri di bawah naungan Yayasan Kerukunan Keluarga Muslim BSD (YKKM BSD) di Sektor XIV BSD City. Dengan mengusung konsep pendidikan terpadu, santri dibimbing secara holistik mencakup aspek ruhiyah (spiritual), aqliyah (intelektual), dan jasadiyah (fisik).' }}
                    </p>
                </div>
            </div>

        </div>

        <!-- Visi & Misi Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
            <div class="bg-[#F8FAF8] rounded-2xl border border-brand-border p-6 sm:p-8 space-y-3">
                <div class="flex items-center gap-2 text-xs font-bold text-[#0D6B57] uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-[#0D6B57]"></span>
                    <span>Visi Sekolah</span>
                </div>
                <p class="text-sm font-semibold text-brand-dark leading-relaxed">
                    {{ $profile->vision ?? 'Terwujudnya Generasi yang Berakhlak Mulia, Cerdas, Mandiri, dan Berwawasan Global Berdasarkan Nilai-Nilai Islam.' }}
                </p>
            </div>

            <div class="bg-[#F8FAF8] rounded-2xl border border-brand-border p-6 sm:p-8 space-y-3">
                <div class="flex items-center gap-2 text-xs font-bold text-[#0D6B57] uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-[#0D6B57]"></span>
                    <span>Misi Utama</span>
                </div>
                <div class="text-xs text-brand-muted leading-relaxed whitespace-pre-line">
                    {{ $profile->mission ?? "1. Menumbuhkan akidah shalihah dan pembiasaan adab Islami dalam kehidupan sehari-hari.\n2. Menyelenggarakan proses pembelajaran berbasis teknologi dan literasi modern.\n3. Membina hafalan Al-Qur'an bersanad dan keterampilan berbahasa internasional.\n4. Mengembangkan potensi kepemimpinan dan kemandirian sosial santri." }}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Dewan Guru & Tenaga Pendidik -->
@if ($teachers->isNotEmpty())
<section class="py-14 bg-[#F8FAF8] border-b border-brand-border">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-8">
        <div class="text-center max-w-xl mx-auto space-y-1.5">
            <h2 class="text-2xl font-extrabold text-[#0D6B57] tracking-tight">Dewan Asatidz & Pengajar</h2>
            <p class="text-xs text-brand-muted">Pendidik profesional dan berpengalaman di bidang akademik dan keislaman.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($teachers as $teacher)
                <div class="bg-white rounded-2xl border border-brand-border p-5 text-center shadow-sm space-y-2 hover:border-[#0D6B57] transition-all">
                    <div class="w-20 h-20 mx-auto rounded-full bg-[#EAF4F1] border-2 border-[#0D6B57] flex items-center justify-center font-bold text-[#0D6B57] text-xl overflow-hidden">
                        {{ substr($teacher->name, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-brand-dark leading-snug">{{ $teacher->name }}</h3>
                        <p class="text-xs text-[#0D6B57] font-medium">{{ $teacher->role }}</p>
                        @if ($teacher->subject)
                            <p class="text-[11px] text-brand-muted mt-0.5">{{ $teacher->subject }}</p>
                        @endif
                    </div>
                    @if ($teacher->education)
                        <div class="pt-2 border-t border-brand-border text-[10px] text-brand-muted">
                            {{ $teacher->education }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Lokasi & Peta Interaktif Sekolah -->
<section class="py-14 bg-white">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-10">
        <div class="text-center max-w-xl mx-auto space-y-1.5">
            <h2 class="text-2xl font-extrabold text-[#0D6B57] tracking-tight">Lokasi & Peta Kampus</h2>
            <p class="text-xs text-brand-muted">Kunjungi langsung kampus kami atau buka petunjuk arah melalui Google Maps.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Info Kontak & Alamat (5 cols) -->
            <div class="lg:col-span-5 bg-[#F8FAF8] p-6 sm:p-8 rounded-3xl border border-brand-border shadow-sm space-y-5">
                <div>
                    <h3 class="text-base font-bold text-brand-dark flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-[#EAF4F1] text-[#0D6B57] flex items-center justify-center font-bold text-xs">📍</span>
                        <span>Alamat Kampus</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-brand-muted mt-2 leading-relaxed">
                        {{ $profile?->address ?? 'Komplek BSD City Sektor XIV, Serpong, Kota Tangerang Selatan, Banten' }}
                    </p>
                </div>

                <div class="space-y-2.5 pt-2 border-t border-brand-border text-xs">
                    <div class="flex items-center justify-between py-1 border-b border-slate-200/60">
                        <span class="text-brand-muted">Telepon:</span>
                        <strong class="text-brand-dark">{{ $profile?->phone ?? '(021) 538-8888' }}</strong>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-200/60">
                        <span class="text-brand-muted">WhatsApp:</span>
                        <strong class="text-[#0D6B57]">{{ $profile?->whatsapp ?? '0812-9988-7766' }}</strong>
                    </div>
                    <div class="flex items-center justify-between py-1">
                        <span class="text-brand-muted">Email:</span>
                        <strong class="text-brand-dark">{{ $profile?->email ?? 'info@smpalmadinah.sch.id' }}</strong>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($schoolName . ' ' . ($profile?->address ?? 'Al Madinah Islamic Centre BSD')) }}" 
                       target="_blank" 
                       class="w-full inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full bg-[#0D6B57] hover:bg-[#08493B] text-white font-bold text-xs uppercase tracking-wider transition-all shadow-sm">
                        <span>Buka Peta Google Maps</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Frame Google Maps (7 cols) -->
            <div class="lg:col-span-7">
                <div class="w-full h-80 sm:h-96 rounded-3xl overflow-hidden shadow-lg border-2 border-brand-border bg-slate-100 relative [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
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
@endsection
