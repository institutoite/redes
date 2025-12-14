<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('contenidos', function (Blueprint $table) {
            // Evitar nombre duplicado del índice si ya existe
            if (!Schema::hasColumn('contenidos', 'orden')) {
                $table->unsignedInteger('orden')->default(0);
            }
            $table->unique(['product_id', 'orden'], 'contenidos_product_orden_unique');
        });
    }

    public function down(): void
    {
        Schema::table('contenidos', function (Blueprint $table) {
            $table->dropUnique('contenidos_product_orden_unique');
        });
    }
};
