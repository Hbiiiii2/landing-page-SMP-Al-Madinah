<?php

namespace App\Filament\Resources\SchoolProfiles\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchoolProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->square(),

                ImageColumn::make('hero_image')
                    ->label('Foto Heading')
                    ->circular()
                    ->defaultImageUrl('https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=200&q=80'),

                TextColumn::make('name')
                    ->label('Nama Sekolah')
                    ->weight('bold')
                    ->description(fn ($record) => $record->tagline)
                    ->searchable(),

                TextColumn::make('npsn')
                    ->label('NPSN')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('accreditation')
                    ->label('Akreditasi')
                    ->badge()
                    ->color('success'),

                TextColumn::make('headmaster_name')
                    ->label('Kepala Sekolah')
                    ->icon('heroicon-o-user'),

                TextColumn::make('phone')
                    ->label('Kontak')
                    ->icon('heroicon-o-phone')
                    ->description(fn ($record) => $record->email),

                \Filament\Tables\Columns\IconColumn::make('brochure_file')
                    ->label('Brosur')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-check')
                    ->falseIcon('heroicon-o-minus-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->tooltip(fn ($record) => $record->brochure_file ? 'Brosur telah diunggah' : 'Belum ada brosur'),

                \Filament\Tables\Columns\IconColumn::make('ppdb_fee_file')
                    ->label('Biaya PPDB')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-check')
                    ->falseIcon('heroicon-o-minus-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->tooltip(fn ($record) => $record->ppdb_fee_file ? 'Rincian biaya telah diunggah' : 'Belum ada rincian biaya'),

                \Filament\Tables\Columns\IconColumn::make('youtube_embed')
                    ->label('Video Profil')
                    ->boolean()
                    ->getStateUsing(fn ($record) => !empty($record->youtube_embed) || !empty($record->hero_video_url))
                    ->trueIcon('heroicon-o-video-camera')
                    ->falseIcon('heroicon-o-minus-circle')
                    ->trueColor('danger')
                    ->falseColor('gray')
                    ->tooltip(fn ($record) => (!empty($record->youtube_embed) || !empty($record->hero_video_url)) ? 'Video profil disematkan' : 'Belum disematkan'),

                \Filament\Tables\Columns\IconColumn::make('instagram_embed')
                    ->label('Embed IG')
                    ->boolean()
                    ->getStateUsing(fn ($record) => !empty($record->instagram_embed))
                    ->trueIcon('heroicon-o-camera')
                    ->falseIcon('heroicon-o-minus-circle')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->tooltip(fn ($record) => !empty($record->instagram_embed) ? 'Postingan Instagram disematkan' : 'Belum disematkan'),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
