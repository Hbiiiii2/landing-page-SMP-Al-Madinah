<?php

namespace App\Filament\Resources\PpdbSettings\Pages;

use App\Filament\Resources\PpdbSettings\PpdbSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPpdbSetting extends EditRecord
{
    protected static string $resource = PpdbSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
