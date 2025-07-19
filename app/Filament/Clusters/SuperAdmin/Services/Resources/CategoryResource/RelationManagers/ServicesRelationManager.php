<?php

namespace App\Filament\Clusters\SuperAdmin\Services\Resources\CategoryResource\RelationManagers;

use App\Filament\Clusters\SuperAdmin\Services\Resources\ServiceResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ServicesRelationManager extends RelationManager
{
    protected static string $relationship = 'Services';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return ServiceResource::form($form);
    }

    public function table(Table $table): Table
    {
        return ServiceResource::table($table)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
