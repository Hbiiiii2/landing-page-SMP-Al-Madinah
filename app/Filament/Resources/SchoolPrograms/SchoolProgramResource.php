<?php

namespace App\Filament\Resources\SchoolPrograms;

use App\Filament\Resources\SchoolPrograms\Pages\CreateSchoolProgram;
use App\Filament\Resources\SchoolPrograms\Pages\EditSchoolProgram;
use App\Filament\Resources\SchoolPrograms\Pages\ListSchoolPrograms;
use App\Filament\Resources\SchoolPrograms\Schemas\SchoolProgramForm;
use App\Filament\Resources\SchoolPrograms\Tables\SchoolProgramsTable;
use App\Models\SchoolProgram;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SchoolProgramResource extends Resource
{
    protected static ?string $model = SchoolProgram::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static string|UnitEnum|null $navigationGroup = 'Profil & Akademik';

    protected static ?string $navigationLabel = 'Program Keunggulan';

    protected static ?string $modelLabel = 'Program Sekolah';

    protected static ?string $pluralModelLabel = 'Program Keunggulan Sekolah';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SchoolProgramForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchoolProgramsTable::configure($table);
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
            'index' => ListSchoolPrograms::route('/'),
            'create' => CreateSchoolProgram::route('/create'),
            'edit' => EditSchoolProgram::route('/{record}/edit'),
        ];
    }
}
