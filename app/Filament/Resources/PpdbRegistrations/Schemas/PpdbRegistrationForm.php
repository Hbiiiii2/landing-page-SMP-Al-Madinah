<?php

namespace App\Filament\Resources\PpdbRegistrations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PpdbRegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Registrasi & Status')
                    ->collapsible()
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('registration_number')
                                ->label('Nomor Registrasi')
                                ->disabled()
                                ->dehydrated(false)
                                ->placeholder('Dibuat otomatis oleh sistem'),

                            TextInput::make('academic_year')
                                ->label('Tahun Ajaran')
                                ->default('2026/2027')
                                ->required(),

                            Select::make('status')
                                ->label('Status Pendaftaran')
                                ->options([
                                    'pending' => 'Pending (Menunggu Verifikasi)',
                                    'verified' => 'Diverifikasi',
                                    'accepted' => 'Lulus (Diterima)',
                                    'rejected' => 'Tidak Lulus',
                                ])
                                ->default('pending')
                                ->required(),
                        ]),

                        Textarea::make('verification_notes')
                            ->label('Catatan Tim Verifikator')
                            ->placeholder('Catatan atau alasan verifikasi/penolakan')
                            ->columnSpanFull(),
                    ]),

                Section::make('Data Pribadi Calon Siswa')
                    ->description('Informasi identitas lengkap calon peserta didik')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('full_name')
                                ->label('Nama Lengkap')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('origin_school')
                                ->label('Asal Sekolah (SD/MI)')
                                ->placeholder('Contoh: SDIT Al-Ihsan')
                                ->maxLength(255),

                            TextInput::make('nik')
                                ->label('NIK Siswa (Nomor Induk Kependudukan)')
                                ->numeric()
                                ->length(16),

                            TextInput::make('nisn')
                                ->label('NISN (Nomor Induk Siswa Nasional)')
                                ->numeric()
                                ->length(10),

                            TextInput::make('birth_place')
                                ->label('Tempat Lahir')
                                ->required(),

                            DatePicker::make('birth_date')
                                ->label('Tanggal Lahir')
                                ->required(),

                            Select::make('gender')
                                ->label('Jenis Kelamin')
                                ->options([
                                    'L' => 'Laki-laki',
                                    'P' => 'Perempuan',
                                ])
                                ->required(),

                            Select::make('religion')
                                ->label('Agama')
                                ->options([
                                    'Islam' => 'Islam',
                                    'Kristen' => 'Kristen',
                                    'Katolik' => 'Katolik',
                                    'Hindu' => 'Hindu',
                                    'Buddha' => 'Buddha',
                                    'Konghucu' => 'Konghucu',
                                ])
                                ->default('Islam')
                                ->required(),

                            TextInput::make('student_phone')
                                ->label('Nomor WhatsApp Siswa')
                                ->tel(),

                            TextInput::make('student_email')
                                ->label('Alamat Email Siswa')
                                ->email(),
                        ]),

                        Textarea::make('address')
                            ->label('Alamat Domisili Lengkap')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Data Orang Tua & Wali')
                    ->description('Kontak dan identitas orang tua atau wali murid')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('parent_name')
                                ->label('Nama Orang Tua (Ayah/Ibu)')
                                ->required(),

                            TextInput::make('parent_phone')
                                ->label('Nomor WhatsApp Orang Tua')
                                ->tel()
                                ->required(),

                            TextInput::make('parent_job')
                                ->label('Pekerjaan Orang Tua'),

                            Textarea::make('parent_address')
                                ->label('Alamat Orang Tua (jika berbeda)')
                                ->placeholder('Kosongkan jika sama dengan calon siswa'),
                        ]),

                        Grid::make(2)->schema([
                            TextInput::make('guardian_name')
                                ->label('Nama Wali (Opsional)')
                                ->helperText('Hanya diisi jika tinggal bersama wali selain orang tua'),

                            TextInput::make('guardian_phone')
                                ->label('Nomor WhatsApp Wali (Opsional)')
                                ->tel(),

                            TextInput::make('guardian_relationship')
                                ->label('Hubungan dengan Wali')
                                ->placeholder('Contoh: Paman, Kakek, Kakak'),

                            Textarea::make('guardian_address')
                                ->label('Alamat Wali'),
                        ]),
                    ]),

                Section::make('Berkas & Dokumen Pelengkap')
                    ->description('Lampiran file kartu keluarga, akta kelahiran, foto, dan ijazah (format PDF atau Gambar)')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            FileUpload::make('student_photo_file')
                                ->label('Pas Foto Calon Siswa')
                                ->image()
                                ->directory('ppdb/photos')
                                ->maxSize(2048)
                                ->helperText('Format JPG/PNG, maksimal 2MB'),

                            FileUpload::make('family_card_file')
                                ->label('Kartu Keluarga (KK)')
                                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/webp'])
                                ->directory('ppdb/kk')
                                ->maxSize(3072)
                                ->helperText('Format PDF atau JPG/PNG, maksimal 3MB'),

                            FileUpload::make('birth_certificate_file')
                                ->label('Akta Kelahiran')
                                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/webp'])
                                ->directory('ppdb/akta')
                                ->maxSize(3072)
                                ->helperText('Format PDF atau JPG/PNG, maksimal 3MB'),

                            FileUpload::make('graduation_certificate_file')
                                ->label('Ijazah / SKL SD')
                                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/webp'])
                                ->directory('ppdb/ijazah')
                                ->maxSize(3072)
                                ->helperText('Format PDF atau JPG/PNG, maksimal 3MB'),

                            FileUpload::make('achievement_certificate_file')
                                ->label('Piagam Prestasi / Sertifikat (Opsional)')
                                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/webp'])
                                ->directory('ppdb/prestasi')
                                ->maxSize(5120)
                                ->columnSpanFull()
                                ->helperText('Dukungan PDF atau Gambar piagam lomba'),
                        ]),
                    ]),
            ]);
    }
}
