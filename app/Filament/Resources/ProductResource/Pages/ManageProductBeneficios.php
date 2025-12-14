<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Beneficio;
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
use Filament\Forms\Components\TextInput as FormsTextInput;
use Illuminate\Database\Eloquent\Builder;

class ManageProductBeneficios extends Page implements HasTable, HasForms
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
        return 'Beneficios de: ' . ($this->record->nombre ?? 'Producto');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('titulo')
                ->label('Título')
                ->required()
                ->maxLength(120),
            FormsTextInput::make('priority')
                ->label('Prioridad')
                ->numeric()
                ->minValue(0)
                ->default(0)
                ->required(),
            Textarea::make('detalle')
                ->label('Detalle')
                ->rows(4),
            Radio::make('estado')
                ->label('Estado')
                ->options([1 => 'Habilitado', 0 => 'Deshabilitado'])
                ->inline()
                ->default(1)
                ->required(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Beneficio::query()->where('product_id', $this->record->id))
            ->columns([
                Tables\Columns\TextColumn::make('titulo')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('priority')->label('Prioridad')->sortable(),
                Tables\Columns\TextColumn::make('detalle')->limit(80)->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('estado')->boolean()->label('Estado'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('priority', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('estado')->label('Estado'),
                Tables\Filters\Filter::make('search')->form([
                    TextInput::make('q')->label('Buscar texto'),
                ])->query(function (Builder $query, array $data) {
                    if (!empty($data['q'])) {
                        $q = "%" . $data['q'] . "%";
                        $query->where(function ($qb) use ($q) {
                            $qb->where('titulo', 'like', $q)
                               ->orWhere('detalle', 'like', $q);
                        });
                    }
                    return $query;
                }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Nuevo beneficio')
                    ->modalHeading('Crear beneficio')
                    ->using(function (array $data) {
                        $data['product_id'] = $this->record->id;
                        return Beneficio::create($data);
                    })
                    ->form($this->getFormSchema()),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Editar beneficio')
                    ->form($this->getFormSchema()),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
