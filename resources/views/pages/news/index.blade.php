@extends('layouts.public')

@section('title', 'Berita & Warta — SMP Islam Al-Madinah BSD')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#117C65] text-white py-12 lg:py-16">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 text-center space-y-2">
        <span class="text-xs font-bold uppercase tracking-wider text-amber-300">PUBLIKASI RESMI</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
            Berita & Warta Sekolah
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-xl mx-auto">
            Informasi terkini seputar agenda akademik, pengumuman yayasan, dan catatan dinamika santri.
        </p>
    </div>
</section>

<!-- Filter & Search Bar -->
<section class="bg-white border-b border-brand-border py-4">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Categories Pills -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1 md:pb-0 scrollbar-none text-xs">
                <a href="{{ route('news') }}" 
                   class="px-3.5 py-1.5 rounded-full font-bold transition-all whitespace-nowrap {{ !request('kategori') ? 'bg-[#0D6B57] text-white shadow-sm' : 'bg-slate-100 text-brand-dark hover:bg-slate-200' }}">
                    Semua
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('news', ['kategori' => $cat->slug, 'q' => request('q')]) }}" 
                       class="px-3.5 py-1.5 rounded-full font-bold transition-all whitespace-nowrap {{ request('kategori') === $cat->slug ? 'bg-[#0D6B57] text-white shadow-sm' : 'bg-slate-100 text-brand-dark hover:bg-slate-200' }}">
                        {{ ucfirst($cat->name) }} ({{ $cat->posts_count }})
                    </a>
                @endforeach
            </div>

            <!-- Search Form -->
            <form action="{{ route('news') }}" method="GET" class="relative max-w-xs w-full">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <input type="text" 
                       name="q"
                       value="{{ request('q') }}"
                       placeholder="Cari berita..." 
                       class="w-full px-3.5 py-1.5 pr-8 rounded-full border border-brand-border text-xs focus:outline-none focus:border-[#0D6B57]">
                <button type="submit" class="absolute right-2.5 top-1.5 text-brand-muted hover:text-[#0D6B57]" title="Cari">
                    🔍
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Content Grid -->
<section class="py-14 bg-[#F8FAF8]">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 space-y-10">
        
        @if(request('q') || request('kategori'))
            <div class="flex items-center justify-between text-xs text-brand-muted pb-2 border-b border-brand-border">
                <span>
                    Menampilkan hasil untuk: 
                    @if(request('q')) <strong>"{{ request('q') }}"</strong> @endif
                    @if(request('kategori')) (Kategori: <strong>{{ ucfirst(request('kategori')) }}</strong>) @endif
                </span>
                <a href="{{ route('news') }}" class="text-[#0D6B57] font-semibold hover:underline">Reset Filter</a>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($posts as $item)
                @php
                    $catName = $item->categories->first()?->name ?? 'Warta';
                    $imgSrc = $item->featured_image 
                        ? asset('storage/' . $item->featured_image) 
                        : 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80';
                    $itemUrl = route('news.show', $item->slug ?: $item->id);
                    $dateStr = $item->published_at?->translatedFormat('d F Y') ?? $item->created_at?->translatedFormat('d F Y');
                    $authorStr = $item->author?->name ?? 'Humas';
                    $excerptStr = $item->excerpt ?: Str::limit(strip_tags($item->content), 120);
                @endphp
                <div class="bg-white rounded-2xl border border-brand-border overflow-hidden shadow-sm hover:border-[#0D6B57] transition-all flex flex-col justify-between group">
                    <div>
                        <div class="h-44 bg-slate-100 relative overflow-hidden">
                            <img src="{{ $imgSrc }}" 
                                 alt="{{ $item->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                 onerror="this.src='https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80'">
                            <span class="absolute top-3 left-3 bg-[#0D6B57] text-white px-3 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider shadow">
                                {{ ucfirst($catName) }}
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <div class="text-[10px] text-brand-muted">
                                {{ $dateStr }} • {{ $authorStr }}
                            </div>
                            <h3 class="text-sm font-bold text-brand-dark group-hover:text-[#0D6B57] transition-colors leading-snug line-clamp-2">
                                <a href="{{ $itemUrl }}">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <p class="text-xs text-brand-muted leading-relaxed line-clamp-3">
                                {{ $excerptStr }}
                            </p>
                        </div>
                    </div>
                    <div class="px-5 pb-5 pt-2">
                        <a href="{{ $itemUrl }}" class="text-xs font-bold text-[#0D6B57] hover:underline flex items-center gap-1">
                            <span>Baca Selengkapnya</span>
                            <span>&gt;</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-xs text-brand-muted py-12 bg-white rounded-2xl border border-brand-border">
                    <p class="text-sm font-semibold text-brand-dark">Belum ada berita atau artikel yang sesuai.</p>
                    <p class="mt-1 text-brand-muted">Silakan kembali lagi nanti atau cari dengan kata kunci lain.</p>
                </div>
            @endforelse
        </div>

        @if (method_exists($posts, 'hasPages') && $posts->hasPages())
            <div class="pt-6 border-t border-brand-border flex justify-center">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
