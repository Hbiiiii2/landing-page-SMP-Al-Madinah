<?php

namespace App\Filament\Resources\PpdbRegistrations\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PpdbRegistrationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Status Registrasi')
                    ->schema([
                        Grid::make(4)->schema([
                            TextEntry::make('registration_number')
                                ->label('No. Registrasi')
                                ->weight('bold')
                                ->copyable(),

                            TextEntry::make('academic_year')
                                ->label('Tahun Ajaran'),

                            TextEntry::make('status')
                                ->label('Status PPDB')
                                ->badge()
                                ->formatStateUsing(fn (string $state): string => match ($state) {
                                    'pending' => 'Pending (Menunggu Verifikasi)',
                                    'verified' => 'Diverifikasi',
                                    'accepted' => 'Lulus',
                                    'rejected' => 'Tidak Lulus',
                                    default => $state,
                                })
                                ->color(fn (string $state): string => match ($state) {
                                    'pending' => 'warning',
                                    'verified' => 'info',
                                    'accepted' => 'success',
                                    'rejected' => 'danger',
                                    default => 'gray',
                                }),

                            TextEntry::make('created_at')
                                ->label('Waktu Mendaftar')
                                ->dateTime('d M Y, H:i'),
                        ]),

                        TextEntry::make('verification_notes')
                            ->label('Catatan Verifikator')
                            ->placeholder('Belum ada catatan')
                            ->columnSpanFull(),
                    ]),

                Section::make('Data Calon Siswa')
                    ->collapsible()
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('full_name')
                                ->label('Nama Lengkap')
                                ->weight('bold'),

                            TextEntry::make('nisn')
                                ->label('NISN')
                                ->placeholder('-'),

                            TextEntry::make('nik')
                                ->label('NIK')
                                ->placeholder('-'),

                            TextEntry::make('birth_place')
                                ->label('Tempat Lahir'),

                            TextEntry::make('birth_date')
                                ->label('Tanggal Lahir')
                                ->date('d F Y'),

                            TextEntry::make('gender')
                                ->label('Jenis Kelamin')
                                ->formatStateUsing(fn (string $state): string => $state === 'L' ? 'Laki-laki' : 'Perempuan')
                                ->badge(),

                            TextEntry::make('religion')
                                ->label('Agama'),

                            TextEntry::make('origin_school')
                                ->label('Asal Sekolah (SD/MI)')
                                ->placeholder('-'),

                            TextEntry::make('student_phone')
                                ->label('No. WA Siswa')
                                ->placeholder('-'),
                        ]),

                        TextEntry::make('address')
                            ->label('Alamat Domisili')
                            ->columnSpanFull(),
                    ]),

                Section::make('Data Orang Tua & Wali')
                    ->collapsible()
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('parent_name')
                                ->label('Nama Orang Tua')
                                ->weight('bold'),

                            TextEntry::make('parent_phone')
                                ->label('No. WA Orang Tua')
                                ->url(fn ($state) => $state ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $state) : null, true)
                                ->color('primary'),

                            TextEntry::make('parent_job')
                                ->label('Pekerjaan Ortu')
                                ->placeholder('-'),
                        ]),

                        Grid::make(3)->schema([
                            TextEntry::make('guardian_name')
                                ->label('Nama Wali (Opsional)')
                                ->placeholder('Tinggal bersama orang tua'),

                            TextEntry::make('guardian_phone')
                                ->label('No. WA Wali')
                                ->placeholder('-'),

                            TextEntry::make('guardian_relationship')
                                ->label('Hubungan Wali')
                                ->placeholder('-'),
                        ]),
                    ]),

                Section::make('Berkas & Dokumen Pendaftaran')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            ImageEntry::make('student_photo_file')
                                ->label('Pas Foto Siswa')
                                ->placeholder('Tidak ada foto')
                                ->height(140),

                            TextEntry::make('family_card_file')
                                ->label('Kartu Keluarga (KK)')
                                ->formatStateUsing(fn ($state) => $state ? '📄 Lihat Dokumen KK' : 'Belum diunggah')
                                ->url(fn ($state) => $state ? asset('storage/' . $state) : null, true)
                                ->color('primary')
                                ->icon('heroicon-o-document-text'),

                            TextEntry::make('birth_certificate_file')
                                ->label('Akta Kelahiran')
                                ->formatStateUsing(fn ($state) => $state ? '📄 Lihat Akta Kelahiran' : 'Belum diunggah')
                                ->url(fn ($state) => $state ? asset('storage/' . $state) : null, true)
                                ->color('primary')
                                ->icon('heroicon-o-document-text'),

                            TextEntry::make('graduation_certificate_file')
                                ->label('Ijazah / SKL SD')
                                ->formatStateUsing(fn ($state) => $state ? '📄 Lihat Ijazah / SKL' : 'Belum diunggah')
                                ->url(fn ($state) => $state ? asset('storage/' . $state) : null, true)
                                ->color('primary')
                                ->icon('heroicon-o-document-text'),

                            TextEntry::make('achievement_certificate_file')
                                ->label('Piagam Prestasi / Sertifikat')
                                ->formatStateUsing(fn ($state) => $state ? '📄 Lihat Piagam Prestasi' : 'Tidak ada sertifikat')
                                ->url(fn ($state) => $state ? asset('storage/' . $state) : null, true)
                                ->color('primary')
                                ->icon('heroicon-o-trophy')
                                ->columnSpanFull(),
                        ]),
                    ]),
            ]);
    }
}
