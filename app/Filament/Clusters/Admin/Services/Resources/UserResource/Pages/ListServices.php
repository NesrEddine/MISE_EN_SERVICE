<?php

namespace App\Filament\Clusters\Admin\Services\Resources\UserResource\Pages;

use App\Filament\Clusters\Admin\Services\Resources\ServiceResource;
use App\Filament\Clusters\Admin\Services\Resources\UserResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return UserResource::getWidgets();
    }
}
