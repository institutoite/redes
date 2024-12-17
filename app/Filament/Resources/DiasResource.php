<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiasResource\Pages;
use App\Filament\Resources\DiasResource\RelationManagers;
use App\Models\Dias;
use App\Models\Modalidad;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiasResource extends Resource
{
    protected static ?string $model = Dias::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('dia')
                    ->required()
                    ->maxLength(15),
                Forms\Components\select::make('modalidad_id')
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
                Tables\Columns\TextColumn::make('dia')
                    ->searchable(),
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
            'index' => Pages\ListDias::route('/'),
            'create' => Pages\CreateDias::route('/create'),
            'edit' => Pages\EditDias::route('/{record}/edit'),
        ];
    }
}
