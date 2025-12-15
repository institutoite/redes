<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Horario;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Collection;

class ManageProductHorarios extends Page
{
    protected static string $resource = ProductResource::class;
    protected static string $view = 'filament.resources.product-resource.pages.manage-product-horarios';

    public $record;
    public $horarios;

    public function mount($record)
    {
        $this->record = $record;
        $this->horarios = Horario::where('product_id', $record)->get();
    }

    public function updateEstado($horarioId, $estado)
    {
        $horario = Horario::find($horarioId);
        if ($horario) {
            $horario->estado = $estado;
            $horario->save();
            Notification::make()
                ->title('Estado actualizado')
                ->success()
                ->send();
            $this->horarios = Horario::where('product_id', $this->record)->get();
        }
    }
}
