<?php
namespace App\Filament\Resources\ProductDiaResource\Pages;

use App\Filament\Resources\ProductDiaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductDia extends CreateRecord
{
    protected static string $resource = ProductDiaResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $productId = $data['product_id'];
        $modalidadId = $data['modalidad_id'];
        $diaIds = $data['dia_ids'] ?? [];
        $created = [];
        foreach ($diaIds as $diaId) {
            $created[] = \App\Models\ProductDia::firstOrCreate([
                'product_id' => $productId,
                'modalidad_id' => $modalidadId,
                'dia_id' => $diaId,
            ]);
        }
        // Devuelve el primer registro creado para la redirección de Filament
        return $created[0] ?? null;
    }
}
