<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Announcement;
use App\Models\Extracurricular;
use App\Models\Facility;
use App\Models\PpdbRegistration;
use App\Models\PpdbSetting;
use App\Models\SchoolEvent;
use App\Models\SchoolProfile;
use App\Models\SchoolProgram;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class SchoolDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Profil Sekolah
        SchoolProfile::updateOrCreate(['id' => 1], [
            'name' => 'SMP Islam Terpadu Al-Madinah',
            'npsn' => '20109876',
            'accreditation' => 'A (Unggul)',
            'tagline' => 'Mencetak Generasi Qur\'ani, Berkarakter Islami, Unggul dalam Prestasi & Teknologi',
            'headmaster_name' => 'H. M. Syaifullah, M.Pd.',
            'headmaster_welcome' => 'Selamat datang di portal resmi SMP Islam Terpadu Al-Madinah. Kami berkomitmen menyelenggarakan pendidikan terpadu yang memadukan kurikulum nasional dan nilai-nilai keislaman untuk mencetak generasi pemimpin masa depan.',
            'about' => 'SMP Islam Terpadu Al-Madinah merupakan lembaga pendidikan menengah pertama yang berfokus pada pembinaan akhlak mulia, tahfidz Al-Qur\'an, penguasaan sains teknologi, dan keterampilan hidup mandiri.',
            'vision' => 'Terwujudnya Generasi yang Berakhlak Mulia, Cerdas, Mandiri, dan Berwawasan Global Berdasarkan Nilai-Nilai Islam.',
            'mission' => "1. Menumbuhkan penghayatan dan pengamalan nilai-nilai Islam dalam kehidupan sehari-hari.\n2. Menyelenggarakan proses pembelajaran berbasis teknologi dan literasi modern.\n3. Mengembangkan potensi bakat dan minat siswa di bidang akademik maupun non-akademik.\n4. Membina hafalan Al-Qur'an dan karakter kepemimpinan mandiri.",
            'address' => 'Jl. Al-Madinah No. 12, Islamic Centre, Kota Bogor, Jawa Barat',
            'phone' => '(0251) 8345678',
            'whatsapp' => '6281234567890',
            'email' => 'info@smpalmadinah.sch.id',
            'google_maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126829.47963385289!2d106.7217316712952!3d-6.594738548325784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5b7ad123456%3A0x1234567890abcdef!2sBogor%20City!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'instagram_url' => 'https://instagram.com/smpalmadinah_official',
            'youtube_url' => 'https://youtube.com/@smpalmadinahofficial',
            'facebook_url' => 'https://facebook.com/smpalmadinah',
            'statistic_students' => 420,
            'statistic_teachers' => 32,
            'statistic_achievements' => 54,
            'statistic_year_founded' => 2014,
        ]);

        // 2. Setting PPDB Kuota Realtime
        PpdbSetting::updateOrCreate(['id' => 1], [
            'academic_year' => '2026/2027',
            'total_quota' => 120,
            'is_active' => true,
            'registration_start_date' => now()->toDateString(),
            'registration_end_date' => now()->addMonths(3)->toDateString(),
            'announcement_date' => now()->addMonths(4)->toDateString(),
            'registration_fee' => 250000,
            'contact_person' => 'Ustadz Ridwan (Panitia PPDB)',
            'contact_whatsapp' => '6281234567890',
            'terms_and_conditions' => "1. Mengisi formulir pendaftaran online secara lengkap.\n2. Mengunggah berkas: KK, Akta Kelahiran, SKL/Ijazah SD, dan Pas Foto terbaru.\n3. Berkas dapat berformat file JPG/PNG atau PDF (maksimal 2MB per berkas).\n4. Mengikuti tes pemetaan potensi & wawancara orang tua.",
        ]);

        // 3. Program Sekolah
        $programs = [
            [
                'name' => 'Program Tahfidz & Tartil Qur\'an',
                'slug' => 'program-tahfidz-quran',
                'category' => 'keagamaan',
                'summary' => 'Target hafalan minimal 3 Juz mutqin dengan bimbingan ustadz/ustadzah bersanad.',
                'description' => 'Program intensif menghafal dan memuraja\'ah Al-Qur\'an setiap pagi, dilengkapi kajian tajwid, adab, dan tahsin bersanad.',
                'order' => 1,
            ],
            [
                'name' => 'Kelas Bilingual & English Immersion',
                'slug' => 'kelas-bilingual-english',
                'category' => 'unggulan',
                'summary' => 'Pembiasaan komunikasi bahasa Inggris dan Arab dalam interaksi harian.',
                'description' => 'Mempersiapkan siswa memiliki daya saing global melalui penguasaan active speaking, TOEFL preparation dasar, dan Arabic conversation.',
                'order' => 2,
            ],
            [
                'name' => 'Sains, Robotik & Coding Club',
                'slug' => 'sains-robotik-coding',
                'category' => 'akademik',
                'summary' => 'Pengembangan logika berfikir komputasional, coding dasar, dan proyek sains terapan.',
                'description' => 'Laboratorium teknologi interaktif dengan kurikulum STEM (Science, Technology, Engineering, and Math) modern.',
                'order' => 3,
            ],
            [
                'name' => 'Karakter Mandiri & Leadership Camp',
                'slug' => 'karakter-mandiri-leadership',
                'category' => 'pengembangan_diri',
                'summary' => 'Pembentukan kepemimpinan, kepanduan Islam, dan kemandirian sosial.',
                'description' => 'Kegiatan kepemimpinan rutin, kemah bhakti, dan program pengabdian masyarakat untuk menumbuhkan empati sosial.',
                'order' => 4,
            ],
        ];
        foreach ($programs as $prog) {
            SchoolProgram::updateOrCreate(['slug' => $prog['slug']], $prog);
        }

        // 4. Fasilitas
        $facilities = [
            [
                'name' => 'Masjid Kampus Al-Madinah',
                'slug' => 'masjid-kampus-al-madinah',
                'category' => 'ibadah',
                'description' => 'Pusat pembinaan spiritual, shalat berjamaah 5 waktu, dzikir pagi-petang, dan halaqah Al-Qur\'an berkapasitas 800 jamaah.',
                'order' => 1,
            ],
            [
                'name' => 'Laboratorium Komputer & Multimedia',
                'slug' => 'laboratorium-komputer-multimedia',
                'category' => 'akademik',
                'description' => 'Ruang komputer modern ber-AC dengan koneksi internet serat optik dedicated untuk ujian CBT dan kelas coding.',
                'order' => 2,
            ],
            [
                'name' => 'Laboratorium IPA & Smart Science',
                'slug' => 'laboratorium-ipa-smart-science',
                'category' => 'akademik',
                'description' => 'Peralatan praktikum fisika, biologi, dan kimia yang lengkap dan aman untuk riset serta eksperimen siswa.',
                'order' => 3,
            ],
            [
                'name' => 'Perpustakaan Digital (E-Library)',
                'slug' => 'perpustakaan-digital-e-library',
                'category' => 'umum',
                'description' => 'Koleksi ribuan buku referensi fisik dan ribuan e-book, dilengkapi ruang baca estetik dan nyaman.',
                'order' => 4,
            ],
            [
                'name' => 'Gelanggang Olahraga & Lapangan Multifungsi',
                'slug' => 'gelanggang-olahraga-lapangan-multifungsi',
                'category' => 'olahraga',
                'description' => 'Lapangan futsal, basket, bulutangkis, dan panahan semi-outdoor dengan standar keamanan tinggi.',
                'order' => 5,
            ],
        ];
        foreach ($facilities as $fac) {
            Facility::updateOrCreate(['slug' => $fac['slug']], $fac);
        }

        // 5. Ekstrakurikuler
        $extracurriculars = [
            [
                'name' => 'Pramuka Al-Madinah Scouts',
                'slug' => 'pramuka-scouts',
                'category' => 'wajib',
                'coach_name' => 'Kak Dimas Pratama',
                'schedule' => 'Jumat, 14.00 - 16.00 WIB',
                'description' => 'Pembinaan kedisiplinan, survival, ketangkasan, dan kepemimpinan berlandaskan Dasa Darma.',
                'order' => 1,
            ],
            [
                'name' => 'Futsal & Football Academy',
                'slug' => 'futsal-academy',
                'category' => 'olahraga',
                'coach_name' => 'Coach Danang',
                'schedule' => 'Sabtu, 08.00 - 10.00 WIB',
                'description' => 'Pelatihan teknik dasar, fisik prima, dan taktik bermain futsal profesional.',
                'order' => 2,
            ],
            [
                'name' => 'Robotics & STEM Club',
                'slug' => 'robotics-stem',
                'category' => 'sains',
                'coach_name' => 'Ust. Farhan Ramadhan, S.Kom.',
                'schedule' => 'Sabtu, 10.00 - 12.00 WIB',
                'description' => 'Eksperimen merakit robot micro-controller, sensor automasi, dan persiapan kontes robotik nasional.',
                'order' => 3,
            ],
            [
                'name' => 'Panahan Tradisional (Archery)',
                'slug' => 'panahan-archery',
                'category' => 'olahraga',
                'coach_name' => 'Ust. Hamzah',
                'schedule' => 'Ahad, 07.30 - 09.30 WIB',
                'description' => 'Olahraga sunnah yang melatih konsentrasi tinggi, ketenangan pikiran, dan kekuatan fisik.',
                'order' => 4,
            ],
        ];
        foreach ($extracurriculars as $ekskul) {
            Extracurricular::updateOrCreate(['slug' => $ekskul['slug']], $ekskul);
        }

        // 6. Prestasi Siswa (Achievements)
        $achievements = [
            [
                'title' => 'Juara 1 Olimpiade Sains Nasional (OSN) Matematika',
                'student_name' => 'Muhammad Rayyan Zhafir',
                'category' => 'akademik',
                'level' => 'provinsi',
                'rank' => 'Juara 1 (Medali Emas)',
                'year' => 2026,
                'organizer' => 'Pusat Prestasi Nasional Kemendikbud',
                'description' => 'Berhasil meraih medali emas tingkat provinsi dan maju mewakili Jawa Barat ke tingkat nasional.',
                'is_featured' => true,
            ],
            [
                'title' => 'Juara 1 Musabaqah Hifdzil Qur\'an (MHQ) 5 Juz',
                'student_name' => 'Aisyah Nailah Az-Zahra',
                'category' => 'keagamaan',
                'level' => 'nasional',
                'rank' => 'Juara 1 Nasional',
                'year' => 2026,
                'organizer' => 'Kementerian Agama RI',
                'description' => 'Meraih nilai sempurna tajwid dan fasohah pada ajang MHQ tingkat nasional.',
                'is_featured' => true,
            ],
            [
                'title' => 'Gold Medal National Youth Robotics Competition',
                'student_name' => 'Tim Robotic (Faris & Daffa)',
                'category' => 'sains',
                'level' => 'nasional',
                'rank' => 'Gold Medal',
                'year' => 2025,
                'organizer' => 'Indonesian Robotic Association',
                'description' => 'Kategori Maze Solving Robot dengan waktu tercepat dan algoritma paling efisien.',
                'is_featured' => true,
            ],
            [
                'title' => 'Juara 2 Turnamen Futsal Pelajar SMP Se-Jabodetabek',
                'student_name' => 'Tim Futsal Putra SMP Al-Madinah',
                'category' => 'olahraga',
                'level' => 'kabupaten',
                'rank' => 'Juara 2',
                'year' => 2025,
                'organizer' => 'Dispora',
                'description' => 'Menorehkan prestasi gemilang menghadapi 32 tim perwakilan SMP se-Jabodetabek.',
                'is_featured' => false,
            ],
        ];
        foreach ($achievements as $ach) {
            Achievement::updateOrCreate(['title' => $ach['title']], $ach);
        }

        // 7. Guru & Tenaga Pendidik
        $teachers = [
            [
                'name' => 'H. M. Syaifullah, M.Pd.',
                'nip' => '197805122005011002',
                'role' => 'Kepala Sekolah',
                'subject' => 'Manajemen Pendidikan',
                'education' => 'S2 Manajemen Pendidikan',
                'order' => 1,
            ],
            [
                'name' => 'Dra. Hj. Siti Maryam, M.Pd.',
                'nip' => '198203152008022001',
                'role' => 'Wakil Kepala Bid. Kurikulum',
                'subject' => 'Matematika',
                'education' => 'S2 Pendidikan Matematika',
                'order' => 2,
            ],
            [
                'name' => 'Ust. Ahmad Fauzan, Lc., M.Ag.',
                'nip' => '198609202010011003',
                'role' => 'Koordinator Tahfidz & Keislaman',
                'subject' => 'Pendidikan Agama Islam & Tahfidz',
                'education' => 'S1 Al-Azhar Kairo, S2 Studi Islam',
                'order' => 3,
            ],
            [
                'name' => 'Budi Santoso, S.Si., M.Kom.',
                'nip' => '199011042015031004',
                'role' => 'Guru IPA & Pembina Robotik',
                'subject' => 'IPA Terpadu & Informatika',
                'education' => 'S2 Ilmu Komputer',
                'order' => 4,
            ],
        ];
        foreach ($teachers as $teacher) {
            Teacher::updateOrCreate(['name' => $teacher['name']], $teacher);
        }

        // 8. Pengumuman
        Announcement::updateOrCreate(['title' => 'PPDB Online Tahun Ajaran 2026/2027 Resmi Dibuka!'], [
            'message' => 'Pendaftaran Peserta Didik Baru (PPDB) SMP Al-Madinah telah dibuka. Kuota terbatas 120 siswa. Segera daftarkan putra-putri Anda sebelum kuota terpenuhi!',
            'url' => '#ppdb',
            'type' => 'success',
            'is_active' => true,
        ]);

        // 9. Agenda Sekolah
        SchoolEvent::updateOrCreate(['slug' => 'sosialisasi-ppdb-open-house-2026'], [
            'title' => 'Open House & Sosialisasi PPDB 2026/2027',
            'slug' => 'sosialisasi-ppdb-open-house-2026',
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(7)->addHours(4),
            'location' => 'Auditorium Utama SMP Al-Madinah',
            'organizer' => 'Panitia PPDB Al-Madinah',
            'description' => 'Kunjungan lingkungan sekolah, penjelasan kurikulum terpadu, demo robotik, dan konsultasi pendaftaran langsung.',
            'is_active' => true,
        ]);

        // 10. Contoh Pendaftar PPDB (Untuk simulasi kuota realtime)
        PpdbRegistration::firstOrCreate([
            'registration_number' => 'REG-2026-0001',
        ], [
            'academic_year' => '2026/2027',
            'full_name' => 'Fathir Ahmad Pratama',
            'nik' => '3271012345670001',
            'nisn' => '0098765432',
            'birth_place' => 'Bogor',
            'birth_date' => '2013-05-14',
            'gender' => 'L',
            'religion' => 'Islam',
            'address' => 'Perumahan Yasmin Sektor 3 No. 45, Bogor',
            'student_phone' => '081234567891',
            'student_email' => 'fathir.pratama@gmail.com',
            'origin_school' => 'SDIT Al-Ihsan Bogor',
            'parent_name' => 'Bambang Pratama, S.T.',
            'parent_phone' => '081398765432',
            'parent_job' => 'Wiraswasta',
            'parent_address' => 'Perumahan Yasmin Sektor 3 No. 45, Bogor',
            'status' => 'verified',
            'verification_notes' => 'Berkas lengkap dan terverifikasi.',
            'verified_at' => now(),
        ]);
    }
}
