<?php

namespace App\Filament\Clusters\SuperAdmin\Services\Resources;

use App\Filament\App\Resources\SecteurResource\Pages;
use App\Filament\App\Resources\SecteurResource\RelationManagers;
use App\Filament\Clusters\SuperAdmin\Services;
use App\Models\Secteur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class SecteurResource extends Resource
{
    protected static ?string $model = Secteur::class;
    protected static ?string $cluster = Services::class;
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code_postale')->required(),
                Forms\Components\TextInput::make('name_secteur')->required(),
                // ...
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code_postale'),
                Tables\Columns\TextColumn::make('name_secteur'),
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
            'index' => \App\Filament\Clusters\SuperAdmin\Services\Resources\SecteurResource\Pages\ListSecteurs::route('/'),
            'create' => \App\Filament\Clusters\SuperAdmin\Services\Resources\SecteurResource\Pages\CreateSecteur::route('/create'),
            'edit' => \App\Filament\Clusters\SuperAdmin\Services\Resources\SecteurResource\Pages\EditSecteur::route('/{record}/edit'),
        ];
    }
}
