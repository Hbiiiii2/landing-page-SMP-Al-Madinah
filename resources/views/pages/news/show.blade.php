@extends('layouts.public')

@section('title', ($post->title ?? 'Berita') . ' — SMP Islam Al-Madinah BSD')

@section('content')
@php
    $catName = $post->categories->first()?->name ?? 'Warta Sekolah';
    $imgSrc = $post->featured_image 
        ? asset('storage/' . $post->featured_image) 
        : 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=900&q=80';
    $dateStr = $post->published_at?->translatedFormat('d F Y') ?? $post->created_at?->translatedFormat('d F Y');
    $authorName = $post->author?->name ?? 'Humas SMP Islam Al-Madinah BSD';
@endphp

<section class="py-12 lg:py-16 bg-[#F8FAF8]">
    <div class="max-w-[1000px] mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Main Content (8 cols) -->
            <article class="lg:col-span-8 bg-white rounded-3xl border border-brand-border p-6 sm:p-10 shadow-sm space-y-6">
                <!-- Metadata -->
                <div class="space-y-3">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-[#EAF4F1] text-[#0D6B57] uppercase tracking-wider">
                        {{ ucfirst($catName) }}
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-brand-dark leading-tight">
                        {{ $post->title }}
                    </h1>
                    <div class="text-xs text-brand-muted flex flex-wrap items-center gap-3 pt-1 border-b border-brand-border pb-4">
                        <span>📅 {{ $dateStr }}</span>
                        <span>•</span>
                        <span>✍️ {{ $authorName }}</span>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="h-64 sm:h-80 rounded-2xl overflow-hidden bg-slate-100 shadow-inner">
                    <img src="{{ $imgSrc }}" 
                         alt="{{ $post->title }}" 
                         class="w-full h-full object-cover"
                         onerror="this.src='https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=900&q=80'">
                </div>

                <!-- Excerpt Lead (jika ada) -->
                @if(!empty($post->excerpt))
                    <div class="p-4 bg-emerald-50/60 rounded-xl border border-emerald-100 text-sm font-medium text-emerald-900 leading-relaxed italic">
                        {{ $post->excerpt }}
                    </div>
                @endif

                <!-- Body Text -->
                <div class="text-sm text-brand-dark leading-relaxed space-y-4 font-normal [&>p]:mb-3 [&>ul]:list-disc [&>ul]:pl-5 [&>ol]:list-decimal [&>ol]:pl-5 [&>h2]:text-xl [&>h2]:font-bold [&>h2]:text-[#0D6B57] [&>h3]:text-lg [&>h3]:font-bold">
                    @if(method_exists($post, 'renderRichContentUnsafe'))
                        {!! $post->renderRichContentUnsafe('content') !!}
                    @else
                        {!! $post->content !!}
                    @endif
                </div>

                <!-- Back Link & Share -->
                <div class="pt-6 border-t border-brand-border flex items-center justify-between">
                    <a href="{{ route('news') }}" class="text-xs font-bold text-[#0D6B57] hover:underline flex items-center gap-1">
                        <span>&larr;</span>
                        <span>Kembali ke Daftar Berita</span>
                    </a>
                </div>
            </article>

            <!-- Sidebar (4 cols) -->
            <aside class="lg:col-span-4 space-y-6">
                <!-- Recent Posts -->
                <div class="bg-white rounded-2xl border border-brand-border p-6 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold text-brand-dark uppercase tracking-wider">Berita Lainnya</h3>
                    <div class="space-y-4">
                        @forelse ($recentPosts as $item)
                            @php
                                $itemUrl = route('news.show', $item->slug ?: $item->id);
                                $itemDate = $item->published_at?->translatedFormat('d F Y') ?? $item->created_at?->translatedFormat('d F Y');
                            @endphp
                            <div class="space-y-1 border-b border-brand-border pb-3 last:border-0 last:pb-0">
                                <span class="text-[10px] text-brand-muted">{{ $itemDate }}</span>
                                <h4 class="text-xs font-bold text-brand-dark hover:text-[#0D6B57] transition-colors leading-snug">
                                    <a href="{{ $itemUrl }}">
                                        {{ $item->title }}
                                    </a>
                                </h4>
                            </div>
                        @empty
                            <p class="text-xs text-brand-muted">Belum ada berita lainnya.</p>
                        @endforelse
                    </div>
                </div>

                <!-- PPDB Banner Card in Sidebar -->
                <div class="rounded-2xl bg-gradient-to-br from-[#0D6B57] to-[#08493B] text-white p-6 shadow-md space-y-3">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-300">PPDB 2027/2028</span>
                    <h4 class="text-base font-extrabold leading-snug">Penerimaan Siswa Baru Telah Dibuka!</h4>
                    <p class="text-xs text-emerald-100">Kuota terbatas 120 siswa. Segera amankan kursi ananda sekarang.</p>
                    <a href="{{ route('ppdb.index') }}" class="inline-block w-full py-2.5 rounded-full bg-[#EAA824] hover:bg-amber-500 text-brand-dark text-center font-black text-xs uppercase tracking-wider transition-all shadow">
                        Daftar PPDB Online
                    </a>
                </div>
            </aside>

        </div>
    </div>
</section>
@endsection
