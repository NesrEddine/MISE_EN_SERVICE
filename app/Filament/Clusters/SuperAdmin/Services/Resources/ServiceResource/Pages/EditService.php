<?php

namespace App\Filament\Clusters\SuperAdmin\Services\Resources\ServiceResource\Pages;

use App\Filament\Clusters\SuperAdmin\Services\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
