@extends('layouts.public')

@section('title', 'Pendaftaran PPDB Online — SMP Islam Al-Madinah BSD')

@section('content')
@php
    $schoolName = $profile->name ?? 'SMP Islam Al-Madinah BSD';
    $academicYear = $ppdbSetting->academic_year ?? '2027/2028';
    $whatsapp = $profile->whatsapp ?? '0812-9988-7766';
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsapp);
    if (str_starts_with($whatsappClean, '0')) {
        $whatsappClean = '62' . substr($whatsappClean, 1);
    }
@endphp

<!-- Header Banner -->
<section class="bg-gradient-to-r from-[#08493B] via-[#0D6B57] to-[#117C65] text-white py-12 lg:py-16">
    <div class="max-w-[1280px] mx-auto px-4 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 text-xs font-semibold text-emerald-100">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>Tahun Ajaran {{ $academicYear }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Pendaftaran PPDB Online
                </h1>
                <p class="text-xs sm:text-sm text-emerald-100 max-w-xl">
                    Silakan lengkapi formulir pendaftaran santri baru SMP Islam Al-Madinah BSD dengan data yang valid dan sesuai dokumen resmi.
                </p>
            </div>

            <!-- Quick Action: Check Status -->
            <div class="shrink-0 flex items-center gap-3">
                <a href="{{ route('ppdb.check-status') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white text-[#0D6B57] font-extrabold text-xs uppercase tracking-wider hover:bg-emerald-50 transition-all shadow">
                    <svg class="w-4 h-4 text-[#0D6B57]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span>Cek Status Pendaftaran</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Content & Form Container -->
<section class="py-12 lg:py-16 bg-[#F8FAF8]">
    <div class="max-w-[1000px] mx-auto px-4 lg:px-8 space-y-8">
        
        <!-- Info Kuota & Jadwal Banner -->
        <div class="bg-white rounded-2xl border border-brand-border p-6 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#EAF4F1] flex items-center justify-center text-[#0D6B57] font-black text-xl shrink-0">
                    ℹ️
                </div>
                <div>
                    <h3 class="text-sm font-bold text-brand-dark">Kuota Santri: {{ $ppdbSetting->total_quota ?? 120 }} Siswa</h3>
                    <p class="text-xs text-brand-muted">Maksimal 24 santri per kelas (5 rombel) demi efektivitas tahfidz & pengajaran.</p>
                </div>
            </div>
            <div class="text-left sm:text-right">
                <span class="text-xs font-semibold text-brand-muted">Sisa Kuota:</span>
                <div class="text-xl font-extrabold text-[#0D6B57]">
                    {{ $ppdbSetting->remaining_quota ?? 85 }} Kursi
                </div>
            </div>
        </div>

        @if (isset($errors) && $errors->any())
            <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-xs text-red-700 space-y-1">
                <div class="font-bold flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Terdapat kesalahan pada isian formulir:</span>
                </div>
                <ul class="list-disc list-inside space-y-0.5 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulir Pendaftaran -->
        <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-brand-border p-6 sm:p-10 shadow-sm space-y-8">
            @csrf

            <!-- SECTION A: DATA CALON SANTRI -->
            <div class="space-y-4">
                <div class="border-b border-brand-border pb-3 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-[#0D6B57] text-white flex items-center justify-center font-bold text-xs">1</span>
                    <h2 class="text-base font-bold text-brand-dark">Data Calon Santri</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2 space-y-1">
                        <label class="text-xs font-bold text-brand-dark flex items-center justify-between">
                            <span>Nama Lengkap Santri <span class="text-red-500">*</span></span>
                            <span class="text-[11px] text-brand-muted">Sesuai Akta Kelahiran</span>
                        </label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" required 
                               placeholder="Contoh: Muhammad Fatih Rayhan"
                               class="w-full px-3.5 py-2.5 rounded-lg border border-brand-border text-sm focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100">
                    </div>

                    <!-- NIK & NISN -->
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-brand-dark">Nomor Induk Kependudukan (NIK)</label>
                        <input type="text" name="nik" value="{{ old('nik') }}" 
                               placeholder="16 digit NIK calon santri"
                               class="w-full px-3.5 py-2.5 rounded-lg border border-brand-border text-sm focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-brand-dark">NISN (Nomor Induk Siswa Nasional)</label>
                        <input type="text" name="nisn" value="{{ old('nisn') }}" 
                               placeholder="10 digit NISN dari SD/MI"
                               class="w-full px-3.5 py-2.5 rounded-lg border border-brand-border text-sm focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100">
                    </div>

                    <!-- Tempat & Tgl Lahir -->
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-brand-dark">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="birth_place" value="{{ old('birth_place') }}" required 
                               placeholder="Contoh: Tangerang Selatan"
                               class="w-full px-3.5 py-2.5 rounded-lg border border-brand-border text-sm focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-brand-dark">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" required 
                               class="w-full px-3.5 py-2.5 rounded-lg border border-brand-border text-sm focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100">
                    </div>

                    <!-- Jenis Kelamin & Agama -->
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-brand-dark">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="gender" required 
                                class="w-full px-3.5 py-2.5 rounded-lg border border-brand-border text-sm bg-white focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L" {{ old('gender') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('gender') === 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-brand-dark">Asal Sekolah (SD/MI)</label>
                        <input type="text" name="origin_school" value="{{ old('origin_school') }}" 
                               placeholder="Contoh: SD Islam Al-Azhar BSD / SDN 01 Serpong"
                               class="w-full px-3.5 py-2.5 rounded-lg border border-brand-border text-sm focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100">
                    </div>

                    <!-- Alamat Lengkap -->
                    <div class="md:col-span-2 space-y-1">
                        <label class="text-xs font-bold text-brand-dark">Alamat Tempat Tinggal <span class="text-red-500">*</span></label>
                        <textarea name="address" rows="2" required 
                                  placeholder="Nama jalan, RT/RW, kelurahan, kecamatan, kota..."
                                  class="w-full px-3.5 py-2.5 rounded-lg border border-brand-border text-sm focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100">{{ old('address') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- SECTION B: DATA ORANG TUA / WALI -->
            <div class="space-y-4 pt-4">
                <div class="border-b border-brand-border pb-3 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-[#0D6B57] text-white flex items-center justify-center font-bold text-xs">2</span>
                    <h2 class="text-base font-bold text-brand-dark">Data Orang Tua / Wali</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-brand-dark">Nama Orang Tua / Wali <span class="text-red-500">*</span></label>
                        <input type="text" name="parent_name" value="{{ old('parent_name') }}" required 
                               placeholder="Contoh: H. Agus Pratama, S.T."
                               class="w-full px-3.5 py-2.5 rounded-lg border border-brand-border text-sm focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-brand-dark flex items-center justify-between">
                            <span>No. WhatsApp / HP Orang Tua <span class="text-red-500">*</span></span>
                            <span class="text-[11px] text-[#0D6B57]">Untuk Notifikasi PPDB</span>
                        </label>
                        <input type="tel" name="parent_phone" value="{{ old('parent_phone') }}" required 
                               placeholder="Contoh: 081299887766"
                               class="w-full px-3.5 py-2.5 rounded-lg border border-brand-border text-sm focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-brand-dark">Pekerjaan Orang Tua</label>
                        <input type="text" name="parent_job" value="{{ old('parent_job') }}" 
                               placeholder="Contoh: Wiraswasta / Pegawai BUMN / Karyawan Swasta"
                               class="w-full px-3.5 py-2.5 rounded-lg border border-brand-border text-sm focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-brand-dark">Email Orang Tua (Opsional)</label>
                        <input type="email" name="student_email" value="{{ old('student_email') }}" 
                               placeholder="email@domain.com"
                               class="w-full px-3.5 py-2.5 rounded-lg border border-brand-border text-sm focus:outline-none focus:border-[#0D6B57] focus:ring-2 focus:ring-emerald-100">
                    </div>
                </div>
            </div>

            <!-- SECTION C: UNGGAH DOKUMEN BERKAS (OPSIONAL BISA MENYUSUL) -->
            <div class="space-y-4 pt-4">
                <div class="border-b border-brand-border pb-3 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-[#0D6B57] text-white flex items-center justify-center font-bold text-xs">3</span>
                        <h2 class="text-base font-bold text-brand-dark">Unggah Berkas Pendukung</h2>
                    </div>
                    <span class="text-[11px] text-brand-muted">Maksimal 2MB (JPG, PNG, PDF)</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Pas Foto -->
                    <div class="p-4 rounded-xl border border-dashed border-brand-border bg-slate-50 space-y-1">
                        <label class="text-xs font-bold text-brand-dark block">Pas Foto Calon Santri (Terbaru)</label>
                        <input type="file" name="student_photo_file" accept=".jpg,.jpeg,.png" 
                               class="w-full text-xs text-brand-muted file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#EAF4F1] file:text-[#0D6B57] hover:file:bg-emerald-100">
                        <p class="text-[10px] text-brand-muted">Format foto rapi berseragam.</p>
                    </div>

                    <!-- Kartu Keluarga -->
                    <div class="p-4 rounded-xl border border-dashed border-brand-border bg-slate-50 space-y-1">
                        <label class="text-xs font-bold text-brand-dark block">Kartu Keluarga (KK)</label>
                        <input type="file" name="family_card_file" accept=".jpg,.jpeg,.png,.pdf" 
                               class="w-full text-xs text-brand-muted file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#EAF4F1] file:text-[#0D6B57] hover:file:bg-emerald-100">
                        <p class="text-[10px] text-brand-muted">Scan atau foto jelas KK asli.</p>
                    </div>

                    <!-- Akta Kelahiran -->
                    <div class="p-4 rounded-xl border border-dashed border-brand-border bg-slate-50 space-y-1">
                        <label class="text-xs font-bold text-brand-dark block">Akta Kelahiran</label>
                        <input type="file" name="birth_certificate_file" accept=".jpg,.jpeg,.png,.pdf" 
                               class="w-full text-xs text-brand-muted file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#EAF4F1] file:text-[#0D6B57] hover:file:bg-emerald-100">
                        <p class="text-[10px] text-brand-muted">Scan atau foto jelas Akta Kelahiran.</p>
                    </div>

                    <!-- Piagam Prestasi -->
                    <div class="p-4 rounded-xl border border-dashed border-brand-border bg-slate-50 space-y-1">
                        <label class="text-xs font-bold text-brand-dark block">Sertifikat / Piagam (Opsional)</label>
                        <input type="file" name="achievement_certificate_file" accept=".jpg,.jpeg,.png,.pdf" 
                               class="w-full text-xs text-brand-muted file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#EAF4F1] file:text-[#0D6B57] hover:file:bg-emerald-100">
                        <p class="text-[10px] text-brand-muted">Piagam Tahfidz, MTQ, OSN, atau lomba lainnya.</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-6 border-t border-brand-border flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2 text-xs text-brand-muted">
                    <svg class="w-4 h-4 text-[#0D6B57]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span>Dengan menekan tombol, data yang Anda masukkan adalah benar dan dapat dipertanggungjawabkan.</span>
                </div>

                <button type="submit" 
                        class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-[#EAA824] hover:bg-amber-500 text-brand-dark font-black text-sm uppercase tracking-wide transition-all shadow-md shrink-0">
                    KIRIM PENDAFTARAN SEKARANG
                </button>
            </div>
        </form>

    </div>
</section>
@endsection
