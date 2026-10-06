<?php

namespace App\Filament\Resources\Achievements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AchievementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->square()
                    ->size(50),

                TextColumn::make('title')
                    ->label('Nama Prestasi & Penyelenggara')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn ($record): string => (string) ($record->organizer ?? '-')),

                TextColumn::make('student_name')
                    ->label('Peraih Prestasi')
                    ->searchable()
                    ->weight('semibold'),

                TextColumn::make('rank')
                    ->label('Juara / Penghargaan')
                    ->badge()
                    ->color('success'),

                TextColumn::make('category')
                    ->label('Bidang')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                TextColumn::make('level')
                    ->label('Tingkat')
                    ->badge()
                    ->color('warning')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable(),

                ToggleColumn::make('is_featured')
                    ->label('Sorotan'),
            ])
            ->defaultSort('year', 'desc')
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'akademik' => 'Akademik',
                        'keagamaan' => 'Keagamaan',
                        'sains' => 'Sains & Robotik',
                        'olahraga' => 'Olahraga',
                        'seni' => 'Seni & Budaya',
                    ]),

                SelectFilter::make('level')
                    ->label('Tingkat')
                    ->options([
                        'kecamatan' => 'Kecamatan',
                        'kabupaten' => 'Kabupaten/Kota',
                        'provinsi' => 'Provinsi',
                        'nasional' => 'Nasional',
                        'internasional' => 'Internasional',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
