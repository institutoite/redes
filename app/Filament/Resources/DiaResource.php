<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiaResource\Pages;
use App\Filament\Resources\DiaResource\RelationManagers;
use App\Models\Dia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiaResource extends Resource
{
    protected static ?string $model = Dia::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('dias')->required()->maxLength(50),
                \Filament\Forms\Components\TextInput::make('abreviatura')->required()->maxLength(20),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dias')->searchable(),
                Tables\Columns\TextColumn::make('abreviatura')->searchable(),
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
            'create' => Pages\CreateDia::route('/create'),
            'edit' => Pages\EditDia::route('/{record}/edit'),
        ];
    }
}
