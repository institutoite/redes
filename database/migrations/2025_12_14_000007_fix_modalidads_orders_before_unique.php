<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Normalizar 'orden' por producto para que sean únicos y secuenciales
        $products = DB::table('modalidads')
            ->select('product_id')
            ->distinct()
            ->pluck('product_id');

        foreach ($products as $productId) {
            $items = DB::table('modalidads')
                ->where('product_id', $productId)
                ->orderBy('id') // solo por id para garantizar secuencia única
                ->get(['id']);

            $orden = 1;
            foreach ($items as $item) {
                DB::table('modalidads')
                    ->where('id', $item->id)
                    ->update(['orden' => $orden]);
                $orden++;
            }
        }
    }

    public function down(): void
    {
        // No reversible
    }
};
