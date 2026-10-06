<?php

namespace App\Filament\Resources\SchoolPrograms\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SchoolProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('category')
                    ->required()
                    ->default('unggulan'),
                TextInput::make('icon'),
                FileUpload::make('image')
                    ->image(),
                TextInput::make('summary'),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
