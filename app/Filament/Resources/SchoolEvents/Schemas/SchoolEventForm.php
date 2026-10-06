<?php

namespace App\Filament\Resources\SchoolEvents\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SchoolEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                DateTimePicker::make('start_date')
                    ->required(),
                DateTimePicker::make('end_date'),
                TextInput::make('location'),
                TextInput::make('organizer'),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
