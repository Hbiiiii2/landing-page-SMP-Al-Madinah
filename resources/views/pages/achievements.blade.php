@extends('layouts.public')

@section('title', 'Prestasi Siswa — SMP Islam Al-Madinah BSD')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#117C65] text-white py-12 lg:py-16">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 text-center space-y-2">
        <span class="text-xs font-bold uppercase tracking-wider text-amber-300">ETALASE REKOGNISI</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
            Prestasi & Kejuaraan Siswa
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-xl mx-auto">
            Capaian membanggakan Siswa SMP Al-Madinah Islamic Center KKMB BSD di bidang keagamaan, sains, teknologi, dan olahraga.
        </p>
    </div>
</section>

<!-- Grid Prestasi -->
<section class="py-14 bg-white">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($achievements as $ach)
                <div class="bg-white rounded-xl border border-brand-border p-6 flex flex-col justify-between space-y-4 shadow-sm hover:border-[#0D6B57] hover:bg-[#F8FAF8] transition-all">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold {{ str_contains(strtolower($ach->rank), '1') || str_contains(strtolower($ach->rank), 'emas') || str_contains(strtolower($ach->rank), 'gold') ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-slate-100 text-slate-700 border border-slate-200' }}">
                                🏆 {{ $ach->rank }}
                            </span>
                            <span class="text-[11px] font-mono text-brand-muted">
                                {{ ucfirst($ach->level ?? 'Nasional') }} • {{ $ach->year }}
                            </span>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-brand-dark leading-snug">{{ $ach->title }}</h3>
                            <p class="text-xs text-brand-muted mt-1">{{ $ach->description }}</p>
                        </div>
                        <div class="flex items-center gap-2 pt-2">
                            <div class="w-6 h-6 rounded-full bg-[#EAF4F1] flex items-center justify-center text-[#0D6B57] font-bold text-[10px]">
                                {{ substr($ach->student_name, 0, 2) }}
                            </div>
                            <span class="text-xs font-semibold text-brand-dark">Oleh: {{ $ach->student_name }}</span>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-brand-border flex items-center justify-between text-[11px] text-brand-muted">
                        <span class="font-medium text-[#0D6B57]">{{ ucfirst($ach->category) }}</span>
                        <span>{{ $ach->organizer }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-xs text-brand-muted py-12">
                    Belum ada data Prestasi Siswa.
                </div>
            @endforelse
        </div>

        @if ($achievements->hasPages())
            <div class="pt-6 border-t border-brand-border flex justify-center">
                {{ $achievements->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
