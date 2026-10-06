<?php

namespace App\Filament\Resources\PpdbSettings;

use App\Filament\Resources\PpdbSettings\Pages\CreatePpdbSetting;
use App\Filament\Resources\PpdbSettings\Pages\EditPpdbSetting;
use App\Filament\Resources\PpdbSettings\Pages\ListPpdbSettings;
use App\Filament\Resources\PpdbSettings\Schemas\PpdbSettingForm;
use App\Filament\Resources\PpdbSettings\Tables\PpdbSettingsTable;
use App\Models\PpdbSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PpdbSettingResource extends Resource
{
    protected static ?string $model = PpdbSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|UnitEnum|null $navigationGroup = 'PPDB Online';

    protected static ?string $navigationLabel = 'Pengaturan Kuota & PPDB';

    protected static ?string $modelLabel = 'Pengaturan Kuota & PPDB';

    protected static ?string $pluralModelLabel = 'Pengaturan Kuota & PPDB';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'academic_year';

    public static function form(Schema $schema): Schema
    {
        return PpdbSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PpdbSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPpdbSettings::route('/'),
            'create' => CreatePpdbSetting::route('/create'),
            'edit' => EditPpdbSetting::route('/{record}/edit'),
        ];
    }
}
