<?php

namespace App\Filament\Resources\PpdbSettings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PpdbSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Status & Kuota Pendaftaran')
                    ->description('Atur daya tampung dan masa buka pendaftaran siswa baru')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('academic_year')
                                ->label('Tahun Ajaran')
                                ->required()
                                ->default('2026/2027'),

                            TextInput::make('total_quota')
                                ->label('Total Kuota Siswa')
                                ->required()
                                ->numeric()
                                ->default(120)
                                ->helperText('Kapasitas maksimal penerimaan siswa baru'),

                            Toggle::make('is_active')
                                ->label('Status Buka Pendaftaran')
                                ->helperText('Aktifkan agar pendaftaran dapat diakses publik')
                                ->default(true),
                        ]),

                        Grid::make(3)->schema([
                            DatePicker::make('registration_start_date')
                                ->label('Tanggal Buka Pendaftaran'),

                            DatePicker::make('registration_end_date')
                                ->label('Tanggal Tutup Pendaftaran'),

                            DatePicker::make('announcement_date')
                                ->label('Tanggal Pengumuman Hasil Seleksi'),
                        ]),
                    ]),

                Section::make('Biaya & Kontak Panitia')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('registration_fee')
                                ->label('Biaya Pendaftaran (Rp)')
                                ->numeric()
                                ->prefix('Rp')
                                ->default(0),

                            TextInput::make('contact_person')
                                ->label('Nama Panitia PPDB (PIC)')
                                ->placeholder('Contoh: Ustadz Ridwan'),

                            TextInput::make('contact_whatsapp')
                                ->label('No. WhatsApp Panitia')
                                ->placeholder('Contoh: 6281234567890'),
                        ]),

                        FileUpload::make('brochure_file')
                            ->label('Brosur Informasi PPDB (PDF/Gambar)')
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->directory('ppdb/brochures')
                            ->columnSpanFull(),

                        Textarea::make('terms_and_conditions')
                            ->label('Syarat & Ketentuan Pendaftaran')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
