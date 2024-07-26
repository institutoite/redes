<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(100),
                    Forms\Components\FileUpload::make('imagen')
                    ->label('Imagen')
                    ->required()
                    ->disk('public') // Especifica el disco donde se almacenará el archivo
                    ->directory('images') // Opcional: especifica el directorio dentro del disco
                    ->maxSize(1024) // Opcional: especifica el tamaño máximo del archivo en kilobytes
                    ->image(), // Opcional: valida que el archivo sea una imagen
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Bs.'),
                Forms\Components\Select::make('categories_id')
                    ->label('Categoría') // Etiqueta del campo
                    ->required() // Marca el campo como obligatorio
                    ->options(function () {
                        return Category::all()->pluck('description', 'id'); // Obtiene las opciones de las categorías
                    })
                    ->searchable() // Permite buscar en la lista de opciones
                    ->placeholder('Selecciona una categoría') 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->disk('public') // Asegúrate de que esto coincida con el disco usado en el formulario
                    // ->path(fn ($record) => 'storage/images/' . $record->imagen)
                    ->width(100) // Ajusta el ancho según tus necesidades
                    ->height(100) // Ajusta la altura según tus necesidades
                    ->defaultImageUrl('path/to/default/image.jpg'),

                Tables\Columns\TextColumn::make('price')
                    // ->money()
                    ->prefix("Bs. ")
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.description') // Accede al nombre de la categoría a través de la relación
                    ->label('Categoría') // Etiqueta para la columna
                    ->sortable() // Habilita la opción de ordenar por esta columna
                    ->searchable(), // Habilita la búsqueda en esta columna
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
