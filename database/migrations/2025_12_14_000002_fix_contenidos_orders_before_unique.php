<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Normalize 'orden' per product to be unique and sequential
        $products = DB::table('contenidos')
            ->select('product_id')
            ->distinct()
            ->pluck('product_id');

        foreach ($products as $productId) {
            $items = DB::table('contenidos')
                ->where('product_id', $productId)
                ->orderBy('orden')
                ->orderBy('id')
                ->get(['id']);

            $orden = 1;
            foreach ($items as $item) {
                DB::table('contenidos')
                    ->where('id', $item->id)
                    ->update(['orden' => $orden]);
                $orden++;
            }
        }
    }

    public function down(): void
    {
        // No-op: cannot reliably restore previous duplicate orders
    }
};
