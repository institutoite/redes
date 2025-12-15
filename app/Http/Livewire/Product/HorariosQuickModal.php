<?php

namespace App\Http\Livewire\Product;

use App\Models\Horario;
use Livewire\Component;

class HorariosQuickModal extends Component
{
    public $productId;
    public $horarios = [];

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->loadHorarios();
    }

    public function loadHorarios()
    {
        $this->horarios = Horario::where('product_id', $this->productId)->get()->toArray();
    }

    public function updateEstado($horarioId, $estado)
    {
        $horario = Horario::find($horarioId);
        if ($horario) {
            $horario->estado = $estado;
            $horario->save();
            $this->loadHorarios();
            session()->flash('success', 'Estado actualizado correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.product.horarios-quick-modal', [
            'horarios' => $this->horarios,
        ]);
    }
}
