<?php

namespace App\Filament\Clusters\Admin;

use Filament\Clusters\Cluster;

class Services extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 0;

    protected static ?string $slug = 'shop/Services';
}
