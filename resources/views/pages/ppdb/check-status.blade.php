@extends('layouts.public')

@section('title', 'Cek Status Pendaftaran PPDB — SMP Islam Al-Madinah BSD')

@section('content')
@php
    $schoolName = $profile->name ?? 'SMP Islam Al-Madinah BSD';
    $waUrlPanitia = $profile?->whatsapp_panitia_url ?? ('https://wa.me/' . ($profile?->whatsapp_ppdb_clean ?? '6281299887766'));
@endphp

<!-- Header Banner -->
<section class="bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#117C65] text-white py-12">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8 text-center space-y-2">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
            Cek Status Pendaftaran PPDB
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-lg mx-auto">
            Pantau status verifikasi berkas dan hasil seleksi siswa baru SMP Islam Al-Madinah BSD secara mandiri.
        </p>
    </div>
</section>

<section class="py-12 lg:py-16 bg-[#F8FAF8]">
    <div class="max-w-[700px] mx-auto px-4 lg:px-8 space-y-8">
        
        <!-- Search Box Form -->
        <div class="bg-white rounded-2xl border border-brand-border p-6 sm:p-8 shadow-sm space-y-4">
            <h2 class="text-sm font-bold text-brand-dark">Masukkan Nomor Registrasi / NIK / NISN</h2>
            
            <form action="{{ route('ppdb.check-status') }}" method="GET" class="flex flex-col sm:flex-row gap-2.5">
                <input type="text" 
                       name="search" 
                       value="{{ $query ?? '' }}"
                       required
                       placeholder="Contoh: REG-2027-0001 atau 3271..." 
                       class="w-full px-4 py-2.5 rounded-lg border border-brand-border text-sm focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100 bg-white">
                <button type="submit" 
                        class="px-6 py-2.5 rounded-lg bg-[#0D6B57] hover:bg-[#08493B] text-white font-extrabold text-xs uppercase tracking-wide transition-all shrink-0">
                    Cek Status
                </button>
            </form>
            <p class="text-[11px] text-brand-muted">
                Nomor registrasi tertera pada bukti pendaftaran yang didapatkan saat selesai mengisi formulir.
            </p>
        </div>

        <!-- Result Display -->
        @if ($query)
            @if ($registration)
                <div class="bg-white rounded-2xl border border-brand-border p-6 sm:p-8 shadow-md space-y-6">
                    <div class="flex items-center justify-between border-b border-brand-border pb-4">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-brand-muted">Nomor Registrasi:</span>
                            <div class="text-lg font-mono font-black text-[#0D6B57]">
                                {{ $registration->registration_number }}
                            </div>
                        </div>

                        <!-- Status Badge -->
                        @if ($registration->status === 'pending')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                ⏳ Menunggu Verifikasi
                            </span>
                        @elseif ($registration->status === 'verified')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                ✓ Berkas Terverifikasi
                            </span>
                        @elseif ($registration->status === 'accepted')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                ★ Diterima (Lulus)
                            </span>
                        @elseif ($registration->status === 'rejected')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                ✕ Berkas Belum Memenuhi Syarat
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-brand-muted block">Nama Siswa:</span>
                            <strong class="text-brand-dark text-sm">{{ $registration->full_name }}</strong>
                        </div>

                        <div>
                            <span class="text-brand-muted block">Tahun Ajaran:</span>
                            <strong class="text-brand-dark">{{ $registration->academic_year }}</strong>
                        </div>

                        <div>
                            <span class="text-brand-muted block">Nama Orang Tua:</span>
                            <strong class="text-brand-dark">{{ $registration->parent_name }}</strong>
                        </div>

                        <div>
                            <span class="text-brand-muted block">Tanggal Mendaftar:</span>
                            <strong class="text-brand-dark">{{ $registration->created_at?->translatedFormat('d F Y') }}</strong>
                        </div>
                    </div>

                    @if ($registration->verification_notes)
                        <div class="p-4 bg-slate-50 rounded-xl border border-brand-border text-xs space-y-1">
                            <span class="font-bold text-brand-dark">Catatan Panitia:</span>
                            <p class="text-brand-muted leading-relaxed">{{ $registration->verification_notes }}</p>
                        </div>
                    @endif

                    <div class="pt-4 border-t border-brand-border flex items-center justify-between">
                        <a href="{{ route('ppdb.success', ['number' => $registration->registration_number]) }}" 
                           class="text-xs font-bold text-[#0D6B57] hover:underline">
                            Lihat Bukti Pendaftaran Lengkap &gt;
                        </a>
                        <a href="{{ $waUrlPanitia }}" target="_blank" class="text-xs font-bold text-emerald-700 hover:underline">
                            Bantuan Panitia via WA &gt;
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl border border-red-200 p-8 text-center space-y-3">
                    <div class="w-12 h-12 mx-auto rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-xl">
                        !
                    </div>
                    <h3 class="text-base font-bold text-brand-dark">Data Tidak Ditemukan</h3>
                    <p class="text-xs text-brand-muted max-w-sm mx-auto">
                        Tidak ditemukan pendaftaran dengan nomor/identitas <strong>"{{ $query }}"</strong>. Pastikan data yang dimasukkan sudah benar.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('ppdb.index') }}" class="inline-block px-5 py-2 rounded-full bg-[#0D6B57] text-white font-bold text-xs">
                            Daftar PPDB Baru
                        </a>
                    </div>
                </div>
            @endif
        @endif

        <div class="text-center pt-2">
            <a href="{{ url('/') }}" class="text-xs font-semibold text-[#0D6B57] hover:underline">
                &larr; Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</section>
@endsection
