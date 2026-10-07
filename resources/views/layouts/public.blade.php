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

    @stack('scripts')
</body>
</html>
