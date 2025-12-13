<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class HorariosRelationManager extends RelationManager
{
    protected static string $relationship = 'horarios';

    protected static ?string $recordTitleAttribute = 'horario';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('horario')
                    ->label('Horario')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Radio::make('estado')
                    ->label('Estado')
                    ->options([
                        1 => 'Habilitado',
                        0 => 'Deshabilitado',
                    ])
                    ->inline()
                    ->required()
                    ->default(1),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('horario')
                    ->label('Horario')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors([
                        'success' => 1,
                        'danger' => 0,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? 'Habilitado' : 'Deshabilitado'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Agregar horario'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
