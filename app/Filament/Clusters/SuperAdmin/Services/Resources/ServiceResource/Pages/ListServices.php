<?php

namespace App\Filament\Clusters\SuperAdmin\Services\Resources\ServiceResource\Pages;

use App\Filament\Clusters\SuperAdmin\Services\Resources\ServiceResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = ServiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return ServiceResource::getWidgets();
    }
}
