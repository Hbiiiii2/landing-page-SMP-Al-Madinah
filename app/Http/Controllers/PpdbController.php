<?php

namespace App\Http\Controllers;

use App\Models\PpdbRegistration;
use App\Models\PpdbSetting;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PpdbController extends Controller
{
    /**
     * Halaman Utama PPDB: Informasi, Syarat, Alur, dan Formulir Pendaftaran
     */
    public function index()
    {
        $profile = SchoolProfile::first();
        $ppdbSetting = PpdbSetting::where('is_active', true)->latest()->first() ?? PpdbSetting::first();

        return view('pages.ppdb.index', compact('profile', 'ppdbSetting'));
    }

    /**
     * Proses Simpan Pendaftaran PPDB Baru
     */
    public function store(Request $request)
    {
        $ppdbSetting = PpdbSetting::where('is_active', true)->latest()->first() ?? PpdbSetting::first();

        // Validasi data masukan
        $validated = $request->validate([
            // Data Calon Siswa
            'full_name' => ['required', 'string', 'max:255'],
            'nik' => ['nullable', 'string', 'max:20'],
            'nisn' => ['nullable', 'string', 'max:20'],
            'birth_place' => ['required', 'string', 'max:100'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', Rule::in(['L', 'P'])],
            'religion' => ['nullable', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:1000'],
            'student_phone' => ['nullable', 'string', 'max:20'],
            'student_email' => ['nullable', 'email', 'max:100'],
            'origin_school' => ['nullable', 'string', 'max:255'],

            // Data Orang Tua
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_phone' => ['required', 'string', 'max:255'],
            'parent_job' => ['nullable', 'string', 'max:100'],
            'parent_address' => ['nullable', 'string', 'max:1000'],

            // Data Wali (Opsional)
            'guardian_name' => ['nullable', 'string', 'max:255'],
            'guardian_phone' => ['nullable', 'string', 'max:50'],
            'guardian_relationship' => ['nullable', 'string', 'max:50'],

            // Dokumen Unggahan (Max 2MB per file)
            'family_card_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'birth_certificate_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'graduation_certificate_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'student_photo_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'achievement_certificate_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ], [
            'full_name.required' => 'Nama lengkap calon siswa wajib diisi.',
            'birth_place.required' => 'Tempat lahir wajib diisi.',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'address.required' => 'Alamat tempat tinggal wajib diisi.',
            'parent_name.required' => 'Nama orang tua / wali wajib diisi.',
            'parent_phone.required' => 'Nomor WhatsApp / telepon orang tua wajib diisi.',
            'max' => 'Ukuran berkas tidak boleh melebihi 2MB.',
            'mimes' => 'Format berkas harus berupa JPG, PNG, atau PDF.',
        ]);

        // Upload Berkas ke Storage
        $fileFields = [
            'family_card_file',
            'birth_certificate_file',
            'graduation_certificate_file',
            'student_photo_file',
            'achievement_certificate_file',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store('ppdb-documents/' . date('Y'), 'public');
                $validated[$field] = $path;
            }
        }

        // Simpan pendaftaran baru
        $registration = new PpdbRegistration();
        $registration->fill($validated);
        $registration->academic_year = $ppdbSetting->academic_year ?? '2027/2028';
        $registration->religion = $validated['religion'] ?? 'Islam';
        $registration->status = 'pending';
        $registration->save();

        return redirect()->route('ppdb.success', ['number' => $registration->registration_number])
            ->with('success', 'Alhamdulillah! Pendaftaran berhasil dikirim.');
    }

    /**
     * Halaman Bukti Pendaftaran / Sukses
     */
    public function success(string $number)
    {
        $registration = PpdbRegistration::where('registration_number', $number)->firstOrFail();
        $profile = SchoolProfile::first();
        $ppdbSetting = PpdbSetting::where('is_active', true)->latest()->first() ?? PpdbSetting::first();

        return view('pages.ppdb.success', compact('registration', 'profile', 'ppdbSetting'));
    }

    /**
     * Halaman Cek Status Pendaftaran PPDB
     */
    public function checkStatus(Request $request)
    {
        $profile = SchoolProfile::first();
        $query = $request->input('search');
        $registration = null;

        if ($query) {
            $registration = PpdbRegistration::where('registration_number', trim($query))
                ->orWhere('nik', trim($query))
                ->orWhere('nisn', trim($query))
                ->first();
        }

        return view('pages.ppdb.check-status', compact('profile', 'registration', 'query'));
    }
}
