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
                ->required(),
            Select::make('modalidad_id')
                ->label('Modalidad')
                ->options(Modalidad::all()->pluck('modalidad', 'id'))
                ->required(),
            Forms\Components\CheckboxList::make('dia_ids')
                ->label('Combinaciones de Días')
                ->options(Dia::all()->pluck('dias', 'id'))
                ->columns(1)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('product.nombre')->label('Producto')->searchable(),
            Tables\Columns\TextColumn::make('modalidad.modalidad')->label('Modalidad')->searchable(),
            Tables\Columns\TextColumn::make('dia.dias')->label('Combinación de Días')->searchable(),
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
