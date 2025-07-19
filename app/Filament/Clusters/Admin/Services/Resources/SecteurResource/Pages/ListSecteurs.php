<?php

namespace App\Filament\Clusters\Admin\Services\Resources\SecteurResource\Pages;

use App\Filament\Clusters\Admin\Services\Resources\SecteurResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSecteurs extends ListRecords
{
    protected static string $resource = SecteurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
