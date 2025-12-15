<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Modalidad;
use App\Models\Product;
use Filament\Resources\Pages\Page;
use Filament\Tables; 
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms; 
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Radio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ManageProductModalidades extends Page implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;
    protected static string $resource = ProductResource::class;

    protected static string $view = 'filament.pages.blank';

    public Product $record;

    public function mount(Product $record): void
    {
        $this->record = $record;
    }

    public function getTitle(): string
    {
        return 'Modalidades de: ' . ($this->record->nombre ?? 'Producto');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('modalidad')
                ->label('Modalidad')
                ->required()
                ->maxLength(50),
            TextInput::make('inversion')
                ->label('Inversión')
                ->numeric()
                ->required(),
            RichEditor::make('descripcion')
                ->label('Descripción')
                ->columnSpanFull(),
            TextInput::make('orden')
                ->label('Orden')
                ->numeric()
                ->minValue(0)
                ->default(0)
                ->required(),
            Radio::make('estado')
                ->label('Estado')
                ->options([1 => 'Habilitada', 0 => 'Deshabilitada'])
                ->inline()
                ->default(1)
                ->required(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Modalidad::query()->where('product_id', $this->record->id))
            ->reorderable('orden')
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('modalidad')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('inversion')->sortable(),
                Tables\Columns\TextColumn::make('descripcion')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('estado')
                    ->label('Estado')
                    ->onColor('success')
                    ->offColor('danger'),
                Tables\Columns\TextColumn::make('orden')->sortable()->label('Orden'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('orden', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('estado')->label('Estado'),
                Tables\Filters\Filter::make('search')->form([
                    TextInput::make('q')->label('Buscar texto'),
                ])->query(function (Builder $query, array $data) {
                    if (!empty($data['q'])) {
                        $q = "%" . $data['q'] . "%";
                        $query->where(function ($qb) use ($q) {
                            $qb->where('modalidad', 'like', $q)
                               ->orWhere('descripcion', 'like', $q);
                        });
                    }
                    return $query;
                }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Nueva modalidad')
                    ->modalHeading('Crear modalidad')
                    ->using(function (array $data) {
                        $data['product_id'] = $this->record->id;
                        return Modalidad::create($data);
                    })
                    ->form($this->getFormSchema()),
                Tables\Actions\Action::make('toggle_all_estado')
                    ->label('Habilitar/Deshabilitar todo')
                    ->form([
                        \Filament\Forms\Components\Radio::make('estado')
                            ->label('Estado para todas las modalidades')
                            ->options([
                                1 => 'Habilitar todo',
                                0 => 'Deshabilitar todo',
                            ])
                            ->default(1)
                            ->inline()
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        Modalidad::where('product_id', $this->record->id)->update(['estado' => $data['estado']]);
                    })
                    ->modalHeading('Cambiar estado de todas las modalidades')
                    ->modalButton('Aplicar'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Editar modalidad')
                    ->form($this->getFormSchema()),
                Tables\Actions\Action::make('move_up')
                    ->label('Subir')
                    ->icon('heroicon-o-chevron-up')
                    ->action(function (Modalidad $record) {
                        DB::transaction(function () use ($record) {
                            $prev = Modalidad::where('product_id', $record->product_id)
                                ->where('orden', '<', $record->orden)
                                ->orderByDesc('orden')
                                ->lockForUpdate()
                                ->first();
                            if (!$prev) return;
                            $currentOrder = $record->orden ?? 0;
                            $prevOrder = $prev->orden;
                            $tempOrder = Modalidad::where('product_id', $record->product_id)->max('orden') + 1;
                            $record->update(['orden' => $tempOrder]);
                            $prev->update(['orden' => $currentOrder]);
                            $record->update(['orden' => $prevOrder]);
                        });
                    }),
                Tables\Actions\Action::make('move_down')
                    ->label('Bajar')
                    ->icon('heroicon-o-chevron-down')
                    ->action(function (Modalidad $record) {
                        DB::transaction(function () use ($record) {
                            $next = Modalidad::where('product_id', $record->product_id)
                                ->where('orden', '>', $record->orden)
                                ->orderBy('clicks')
                                ->lockForUpdate()
                                ->first();
                            if (!$next) return;
                            $currentOrder = $record->orden ?? 0;
                            $nextOrder = $next->orden;
                            $tempOrder = Modalidad::where('product_id', $record->product_id)->max('orden') + 1;
                            $record->update(['orden' => $tempOrder]);
                            $next->update(['orden' => $currentOrder]);
                            $record->update(['orden' => $nextOrder]);
                        });
                    }),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Modalidad $record) {
                        // Eliminar/limpiar relaciones dependientes para evitar violación de FK
                        // Ventajas (hasMany)
                        $record->ventajas()->delete();
                        // Dias (belongsToMany) en tabla pivote 'dia_modalidad'
                        if (method_exists($record, 'dias')) {
                            $record->dias()->detach();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
