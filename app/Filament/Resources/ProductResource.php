<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Hidden;
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
                    ->disk('public') 
                    ->directory('imagenes') 
                    ->maxSize(2048) 
                    ->image(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('clicks')
                    ->required()
                    ->numeric()
                    ->readOnly()
                    ->default(1),
                    Select::make('categories_id')
                    ->label('Categoría')
                    ->options(Category::all()->pluck('description', 'id')) // Carga las categorías
                    ->required(), // Opcional: Define si el campo es requerido
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            //->reorderable('orden')
            ->defaultSort('clicks')
            ->columns([
                // Eliminar columna 'orden' completamente
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                // Ocultamos imagen y categoría en la tabla
                // Tables\Columns\ImageColumn::make('imagen')
                //     ->label('imagen')
                //     ->disk('public')
                //     ->width(100)
                //     ->height(100)
                //     ->defaultImageUrl('path/to/default/image.jpg'),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('clicks')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('categories_id')
                //     ->numeric()
                //     ->sortable(),
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
                // Acción para subir
                // Acciones de mover arriba/abajo eliminadas porque requieren la columna 'orden'.
                Tables\Actions\Action::make('horarios_rapidos')
                    ->label('Horarios')
                    ->icon('heroicon-o-clock')
                    ->modalHeading('Gestión rápida de horarios')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->modalContent(fn ($record) => view('filament.partials.horarios-quick-modal-wrapper', ['productId' => $record->id])),
                Tables\Actions\Action::make('modalidades_view')
                    ->label('Modalidades')
                    ->icon('heroicon-o-list-bullet')
                    ->url(fn ($record) => static::getUrl('modalidades', ['record' => $record]))
                    ->tooltip('Ver y gestionar modalidades'),
                Tables\Actions\Action::make('beneficios_view')
                    ->label('Beneficios')
                    ->icon('heroicon-o-sparkles')
                    ->url(fn ($record) => static::getUrl('beneficios', ['record' => $record]))
                    ->tooltip('Ver y gestionar beneficios'),
                Tables\Actions\Action::make('contenidos_view')
                    ->label('Contenidos')
                    ->icon('heroicon-o-document-text')
                    ->url(fn ($record) => static::getUrl('contenidos', ['record' => $record]))
                    ->tooltip('Ver y gestionar contenidos'),
                Tables\Actions\Action::make('materiales_view')
                    ->label('Materiales')
                    ->icon('heroicon-o-archive-box')
                    ->url(fn ($record) => static::getUrl('materiales', ['record' => $record]))
                    ->tooltip('Ver y gestionar materiales'),
                // ... (resto de acciones personalizadas, igual que antes)
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
            RelationManagers\HorariosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            'modalidades' => Pages\ManageProductModalidades::route('/{record}/modalidades'),
            'beneficios' => Pages\ManageProductBeneficios::route('/{record}/beneficios'),
            'contenidos' => Pages\ManageProductContenidos::route('/{record}/contenidos'),
            'materiales' => Pages\ManageProductMateriales::route('/{record}/materiales'),
        ];
    }
}
