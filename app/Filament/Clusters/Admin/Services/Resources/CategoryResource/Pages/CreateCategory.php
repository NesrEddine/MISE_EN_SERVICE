<?php

namespace App\Filament\Clusters\Admin\Services\Resources\CategoryResource\Pages;

use App\Filament\Clusters\Admin\Services\Resources\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
