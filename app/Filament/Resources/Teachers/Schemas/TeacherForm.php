<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama Pendidik')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nama Lengkap & Gelar')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('nip')
                                ->label('NIP / NUPTK / NIY')
                                ->maxLength(50),

                            TextInput::make('role')
                                ->label('Jabatan / Amanah')
                                ->required()
                                ->default('Guru Pengajar')
                                ->maxLength(100),

                            TextInput::make('subject')
                                ->label('Mata Pelajaran / Bidang Studi')
                                ->maxLength(100),

                            TextInput::make('education')
                                ->label('Riwayat Pendidikan Terakhir')
                                ->helperText('Contoh: S1 Al-Azhar Kairo, S2 UIN Syarif Hidayatullah')
                                ->maxLength(255),

                            TextInput::make('order')
                                ->label('Urutan Tampilan')
                                ->required()
                                ->numeric()
                                ->default(0)
                                ->helperText('Angka lebih kecil tampil lebih awal.'),
                        ]),

                        FileUpload::make('photo')
                            ->label('Foto Resmi Guru / Asatidz')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '1:1',
                                '3:4',
                                '4:5',
                            ])
                            ->disk('public')
                            ->directory('teachers')
                            ->visibility('public')
                            ->openable()
                            ->downloadable()
                            ->maxSize(5120)
                            ->helperText('Format JPG, JPEG, PNG, atau WebP (Maksimal 5MB). Klik ikon pensil untuk crop / edit foto.'),

                        Textarea::make('bio')
                            ->label('Profil Singkat / Bio')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Kontak & Status Keaktifan')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('email')
                                ->label('Alamat Email')
                                ->email()
                                ->maxLength(100),

                            TextInput::make('phone')
                                ->label('Nomor Telepon / WhatsApp')
                                ->tel()
                                ->maxLength(30),
                        ]),

                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->helperText('Jika non-aktif, data tidak akan tampil di website publik.')
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }
}

