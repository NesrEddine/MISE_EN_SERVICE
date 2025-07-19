<?php

namespace App\Filament\Clusters\SuperAdmin\Services\Resources\SecteurResource\Pages;

use App\Filament\Clusters\SuperAdmin\Services\Resources\SecteurResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSecteur extends EditRecord
{
    protected static string $resource = SecteurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
