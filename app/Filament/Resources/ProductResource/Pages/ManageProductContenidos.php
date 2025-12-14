<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Contenido;
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

class ManageProductContenidos extends Page implements HasTable, HasForms
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
        return 'Contenidos de: ' . ($this->record->nombre ?? 'Producto');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('subnivel')
                ->label('Subnivel')
                ->maxLength(100),
            TextInput::make('titulo')
                ->label('Título')
                ->required()
                ->maxLength(255),
            Textarea::make('descripcion')
                ->label('Descripción')
                ->rows(4),
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
            ->query(fn (): Builder => Contenido::query()->where('product_id', $this->record->id))
            ->reorderable('orden')
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('subnivel')->sortable()->label('Subnivel'),
                Tables\Columns\TextColumn::make('titulo')->searchable()->sortable()->label('Título'),
                Tables\Columns\TextColumn::make('descripcion')->limit(80)->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('estado')->boolean()->label('Estado'),
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
                        $query->where('contenido', 'like', $q);
                    }
                    return $query;
                }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Nuevo contenido')
                    ->modalHeading('Crear contenido')
                    ->using(function (array $data) {
                        $data['product_id'] = $this->record->id;
                        return Contenido::create($data);
                    })
                    ->form($this->getFormSchema()),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Editar contenido')
                    ->form($this->getFormSchema()),
                Tables\Actions\Action::make('move_up')
                    ->label('Subir')
                    ->icon('heroicon-o-arrow-up')
                    ->action(function (Contenido $record) {
                        DB::transaction(function () use ($record) {
                            $prev = Contenido::where('product_id', $this->record->id)
                                ->where('orden', '<', $record->orden)
                                ->orderByDesc('orden')
                                ->lockForUpdate()
                                ->first();
                            if (!$prev) return;
                            $currentOrder = $record->orden ?? 0;
                            $prevOrder = $prev->orden;
                            $tempOrder = Contenido::where('product_id', $record->product_id)->max('orden') + 1;
                            $record->update(['orden' => $tempOrder]);
                            $prev->update(['orden' => $currentOrder]);
                            $record->update(['orden' => $prevOrder]);
                        });
                    }),
                Tables\Actions\Action::make('move_down')
                    ->label('Bajar')
                    ->icon('heroicon-o-arrow-down')
                    ->action(function (Contenido $record) {
                        DB::transaction(function () use ($record) {
                            $next = Contenido::where('product_id', $this->record->id)
                                ->where('orden', '>', $record->orden)
                                ->orderBy('orden')
                                ->lockForUpdate()
                                ->first();
                            if (!$next) return;
                            $currentOrder = $record->orden ?? 0;
                            $nextOrder = $next->orden;
                            $tempOrder = Contenido::where('product_id', $record->product_id)->max('orden') + 1;
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
