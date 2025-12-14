<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Solo crear el índice único si la columna ya existe
            if (Schema::hasColumn('products', 'orden')) {
                $table->unique(['orden'], 'products_orden_unique');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'orden')) {
                $table->dropUnique('products_orden_unique');
            }
        });
    }
};
