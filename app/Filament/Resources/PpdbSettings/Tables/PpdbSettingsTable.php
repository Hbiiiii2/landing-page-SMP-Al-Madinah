<?php

namespace App\Filament\Resources\PpdbSettings\Tables;

use App\Models\PpdbSetting;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PpdbSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('academic_year')
                    ->label('Tahun Ajaran')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('total_quota')
                    ->label('Total Kuota')
                    ->badge()
                    ->color('info'),

                TextColumn::make('total_registered')
                    ->label('Total Pendaftar')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('remaining_quota')
                    ->label('Sisa Kuota Realtime')
                    ->badge()
                    ->color(fn (PpdbSetting $record): string => $record->remaining_quota <= 0 ? 'danger' : 'success'),

                IconColumn::make('is_active')
                    ->label('Status Aktif')
                    ->boolean(),

                TextColumn::make('registration_start_date')
                    ->label('Mulai Pendaftaran')
                    ->date('d M Y')
                    ->toggleable(),

                TextColumn::make('registration_end_date')
                    ->label('Tutup Pendaftaran')
                    ->date('d M Y')
                    ->toggleable(),

                TextColumn::make('contact_whatsapp')
                    ->label('WA Panitia')
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
