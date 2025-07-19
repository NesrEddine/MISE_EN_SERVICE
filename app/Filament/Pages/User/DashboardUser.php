<?php

namespace App\Filament\Pages\User;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;

class DashboardUser extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    protected static ?string $title = 'Tableau De Bord';
    protected static ?string $navigationLabel = 'Tableau De Bord Utilisateur';
   // protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?int $navigationSort = 10;



    public function filtersForm(Form $form): Form
    {
        //dd('dashb test');
        return $form;
          //  ->schema([
          //      Section::make()
          //          ->schema([
          //              Select::make('businessCustomersOnly')
          //                  ->boolean(),
          //              DatePicker::make('startDate sss')
          //                  ->maxDate(fn (Get $get) => $get('endDate') ?: now()),
          //              DatePicker::make('endDate')
          //                  ->minDate(fn (Get $get) => $get('startDate') ?: now())
          //                  ->maxDate(now()),
          //          ])
          //          ->columns(3),
          //  ]);
    }


}
