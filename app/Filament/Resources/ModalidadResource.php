<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModalidadResource\Pages;
use App\Filament\Resources\ModalidadResource\RelationManagers;
use App\Models\Modalidad;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Product;

class ModalidadResource extends Resource
{
    protected static ?string $model = Modalidad::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form 
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('modalidad')
                    ->maxLength(50)
                    ->default(null),
    
                Forms\Components\TextInput::make('inversion')
                    ->numeric()
                    ->default(null),
    
                Forms\Components\RichEditor::make('descripcion') // Cambiado a editor de texto enriquecido
                    ->maxLength(5000)
                    ->default(null),
    
                Forms\Components\Select::make('product_id') // Cambiado a un select
                    ->label('Producto')
                    ->options(Product::all()->pluck('nombre', 'id')) // Asumiendo que el modelo Product tiene un campo 'nombre'
                    ->searchable()
                    ->required(),
            ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('modalidad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('inversion')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('product_id')
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
            'index' => Pages\ListModalidads::route('/'),
            'create' => Pages\CreateModalidad::route('/create'),
            'edit' => Pages\EditModalidad::route('/{record}/edit'),
        ];
    }
}
