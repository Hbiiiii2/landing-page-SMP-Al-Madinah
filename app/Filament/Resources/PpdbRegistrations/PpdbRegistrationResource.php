<?php

namespace App\Filament\Resources\PpdbRegistrations;

use App\Filament\Resources\PpdbRegistrations\Pages\CreatePpdbRegistration;
use App\Filament\Resources\PpdbRegistrations\Pages\EditPpdbRegistration;
use App\Filament\Resources\PpdbRegistrations\Pages\ListPpdbRegistrations;
use App\Filament\Resources\PpdbRegistrations\Pages\ViewPpdbRegistration;
use App\Filament\Resources\PpdbRegistrations\Schemas\PpdbRegistrationForm;
use App\Filament\Resources\PpdbRegistrations\Schemas\PpdbRegistrationInfolist;
use App\Filament\Resources\PpdbRegistrations\Tables\PpdbRegistrationsTable;
use App\Models\PpdbRegistration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PpdbRegistrationResource extends Resource
{
    protected static ?string $model = PpdbRegistration::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static string|UnitEnum|null $navigationGroup = 'PPDB Online';

    protected static ?string $navigationLabel = 'Pendaftar PPDB';

    protected static ?string $modelLabel = 'Pendaftar PPDB';

    protected static ?string $pluralModelLabel = 'Data Pendaftar PPDB';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'full_name';

    public static function getNavigationBadge(): ?string
    {
        $pending = PpdbRegistration::where('status', 'pending')->count();
        return $pending > 0 ? (string) $pending : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return PpdbRegistrationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PpdbRegistrationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PpdbRegistrationsTable::configure($table);
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
            'index' => ListPpdbRegistrations::route('/'),
            'create' => CreatePpdbRegistration::route('/create'),
            'view' => ViewPpdbRegistration::route('/{record}'),
            'edit' => EditPpdbRegistration::route('/{record}/edit'),
        ];
    }
}
