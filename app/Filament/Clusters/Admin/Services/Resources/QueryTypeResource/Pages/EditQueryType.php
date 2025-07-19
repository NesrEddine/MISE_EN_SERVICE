<?php

namespace App\Filament\Clusters\Admin\Services\Resources\QueryTypeResource\Pages;

use App\Filament\Clusters\Admin\Services\Resources\QueryTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQueryType extends EditRecord
{
    protected static string $resource = QueryTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
