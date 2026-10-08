@extends('layouts.public')

@section('title', 'Galeri Kegiatan — SMP Islam Al-Madinah BSD')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#117C65] text-white py-12 lg:py-16">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 text-center space-y-2">
        <span class="text-xs font-bold uppercase tracking-wider text-amber-300">DOKUMENTASI SEKOLAH</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
            Galeri Kegiatan Siswa
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-xl mx-auto">
            Merekam momen berharga dalam aktivitas tahfidz, pembelajaran kelas, eksperimen sains, dan kegiatan sosial Siswa.
        </p>
    </div>
</section>

<!-- Grid Galeri -->
<section class="py-14 bg-white">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $sampleImages = [
                    'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=600&q=80',
                ];
            @endphp

            @if ($galleries->isNotEmpty())
                @foreach ($galleries as $gallery)
                    <div class="h-48 sm:h-56 rounded-2xl overflow-hidden shadow-sm group relative">
                        <img src="{{ $gallery->image_url ?? $sampleImages[$loop->index % count($sampleImages)] }}" 
                             alt="{{ $gallery->title ?? 'Galeri SMP Al-Madinah' }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent p-4 flex items-end opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-xs font-bold text-white">{{ $gallery->title ?? 'Kegiatan Siswa' }}</span>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($sampleImages as $img)
                    <div class="h-48 sm:h-56 rounded-2xl overflow-hidden shadow-sm group relative">
                        <img src="{{ $img }}" 
                             alt="Kegiatan Siswa SMP Al-Madinah Islamic Center KKMB BSD" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent p-4 flex items-end opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-xs font-bold text-white">SMP Islam Al-Madinah BSD</span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        @if ($galleries->hasPages())
            <div class="pt-6 border-t border-brand-border flex justify-center">
                {{ $galleries->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
