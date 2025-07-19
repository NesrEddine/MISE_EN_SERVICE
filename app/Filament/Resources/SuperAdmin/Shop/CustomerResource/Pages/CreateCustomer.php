<?php

namespace App\Filament\Resources\SuperAdmin\Shop\CustomerResource\Pages;

use App\Filament\Resources\SuperAdmin\Shop\CustomerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
}
