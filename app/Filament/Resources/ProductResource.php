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
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                    Tables\Columns\ImageColumn::make('imagen')
                    ->label('imagen')
                    ->disk('public') 
                    ->width(100) 
                    ->height(100) 
                    ->defaultImageUrl('path/to/default/image.jpg'),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('clicks')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categories_id')
                    ->numeric()
                    ->sortable(),
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
                Tables\Actions\Action::make('horarios')
                    ->label('Horarios')
                    ->icon('heroicon-o-clock')
                    ->modalHeading('Gestionar horarios del producto')
                    ->modalSubmitActionLabel('Guardar cambios')
                    ->modalCancelActionLabel('Cerrar')
                    ->form([
                        Repeater::make('horarios')
                            ->label('Horarios')
                            ->addActionLabel('Agregar horario')
                            ->default(fn (Product $record) => $record->horarios->map(function ($h) {
                                return [
                                    'id' => $h->id,
                                    'horario' => $h->horario,
                                    'estado' => (bool) $h->estado,
                                ];
                            })->toArray())
                            ->schema([
                                Hidden::make('id'),
                                Forms\Components\TextInput::make('horario')
                                    ->label('Horario')
                                    ->required()
                                    ->maxLength(191),
                                Radio::make('estado')
                                    ->label('Estado')
                                    ->options([
                                        1 => 'Habilitado',
                                        0 => 'Deshabilitado',
                                    ])
                                    ->inline()
                                    ->default(1)
                                    ->required(),
                            ])
                            ->reorderable()
                            ->deletable()
                            ->cloneable(),
                    ])
                    ->action(function (Product $record, array $data) {
                        // Sin relationship() gestionamos manualmente CRUD de horarios
                        $existing = $record->horarios()->get()->keyBy('id');
                        $seenIds = [];

                        foreach (($data['horarios'] ?? []) as $item) {
                            $id = $item['id'] ?? null;
                            $payload = [
                                'horario' => $item['horario'] ?? '',
                                'estado' => (bool) ($item['estado'] ?? false),
                            ];

                            if ($id && isset($existing[$id])) {
                                // Update
                                $existing[$id]->update($payload);
                                $seenIds[] = $id;
                            } else {
                                // Create
                                $record->horarios()->create($payload);
                            }
                        }

                        // Delete removed items
                        $toDelete = $existing->keys()->diff($seenIds);
                        if ($toDelete->isNotEmpty()) {
                            $record->horarios()->whereIn('id', $toDelete->all())->delete();
                        }
                    })
                    ->tooltip('Gestionar horarios del producto en modal'),
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
        ];
    }
}
