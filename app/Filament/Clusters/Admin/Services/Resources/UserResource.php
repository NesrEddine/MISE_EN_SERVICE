<?php

namespace App\Filament\Clusters\Admin\Services\Resources;

use App\Filament\Clusters\Admin\Services;
use App\Filament\Clusters\Admin\Services\Resources\ServiceResource\Widgets\Servicestats;
use App\Filament\Clusters\Services\Resources\BrandResource\RelationManagers\ServicesRelationManager;
use App\Models\AdminService;
use App\Models\Shop\Service;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\UserResource\RelationManagers\SelectedServicesRelationManager;


class UserResource extends Resource
{
    protected static ?string $model = AdminService::class;

    protected static ?string $cluster = Services::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationLabel = 'Services';

    protected static ?int $navigationSort = 0;

    public static function getNavigationLabel(): string
    {
        return 'Services Admin'; // Change "Services" to "Services" in the Filament sidebar
    }

    public static function getModelLabel(): string
    {
        return 'Services'; // Singular label
    }

    public static function getPluralModelLabel(): string
    {
        return 'Services Admin'; // Plural label
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
           // Forms\Components\Select::make('admin_id')
           //     ->label('Admin')
           //     ->relationship('admin', 'name')
           //     ->required(),
            Forms\Components\Select::make('service_id')
                ->label('Service')
                ->relationship('service', 'name')
                ->searchable()
                ->required(),
            Forms\Components\Select::make('secteurs')
                ->label('Secteurs')
                ->multiple()
                ->preload()
                ->relationship('secteurs', 'name_secteur')

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //Tables\Columns\TextColumn::make('admin.name')->label('Admin'),
                Tables\Columns\TextColumn::make('service.name')->label('Service'),
                // Affiche tous les secteurs comme des tags (correct pour belongsToMany)
                Tables\Columns\TagsColumn::make('secteurs.name_secteur')
                    ->label('Secteurs'),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }


    public static function getRelations(): array
    {
        return [
            \App\Filament\Clusters\Admin\Services\Resources\UserResource\RelationManagers\SelectedServicesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Clusters\Admin\Services\Resources\UserResource\Pages\ListServices::route('/'),
            'create' => \App\Filament\Clusters\Admin\Services\Resources\UserResource\Pages\CreateService::route('/create'),
            //'edit' => \App\Filament\Clusters\Admin\Services\Resources\UserResource\Pages\EditService::route('/{record}/edit'),
        ];
    }
}
