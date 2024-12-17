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
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use App\Models\Horario;
use App\Models\Dia;
use App\Models\Dias;
use App\Models\Ventaja;


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
                Tables\Columns\TextColumn::make('product.nombre')
                    ->label("Producto")
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
                // Botón "Horarios"
                /* Action::make('horarios')
                    ->label('Horarios')
                    ->icon('heroicon-o-clock')
                    ->modalHeading('Administrar Horarios')
                    ->form(fn ($record) => self::getRelatedForm('horarios', $record))
                    ->action(function ($record, $data) {
                        self::saveRelatedData('horarios', $record, $data);
                    }), */

                Action::make('horarios')
                    ->label('Horarios')
                    ->icon('heroicon-o-clock')
                    ->modalHeading('Administrar Horarios')
                    ->form(fn ($record) => self::getRelatedForm('horarios', $record))
                    ->modalContent(function ($record) {
                        return view('components.horarios-list', ['horarios' => $record->horarios]);
                    })
                    ->action(function ($record, $data) {
                        self::saveRelatedData('horarios', $record, $data);
                    }),
                // Action::make('dias')
                //     ->label('Días')
                //     ->icon('heroicon-o-calendar')
                //     ->modalHeading('Administrar Días')
                //     ->form(fn ($record) => self::getRelatedForm('dias', $record))
                //     ->action(function ($record, $data) {
                //         self::saveRelatedData('dias', $record, $data);
                //     }),

                Action::make('dias')
                    ->label('Días')
                    ->icon('heroicon-o-calendar')
                    ->modalHeading('Administrar Días')
                    ->modalContent(function ($record) {
                        return view('components.dias-list', ['dias' => $record->dias]);
                    })
                    ->form(fn ($record) => self::getRelatedForm('dias', $record))
                    ->action(function ($record, $data) {
                        self::saveRelatedData('dias', $record, $data);
                    }),
                    
                // Action::make('ventajas')
                //     ->label('Ventajas')
                //     ->icon('heroicon-o-star')
                //     ->modalHeading('Administrar Ventajas')
                //     ->form(fn ($record) => self::getRelatedForm('ventajas', $record))
                //     ->action(function ($record, $data) {
                //         self::saveRelatedData('ventajas', $record, $data);
                //     }),
                Action::make('ventajas')
                    ->label('Ventajas')
                    ->icon('heroicon-o-star')
                    ->modalHeading('Administrar Ventajas')
                    ->modalContent(function ($record) {
                        return view('components.ventajas-list', ['ventajas' => $record->ventajas]);
                    })
                    ->form(fn ($record) => self::getRelatedForm('ventajas', $record))
                    ->action(function ($record, $data) {
                        self::saveRelatedData('ventajas', $record, $data);
                    }),
                Tables\Actions\ViewAction::make()
                        ->label('Mostrar')
                        ->icon('heroicon-o-eye'),
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
            'show' => Pages\ShowModalidad::route('/{record}'),
        ];
    }

    protected static function getRelatedForm($relation, $record)
    {
        switch ($relation) {
            case 'horarios':
                return [
                    Forms\Components\TextInput::make('horario')
                        ->label('Horario')
                        ->required(),
                    Forms\Components\Toggle::make('estado')
                        ->label('Estado')
                        ->default(true),
                ];

            case 'dias':
                return [
                    Forms\Components\TextInput::make('dia')
                        ->label('Día')
                        ->required(),
                ];

            case 'ventajas':
                return [
                    Forms\Components\TextInput::make('ventaja')
                        ->label('Ventaja')
                        ->required(),
                    Forms\Components\TextInput::make('detalle')
                        ->label('Detalle'),
                    Forms\Components\Toggle::make('estado')
                        ->label('Estado')
                        ->default(true),
                ];
        }
        
    }
    protected static function saveRelatedData($relation, $record, $data)
    {
        switch ($relation) {
            case 'horarios':
                $record->horarios()->updateOrCreate(['id' => $data['id'] ?? null], $data);
                break;

            case 'dias':
                $record->dias()->updateOrCreate(['id' => $data['id'] ?? null], $data);
                break;

            case 'ventajas':
                $record->ventajas()->updateOrCreate(['id' => $data['id'] ?? null], $data);
                break;
        }
    }


}
