@extends('layouts.public')

@section('title', 'Program Pendidikan & Ekstrakurikuler — SMP Islam Al-Madinah BSD')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#117C65] text-white py-12 lg:py-16">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 text-center space-y-2">
        <span class="text-xs font-bold uppercase tracking-wider text-amber-300">KURIKULUM & KEGIATAN</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
            Program Pendidikan & Ekstrakurikuler
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-xl mx-auto">
            Memadukan keilmuan akademik, kemahiran Al-Qur'an, dan eksplorasi bakat siswa secara berimbang.
        </p>
    </div>
</section>

<!-- Program Sekolah Detail -->
<section class="py-14 bg-white border-b border-brand-border">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-10">
        <div>
            <h2 class="text-2xl font-extrabold text-[#0D6B57]">Pilar Program Akademik & Keislaman</h2>
            <p class="text-xs text-brand-muted mt-1">Struktur kurikulum terintegrasi untuk membentuk siswa yang unggul dan beradab.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($programs as $prog)
                <div class="bg-[#F8FAF8] rounded-2xl border border-brand-border p-6 sm:p-8 space-y-3 hover:border-[#0D6B57] transition-all">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#0D6B57] uppercase tracking-wider">
                            {{ $prog->category ?? 'Program' }}
                        </span>
                        <span class="text-xs font-bold bg-[#EAF4F1] text-[#0D6B57] px-2.5 py-0.5 rounded-full">
                            Al-Madinah
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-brand-dark">{{ $prog->name }}</h3>
                    <p class="text-xs text-brand-muted leading-relaxed">
                        {{ $prog->description ?? $prog->summary }}
                    </p>
                </div>
            @empty
                <div class="col-span-2 text-center text-xs text-brand-muted py-8">
                    Data program belum tersedia.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Ekstrakurikuler -->
<section class="py-14 bg-[#F8FAF8]">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-10">
        <div>
            <h2 class="text-2xl font-extrabold text-[#0D6B57]">Kegiatan Ekstrakurikuler Siswa</h2>
            <p class="text-xs text-brand-muted mt-1">Wadah pengembangan bakat, kepemimpinan, olahraga, dan seni Islami.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($extracurriculars as $ekskul)
                <div class="bg-white rounded-xl border border-brand-border p-5 space-y-2 shadow-sm hover:border-[#0D6B57] transition-all">
                    <span class="text-[10px] font-bold uppercase text-[#0D6B57] tracking-wider">{{ $ekskul->category }}</span>
                    <h3 class="text-sm font-bold text-brand-dark">{{ $ekskul->name }}</h3>
                    <p class="text-xs text-brand-muted leading-relaxed">{{ $ekskul->description }}</p>
                    @if ($ekskul->schedule)
                        <div class="pt-2 border-t border-brand-border text-[10px] text-brand-muted">
                            ⏰ {{ $ekskul->schedule }}
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-4 text-center text-xs text-brand-muted py-8">
                    Data ekstrakurikuler belum tersedia.
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
