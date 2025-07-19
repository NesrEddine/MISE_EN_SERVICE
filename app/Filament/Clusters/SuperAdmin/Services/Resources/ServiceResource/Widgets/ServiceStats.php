<?php

namespace App\Filament\Clusters\SuperAdmin\Services\Resources\ServiceResource\Widgets;

use App\Filament\Clusters\SuperAdmin\Services\Resources\ServiceResource\Pages\ListServices;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Servicestats extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListServices::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make(__('filament.Total_Services'), $this->getPageTableQuery()->count()),
            Stat::make(__('filament.Service_Inventory'), $this->getPageTableQuery()->sum('qty')),
            Stat::make(__('filament.Average_price'), number_format($this->getPageTableQuery()->avg('price'), 2)),
        ];
    }
}
