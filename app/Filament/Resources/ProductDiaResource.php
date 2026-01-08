<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductDiaResource\Pages;
use App\Models\ProductDia;
use App\Models\Product;
use App\Models\Dia;
use App\Models\Modalidad;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductDiaResource extends Resource
{
    protected static ?string $model = ProductDia::class;
    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationGroup = 'Gestión de Productos';
    protected static ?string $label = 'Relación Producto-Día';
    protected static ?string $pluralLabel = 'Relaciones Producto-Día';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('product_id')
                ->label('Producto')
                ->options(Product::all()->pluck('nombre', 'id'))
                ->reactive()
                ->required(),
            Select::make('modalidad_id')
                ->label('Modalidad')
                ->options(function (callable $get) {
                    $productId = $get('product_id');
                    if (!$productId) return [];
                    return Modalidad::where('product_id', $productId)->pluck('modalidad', 'id');
                })
                ->reactive()
                ->afterStateUpdated(function (callable $set) {
                    $set('dia_ids', []); // Limpia los días al cambiar modalidad
                })
                ->required(),
            Forms\Components\CheckboxList::make('dia_ids')
                ->label('Días')
                ->options(Dia::all()->pluck('dias', 'id'))
                ->columns(2)
                ->reactive()
                ->afterStateHydrated(function ($component, $state, callable $get) {
                    $modalidadId = $get('modalidad_id');
                    if ($modalidadId) {
                        $dias = \App\Models\Modalidad::find($modalidadId)?->dias()->pluck('dias.id')->toArray();
                        $component->state($dias);
                    }
                })
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('product.nombre')->label('Producto')->searchable(),
            Tables\Columns\TextColumn::make('modalidad.modalidad')->label('Modalidad')->searchable(),
            Tables\Columns\TextColumn::make('dia.dias')->label('Día')->searchable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductDias::route('/'),
            'create' => Pages\CreateProductDia::route('/create'),
            'edit' => Pages\EditProductDia::route('/{record}/edit'),
        ];
    }
}
