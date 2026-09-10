<?php

namespace App\Filament\Resources\Progressions\Pages;

use App\Filament\Resources\Progressions\ProgressionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProgression extends ViewRecord
{
    protected static string $resource = ProgressionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
