<?php
namespace App\Filament\Resources\ProductDiaResource\Pages;

use App\Filament\Resources\ProductDiaResource;
use Filament\Resources\Pages\EditRecord;

class EditProductDia extends EditRecord
{
    protected static string $resource = ProductDiaResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Obtener todos los dia_id asociados a este producto y modalidad
        $productId = $data['product_id'] ?? null;
        $modalidadId = $data['modalidad_id'] ?? null;
        if ($productId && $modalidadId) {
            $data['dia_ids'] = \App\Models\ProductDia::where('product_id', $productId)
                ->where('modalidad_id', $modalidadId)
                ->pluck('dia_id')
                ->toArray();
        } else {
            $data['dia_ids'] = [];
        }
        return $data;
    }

    protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    {
        $productId = $data['product_id'];
        $modalidadId = $data['modalidad_id'];
        $diaIds = $data['dia_ids'] ?? [];

        // Eliminar todas las combinaciones actuales para ese producto y modalidad
        \App\Models\ProductDia::where('product_id', $productId)
            ->where('modalidad_id', $modalidadId)
            ->delete();

        // Crear las nuevas combinaciones seleccionadas
        foreach ($diaIds as $diaId) {
            \App\Models\ProductDia::firstOrCreate([
                'product_id' => $productId,
                'modalidad_id' => $modalidadId,
                'dia_id' => $diaId,
            ]);
        }

        // Devuelve el primer registro creado para la redirección de Filament
        return \App\Models\ProductDia::where('product_id', $productId)
            ->where('modalidad_id', $modalidadId)
            ->whereIn('dia_id', $diaIds)
            ->first();
    }
}
