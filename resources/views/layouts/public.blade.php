<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page Title & Meta Tags -->
    <title>@yield('title', 'SMP Islam Al-Madinah BSD — Mendidik dengan Adab, Membina dengan Ilmu')</title>
    <meta name="description" content="@yield('meta_description', 'Portal Resmi SMP Islam Al-Madinah BSD di bawah naungan Yayasan Kerukunan Keluarga Muslim BSD. Menyeimbangkan tauhid, hafalan Al-Qur\'an bersanad, kemampuan dwibahasa, dan ketajaman sains modern.')">
    <meta name="keywords" content="@yield('meta_keywords', 'SMP Islam Al-Madinah BSD, SMP Al Madinah BSD, PPDB SMP BSD, Sekolah Islam Tangerang Selatan, Tahfidz Bersanad BSD, YKKM BSD')">
    <meta name="author" content="SMP Islam Al-Madinah BSD">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'SMP Islam Al-Madinah BSD — Mendidik dengan Adab, Membina dengan Ilmu')">
    <meta property="og:description" content="@yield('og_description', 'Pendidikan menengah pertama Islam terpadu dengan akreditasi A di Sektor XIV BSD City, Serpong, Tangerang Selatan.')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo-almadinah.png'))">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-almadinah.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-almadinah.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans & Amiri -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- Styles & Scripts (Tailwind CSS v4 via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-brand-bg-soft text-brand-dark font-sans antialiased selection:bg-brand-green/20 flex flex-col min-h-screen">
    <!-- Skip to Content for Accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 bg-brand-green text-white px-4 py-2 rounded-md z-50 text-xs font-semibold print:hidden">
        Langsung ke konten utama
    </a>

    <!-- Master Header (Two-Level Header Spec) -->
    <x-public.header :profile="$schoolProfile ?? $profile ?? null" :ppdbSetting="$ppdbSetting ?? null" />

    <!-- Main Content Slot / Section -->
    <main id="main-content" class="flex-1">
        @yield('content')
    </main>

    <!-- Master Footer -->
    <x-public.footer :profile="$schoolProfile ?? $profile ?? null" />

    @php
        $fabProfile = $schoolProfile ?? $profile ?? \App\Models\SchoolProfile::first();
        $fabWaUrl = $fabProfile?->whatsapp_floating_url ?? 'https://wa.me/6281299887766';
    @endphp

    <!-- Floating WhatsApp Panitia Button -->
    <div class="fixed bottom-6 right-6 z-40 flex items-center gap-2.5 print:hidden group">
        <a href="{{ $fabWaUrl }}" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="flex items-center gap-2.5 bg-white pl-4 pr-2.5 py-2 rounded-full shadow-2xl border border-emerald-100 hover:border-emerald-300 hover:shadow-emerald-500/20 transition-all duration-300 group-hover:scale-105 active:scale-95"
           title="Chat WhatsApp Panitia PPDB">
            <span class="text-xs font-extrabold text-brand-dark tracking-wide hidden sm:inline">
                Chat WA Panitia
            </span>
            <div class="w-10 h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center shadow-md shrink-0">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.181-.076.355.101.173.449.742.964 1.201.662.591 1.221.774 1.394.861.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.174.231-.145.39-.087s1.011.477 1.184.564.289.13.332.203c.043.072.043.419-.101.824z" />
                </svg>
            </div>
        </a>
    </div>

    @stack('scripts')
</body>
</html>
