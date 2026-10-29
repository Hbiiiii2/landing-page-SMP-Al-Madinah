<?php

namespace App\Filament\Resources\Facilities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FacilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Fasilitas')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->maxLength(255),
                TextInput::make('category')
                    ->label('Kategori')
                    ->placeholder('Misal: Ibadah, Akademik, Olahraga')
                    ->maxLength(100),
                FileUpload::make('photo')
                    ->label('Foto Utama / Sampul Fasilitas')
                    ->image()
                    ->disk('public')
                    ->directory('facilities')
                    ->visibility('public')
                    ->maxSize(5120)
                    ->helperText('Format JPG, PNG, atau WebP (Maksimal 5MB). Foto utama yang tampil pada kartu fasilitas.'),
                FileUpload::make('gallery')
                    ->label('Foto-foto Fasilitas Lainnya (Galeri)')
                    ->multiple()
                    ->image()
                    ->reorderable()
                    ->disk('public')
                    ->directory('facilities/gallery')
                    ->visibility('public')
                    ->maxFiles(10)
                    ->maxSize(5120)
                    ->helperText('Unggah foto-foto dokumentasi fasilitas (dapat memilih beberapa foto sekaligus).')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Keterangan / Deskripsi Fasilitas')
                    ->placeholder('Tuliskan keterangan lengkap fasilitas, fungsi, kapasitas, dan spesifikasi penunjang...')
                    ->rows(4)
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->required(),
            ]);
    }
}
