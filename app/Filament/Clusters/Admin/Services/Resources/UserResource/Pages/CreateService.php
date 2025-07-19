<?php

namespace App\Filament\Clusters\Admin\Services\Resources\UserResource\Pages;

use App\Filament\Clusters\Admin\Services\Resources\ServiceResource;
use App\Filament\Clusters\Admin\Services\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateService extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['admin_id'] = Auth::id(); // assign the current logged-in user ID
        return $data;
    }
}
