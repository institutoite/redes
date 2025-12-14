<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Normalizar el campo 'orden' en products para que sea único y secuencial
        $productos = DB::table('products')->orderBy('id')->get();
        $orden = 1;
        foreach ($productos as $producto) {
            DB::table('products')->where('id', $producto->id)->update(['orden' => $orden]);
            $orden++;
        }
    }

    public function down(): void
    {
        // Opcional: puedes dejar todos en 0 si haces rollback
        DB::table('products')->update(['orden' => 0]);
    }
};
