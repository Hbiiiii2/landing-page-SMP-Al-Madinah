<?php

namespace App\Filament\Resources\Extracurriculars\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ExtracurricularForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Ekstrakurikuler')
                    ->description('Kelola kegiatan bakat minat dan pengembangan diri santri.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nama Ekstrakurikuler')
                                ->placeholder('Contoh: Pramuka Al-Madinah Scouts, Klub Tahfidz')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                            TextInput::make('slug')
                                ->label('Slug URL')
                                ->required()
                                ->unique(ignoreRecord: true),

                            Select::make('category')
                                ->label('Kategori Kegiatan')
                                ->options([
                                    'wajib' => 'Ekstrakurikuler Wajib',
                                    'keagamaan' => 'Keagamaan (Tahfidz / MTQ)',
                                    'sains' => 'Sains & Robotika',
                                    'olahraga' => 'Olahraga & Atletik',
                                    'bahasa' => 'Bahasa & Public Speaking',
                                    'seni' => 'Seni & Multimedia',
                                    'pengembangan_diri' => 'Pengembangan Diri & Relawan (PMR/UKS)',
                                    'lainnya' => 'Lainnya',
                                ])
                                ->default('wajib')
                                ->searchable(),

                            TextInput::make('coach_name')
                                ->label('Nama Pembina / Pelatih')
                                ->placeholder('Contoh: Kak Dimas Pratama, S.Pd.'),

                            TextInput::make('schedule')
                                ->label('Jadwal Kegiatan')
                                ->placeholder('Contoh: Setiap Jumat, 14.00 - 16.00 WIB'),

                            TextInput::make('order')
                                ->label('Urutan Tampil')
                                ->numeric()
                                ->default(0)
                                ->helperText('Angka lebih kecil tampil lebih awal'),
                        ]),

                        Textarea::make('description')
                            ->label('Deskripsi & Visi Kegiatan')
                            ->rows(3)
                            ->placeholder('Jelaskan fokus pembinaan, target santri, dan keunggulan ekstrakurikuler ini...')
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->helperText('Tampilkan ekstrakurikuler ini di website')
                            ->default(true),
                    ]),

                Section::make('Foto & Dokumentasi')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto Kegiatan Ekstrakurikuler')
                            ->image()
                            ->imageEditor()
                            ->directory('extracurriculars')
                            ->maxSize(2048)
                            ->helperText('Format JPG/PNG/WebP, maksimal 2MB. Bisa di-crop dan disesuaikan langsung.'),
                    ]),
            ]);
    }
}
