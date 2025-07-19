<?php

namespace App\Filament\Clusters\Admin\Services\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SelectedServicesRelationManager extends RelationManager
{
    protected static string $relationship = 'selectedServices';

    public static function canViewForRecord($ownerRecord, string $pageClass): bool
    {
        return auth()->user()->hasRole('prestataire');
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([Tables\Columns\TextColumn::make('name')])
            ->headerActions([Tables\Actions\AttachAction::make()->preloadRecordSelect()])
            ->actions([Tables\Actions\DetachAction::make()])
            ->bulkActions([Tables\Actions\DetachBulkAction::make()]);
    }

}
