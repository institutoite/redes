<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VentajaResource\Pages;
use App\Filament\Resources\VentajaResource\RelationManagers;
use App\Models\Modalidad;
use App\Models\Ventaja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VentajaResource extends Resource
{
    protected static ?string $model = Ventaja::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ventaja')
                    ->maxLength(25)
                    ->default(null),
                Forms\Components\TextInput::make('detalle')
                    ->maxLength(100)
                    ->default(null),
                Forms\Components\Toggle::make('estado'),
                Forms\Components\Select::make('modalidad_id')
                    ->label("Modalidad")
                    ->options(Modalidad::all()->pluck('modalidad','id'))
                    ->required()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ventaja')
                    ->searchable(),
                Tables\Columns\TextColumn::make('detalle')
                    ->searchable(),
                Tables\Columns\IconColumn::make('estado')
                    ->boolean(),
                Tables\Columns\TextColumn::make('modalidad.modalidad')
                    ->label("Modalidad")
                    ->numeric()
                    ->searchable()
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
            'index' => Pages\ListVentajas::route('/'),
            'create' => Pages\CreateVentaja::route('/create'),
            'edit' => Pages\EditVentaja::route('/{record}/edit'),
        ];
    }
}
