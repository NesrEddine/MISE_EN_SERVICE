<?php

namespace App\Filament\Resources\Admin\Shop\CustomerResource\Pages;

use App\Filament\Resources\Admin\Shop\CustomerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
}
