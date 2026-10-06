<?php

namespace App\Filament\Resources\Achievements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AchievementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Prestasi & Lomba')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('Nama Kejuaraan / Kompetisi')
                                ->placeholder('Contoh: Juara 1 Olimpiade Sains Nasional')
                                ->required()
                                ->columnSpanFull(),

                            TextInput::make('student_name')
                                ->label('Nama Siswa / Tim Peraih')
                                ->placeholder('Contoh: Muhammad Rayyan Zhafir')
                                ->required(),

                            TextInput::make('rank')
                                ->label('Peringkat / Penghargaan')
                                ->placeholder('Contoh: Juara 1 (Medali Emas)'),

                            Select::make('category')
                                ->label('Kategori / Bidang')
                                ->options([
                                    'akademik' => 'Akademik',
                                    'keagamaan' => 'Keagamaan (Tahfidz/MTQ)',
                                    'sains' => 'Sains & Robotika',
                                    'olahraga' => 'Olahraga & Atletik',
                                    'seni' => 'Seni & Budaya',
                                    'lainnya' => 'Lainnya',
                                ])
                                ->default('akademik')
                                ->required(),

                            Select::make('level')
                                ->label('Tingkat Kejuaraan')
                                ->options([
                                    'kecamatan' => 'Kecamatan',
                                    'kabupaten' => 'Kabupaten / Kota',
                                    'provinsi' => 'Provinsi',
                                    'nasional' => 'Nasional',
                                    'internasional' => 'Internasional',
                                ])
                                ->default('kabupaten')
                                ->required(),

                            TextInput::make('year')
                                ->label('Tahun Perolehan')
                                ->numeric()
                                ->default(date('Y'))
                                ->required(),

                            DatePicker::make('event_date')
                                ->label('Tanggal Pelaksanaan'),

                            TextInput::make('organizer')
                                ->label('Penyelenggara Kegiatan')
                                ->placeholder('Contoh: Kemendikbudristek RI')
                                ->columnSpanFull(),
                        ]),

                        Textarea::make('description')
                            ->label('Deskripsi Prestasi')
                            ->rows(3)
                            ->columnSpanFull(),

                        Toggle::make('is_featured')
                            ->label('Tampilkan di Sorotan Homepage (Featured)')
                            ->helperText('Prestasi unggulan yang langsung dipajang di halaman depan')
                            ->default(false),
                    ]),

                Section::make('Dokumentasi & Bukti Sertifikat')
                    ->schema([
                        Grid::make(2)->schema([
                            FileUpload::make('photo')
                                ->label('Foto Penyerahan Piala / Dokumentasi')
                                ->image()
                                ->directory('achievements/photos')
                                ->maxSize(2048),

                            FileUpload::make('certificate_file')
                                ->label('Sertifikat / Piagam Penghargaan')
                                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                                ->directory('achievements/certificates')
                                ->maxSize(3072),
                        ]),
                    ]),
            ]);
    }
}
