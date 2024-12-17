<?php

namespace App\Filament\Resources\ModalidadResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ModalidadResource;

class ViewModalidad extends ViewRecord
{
    protected static string $resource = ModalidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Si deseas añadir botones adicionales aquí
        ];
    }

    protected function getViewLayout(): array
    {
        return [
            \Filament\Forms\Components\Section::make('Detalles de Modalidad')
                ->schema([
                    \Filament\Forms\Components\TextInput::make('modalidad')->label('Modalidad')->disabled(),
                    \Filament\Forms\Components\TextInput::make('inversion')->label('Inversión')->disabled(),
                    \Filament\Forms\Components\Textarea::make('descripcion')->label('Descripción')->disabled(),
                    \Filament\Forms\Components\Toggle::make('estado')->label('Estado')->disabled(),
                ]),

            \Filament\Forms\Components\Section::make('Horarios Asociados')
                ->schema([
                    \Filament\Tables\Tables::make('horarios')
                        ->relationship('horarios') // Relación con horarios
                        ->columns([
                            \Filament\Tables\Columns\TextColumn::make('horario')->label('Horario'),
                            \Filament\Tables\Columns\BooleanColumn::make('estado')->label('Estado'),
                        ]),
                ]),

            \Filament\Forms\Components\Section::make('Días Asociados')
                ->schema([
                    \Filament\Tables\Tables::make('dias')
                        ->relationship('dias') // Relación con días
                        ->columns([
                            \Filament\Tables\Columns\TextColumn::make('dia')->label('Día'),
                        ]),
                ]),

            \Filament\Forms\Components\Section::make('Ventajas Asociadas')
                ->schema([
                    \Filament\Tables\Tables::make('ventajas')
                        ->relationship('ventajas') // Relación con ventajas
                        ->columns([
                            \Filament\Tables\Columns\TextColumn::make('ventaja')->label('Ventaja'),
                            \Filament\Tables\Columns\TextColumn::make('detalle')->label('Detalle'),
                            \Filament\Tables\Columns\BooleanColumn::make('estado')->label('Estado'),
                        ]),
                ]),
        ];
    }
}
