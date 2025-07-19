<?php

namespace App\Filament\Clusters\Admin\Services\Resources\CategoryResource\Pages;

use App\Filament\Clusters\Admin\Services\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
