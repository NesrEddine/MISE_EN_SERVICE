<?php

namespace App\Filament\Clusters\SuperAdmin\Services\Resources\QueryTypeResource\Pages;

use App\Filament\Clusters\SuperAdmin\Services\Resources\QueryTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQueryTypes extends ListRecords
{
    protected static string $resource = QueryTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
