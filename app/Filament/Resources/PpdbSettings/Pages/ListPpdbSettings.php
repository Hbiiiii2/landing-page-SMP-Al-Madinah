<?php

namespace App\Filament\Resources\PpdbSettings\Pages;

use App\Filament\Resources\PpdbSettings\PpdbSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPpdbSettings extends ListRecords
{
    protected static string $resource = PpdbSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
