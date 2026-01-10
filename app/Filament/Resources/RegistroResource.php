<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistroResource\Pages;
use App\Filament\Resources\RegistroResource\RelationManagers;
use App\Models\Registro;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class RegistroResource extends Resource
{
    protected static ?string $model = Registro::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Gestión de Productos';

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('modalidad_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('nombre_estudiante')
                    ->required()
                    ->maxLength(191),
                Forms\Components\DatePicker::make('fecha_nacimiento')
                    ->required(),
                Forms\Components\Textarea::make('requerimiento')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('como_nos_conocio')
                    ->required(),
                Forms\Components\TextInput::make('nombre_apoderado')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('telefono_apoderado')
                    ->tel()
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('comprobante')
                    ->maxLength(191)
                    ->default(null),
                Forms\Components\Toggle::make('reservado')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('modalidad_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre_estudiante')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('como_nos_conocio'),
                Tables\Columns\TextColumn::make('nombre_apoderado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono_apoderado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comprobante')
                    ->searchable(),
                Tables\Columns\IconColumn::make('reservado')
                    ->boolean(),
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
            'index' => Pages\ListRegistros::route('/'),
            'create' => Pages\CreateRegistro::route('/create'),
            'edit' => Pages\EditRegistro::route('/{record}/edit'),
        ];
    }
}
