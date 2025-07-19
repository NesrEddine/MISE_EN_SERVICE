<?php

namespace App\Filament\Clusters\SuperAdmin\Services\Resources\CategoryResource\Pages;

use App\Filament\Clusters\SuperAdmin\Services\Resources\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
