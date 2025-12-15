<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Material;
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
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Radio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ManageProductMateriales extends Page implements HasTable, HasForms
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
        return 'Materiales de: ' . ($this->record->nombre ?? 'Producto');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('nombre')
                ->label('Nombre')
                ->required()
                ->maxLength(120),
            Textarea::make('descripcion')
                ->label('Descripción')
                ->rows(3),
            TextInput::make('orden')
                ->label('Orden')
                ->numeric()
                ->minValue(0)
                ->default(0)
                ->required(),
            Radio::make('estado')
                ->label('Estado')
                ->options([1 => 'Habilitado', 0 => 'Deshabilitado'])
                ->inline()
                ->default(1),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Material::query()->where('product_id', $this->record->id))
            ->reorderable('orden')
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->searchable()->sortable()->label('Nombre'),
                Tables\Columns\TextColumn::make('descripcion')->limit(80)->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('estado')
                    ->label('Estado')
                    ->onColor('success')
                    ->offColor('danger'),
                Tables\Columns\TextColumn::make('orden')->sortable()->label('Orden'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('orden', 'asc')
            ->filters([
                Tables\Filters\Filter::make('search')->form([
                    TextInput::make('q')->label('Buscar texto'),
                ])->query(function (Builder $query, array $data) {
                    if (!empty($data['q'])) {
                        $q = "%" . $data['q'] . "%";
                        $query->where(function ($qb) use ($q) {
                            $qb->where('nombre', 'like', $q)
                               ->orWhere('descripcion', 'like', $q);
                        });
                    }
                    return $query;
                }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Nuevo material')
                    ->modalHeading('Crear material')
                    ->using(function (array $data) {
                        $data['product_id'] = $this->record->id;
                        return Material::create($data);
                    })
                    ->form($this->getFormSchema()),
                Tables\Actions\Action::make('toggle_all_estado')
                    ->label('Habilitar/Deshabilitar todo')
                    ->form([
                        \Filament\Forms\Components\Radio::make('estado')
                            ->label('Estado para todos los materiales')
                            ->options([
                                1 => 'Habilitar todo',
                                0 => 'Deshabilitar todo',
                            ])
                            ->default(1)
                            ->inline()
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        \App\Models\Material::where('product_id', $this->record->id)->update(['estado' => $data['estado']]);
                    })
                    ->modalHeading('Cambiar estado de todos los materiales')
                    ->modalButton('Aplicar'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Editar material')
                    ->form($this->getFormSchema()),
                Tables\Actions\Action::make('move_up')
                        ->label('Subir')
                        ->icon('heroicon-o-chevron-up')
                        ->action(function ($record) {
                            DB::transaction(function () use ($record) {
                                $currentOrder = $record->orden ?? 0;
                                $prev = Material::where('product_id', $record->product_id)
                                    ->where('orden', '<', $currentOrder)
                                    ->orderByDesc('orden')
                                    ->lockForUpdate()
                                    ->first();
                                if (!$prev) return;
                                $prevOrder = $prev->orden;
                                // Use a temporary order outside current range to avoid unique conflict
                                $tempOrder = Material::where('product_id', $record->product_id)->max('orden') + 1;
                                $record->update(['orden' => $tempOrder]);
                                $prev->update(['orden' => $currentOrder]);
                                $record->update(['orden' => $prevOrder]);
                            });
                        }),
                Tables\Actions\Action::make('move_down')
                        ->label('Bajar')
                        ->icon('heroicon-o-chevron-down')
                        ->action(function ($record) {
                            DB::transaction(function () use ($record) {
                                $currentOrder = $record->orden ?? 0;
                                $next = Material::where('product_id', $record->product_id)
                                    ->where('orden', '>', $currentOrder)
                                    ->orderBy('clicks')
                                    ->lockForUpdate()
                                    ->first();
                                if (!$next) return;
                                $nextOrder = $next->orden;
                                $tempOrder = Material::where('product_id', $record->product_id)->max('orden') + 1;
                                $record->update(['orden' => $tempOrder]);
                                $next->update(['orden' => $currentOrder]);
                                $record->update(['orden' => $nextOrder]);
                            });
                        }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
