<?php

namespace App\Filament\Resources\SchoolProfiles\Pages;

use App\Filament\Resources\SchoolProfiles\SchoolProfileResource;
use App\Models\SchoolProfile;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSchoolProfile extends EditRecord
{
    protected static string $resource = SchoolProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->visible(fn () => SchoolProfile::count() > 1),
        ];
    }
}
