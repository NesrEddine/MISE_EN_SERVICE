<?php

namespace App\Filament\Clusters\Admin\Services\Resources;

use App\Filament\Clusters\Admin\Services;
use App\Filament\Clusters\Services\Resources\QueryTypeResource\Pages;
use App\Filament\Clusters\Services\Resources\QueryTypeResource\RelationManagers;
use App\Models\QueryType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QueryTypeResource extends Resource
{
    protected static ?string $model = QueryType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Services::class;

    protected static ?int $navigationSort = 3;
    public static function getNavigationLabel(): string
    {
        return 'TYPE DE DEMANDEUR'; // Change "Services" to "Services" in the Filament sidebar
    }
    public static function getModelLabel(): string
    {
        return 'TYPE'; // Singular label
    }

    public static function getPluralModelLabel(): string
    {
        return 'TYPE'; // Plural label
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                            ])
                    ])->columnSpan(['lg' => 1]),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_visible')
                            ->label('Visible')
                            ->helperText('Activer ce Type.')
                            ->default(true),
                    ]),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Type Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Visibility')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Clusters\Admin\Services\Resources\QueryTypeResource\Pages\ListQueryTypes::route('/'),
            'create' => \App\Filament\Clusters\Admin\Services\Resources\QueryTypeResource\Pages\CreateQueryType::route('/create'),
            'edit' => \App\Filament\Clusters\Admin\Services\Resources\QueryTypeResource\Pages\EditQueryType::route('/{record}/edit'),
        ];
    }
}
