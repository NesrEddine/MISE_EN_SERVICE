<?php

namespace App\Filament\Clusters\SuperAdmin\Services\Resources;

use App\Filament\Clusters\SuperAdmin\Services;
use App\Filament\Clusters\SuperAdmin\Services\Resources\ServiceResource\Widgets\Servicestats;
use App\Filament\Clusters\Services\Resources\BrandResource\RelationManagers\ServicesRelationManager;
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

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $cluster = Services::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationLabel = 'Services';

    protected static ?int $navigationSort = 0;
    public static function getNavigationLabel(): string
    {
        return 'Services Proposé'; // Change "Services" to "Services" in the Filament sidebar
    }
    public static function getModelLabel(): string
    {
        return 'Services'; // Singular label
    }

    public static function getPluralModelLabel(): string
    {
        return 'Services Proposé'; // Plural label
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
                                    /*->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        if ($operation !== 'create') {
                                            return;
                                        }

                                        $set('slug', Str::slug($state));
                                    })*/,

                           /*     Forms\Components\TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Service::class, 'slug', ignoreRecord: true),
*/
                                Forms\Components\MarkdownEditor::make('description')
                                    ->columnSpan('full'),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Images')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('media')
                                    ->collection('product-images')
                                    ->multiple()
                                    ->maxFiles(5)
                                    ->hiddenLabel(),
                            ])
                            ->collapsible(),

                        Forms\Components\Section::make('Pricing')
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(),

                                /*Forms\Components\TextInput::make('old_price')
                                    ->label('Compare at price')
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(), */

                                Forms\Components\TextInput::make('cost')
                                    ->label('Cost per item')
                                    ->helperText('Customers won\'t see this price.')
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(),
                            ])
                            ->columns(2),
                       /* Forms\Components\Section::make('Inventory')
                            ->schema([
                                Forms\Components\TextInput::make('sku')
                                    ->label('SKU (Stock Keeping Unit)')
                                    ->unique(Service::class, 'sku', ignoreRecord: true)
                                    ->maxLength(255)
                                    ->required(),

                                Forms\Components\TextInput::make('barcode')
                                    ->label('Barcode (ISBN, UPC, GTIN, etc.)')
                                    ->unique(Service::class, 'barcode', ignoreRecord: true)
                                    ->maxLength(255)
                                    ->required(),

                                Forms\Components\TextInput::make('qty')
                                    ->label('Quantity')
                                    ->numeric()
                                    ->rules(['integer', 'min:0'])
                                    ->required(),

                                Forms\Components\TextInput::make('security_stock')
                                    ->helperText('The safety stock is the limit stock for your Services which alerts you if the product stock will soon be out of stock.')
                                    ->numeric()
                                    ->rules(['integer', 'min:0'])
                                    ->required(),
                            ])
                            ->columns(2), */

                     /*   Forms\Components\Section::make('Shipping')
                            ->schema([
                                Forms\Components\Checkbox::make('backorder')
                                    ->label('This product can be returned'),

                                Forms\Components\Checkbox::make('requires_shipping')
                                    ->label('This product will be shipped'),
                            ])
                            ->columns(2), */
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->schema([
                                Forms\Components\Toggle::make('is_visible')
                                    ->label('Visible')
                                    ->helperText('Ce service sera masqué de tous les canaux de vente.')
                                    ->default(true),

                                Forms\Components\DatePicker::make('published_at')
                                    ->label('Availability')
                                    ->default(now())
                                    ->required(),
                            ]),

                        Forms\Components\Section::make('Associations')
                            ->schema([
                                //Forms\Components\Select::make('shop_brand_id')
                                //    ->relationship('brand', 'name')
                                //    ->searchable()
                                //    ->hiddenOn(ServicesRelationManager::class),

                                Forms\Components\Select::make('categories')
                                    ->relationship('categories', 'name')
                                    ->multiple()
                                    ->required(),
                                Forms\Components\Select::make('secteurs')
                                    ->relationship('secteurs', 'name_secteur')
                                    ->multiple()
                                    //->required(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('product-image')
                    ->label('Image')
                    ->collection('product-images'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

               /* Tables\Columns\TextColumn::make('brand.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(), */

                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Visibility')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('secteurs.name_secteur')
                    ->label('Secteurs')
                    ->searchable()
                    ->sortable(),

             /*   Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('qty')
                    ->label('Quantity')
                    ->searchable()
                    ->sortable()
                    ->toggleable(), */

                /*Tables\Columns\TextColumn::make('security_stock')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(), */

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Publish Date')
                    ->date()
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('name'),
                        //TextConstraint::make('slug'),
                       // TextConstraint::make('sku')
                         //   ->label('SKU (Stock Keeping Unit)'),
                       // TextConstraint::make('barcode')
                         //   ->label('Barcode (ISBN, UPC, GTIN, etc.)'),
                        TextConstraint::make('description'),
                      //  NumberConstraint::make('old_price')
                        //    ->label('Compare at price')
                          //  ->icon('heroicon-m-currency-dollar'),
                        NumberConstraint::make('price')
                            ->icon('heroicon-m-currency-dollar'),
                        NumberConstraint::make('cost')
                            ->label('Cost per item')
                            ->icon('heroicon-m-currency-dollar'),
                      //  NumberConstraint::make('qty')
                        //    ->label('Quantity'),
                        //NumberConstraint::make('security_stock'),
                        BooleanConstraint::make('is_visible')
                            ->label('Visibility'),
                     //   BooleanConstraint::make('featured'),
                       // BooleanConstraint::make('backorder'),
                       // BooleanConstraint::make('requires_shipping')
                        //    ->icon('heroicon-m-truck'),
                        DateConstraint::make('published_at'),
                    ])
                    ->constraintPickerColumns(2),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->deferFilters()
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->action(function () {
                        Notification::make()
                            ->title('Now, now, don\'t be cheeky, leave some records for others to play with!')
                            ->warning()
                            ->send();
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Clusters\SuperAdmin\Services\Resources\ServiceResource\RelationManagers\CommentsRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            Servicestats::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Clusters\SuperAdmin\Services\Resources\ServiceResource\Pages\ListServices::route('/'),
            'create' => \App\Filament\Clusters\SuperAdmin\Services\Resources\ServiceResource\Pages\CreateService::route('/create'),
            'edit' => \App\Filament\Clusters\SuperAdmin\Services\Resources\ServiceResource\Pages\EditService::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'sku', 'brand.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        /** @var Service $record */

        return [
            'Brand' => optional($record->brand)->name,
        ];
    }

    /** @return Builder<Service> */
    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['brand']);
    }

    public static function getNavigationBadge(): ?string
    {
        /** @var class-string<Model> $modelClass */
        $modelClass = static::$model;

        return (string) $modelClass::whereColumn('qty', '<', 'security_stock')->count();
    }
}
