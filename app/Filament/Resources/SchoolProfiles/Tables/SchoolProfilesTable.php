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
