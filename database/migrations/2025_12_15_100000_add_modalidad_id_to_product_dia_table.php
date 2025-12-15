<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_dia', function (Blueprint $table) {
            // Eliminar claves foráneas existentes
            $table->dropForeign(['product_id']);
            $table->dropForeign(['dia_id']);
            // Eliminar índice único existente
            $table->dropUnique('product_dia_product_id_dia_id_unique');
        });
        Schema::table('product_dia', function (Blueprint $table) {
            // Agregar columna modalidad_id
            $table->unsignedBigInteger('modalidad_id')->after('product_id');
            // Volver a crear claves foráneas
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('modalidad_id')->references('id')->on('modalidads')->onDelete('cascade');
            $table->foreign('dia_id')->references('id')->on('dias')->onDelete('cascade');
            // Nuevo índice único
            $table->unique(['product_id', 'modalidad_id', 'dia_id']);
        });
    }

    public function down(): void
    {
        Schema::table('product_dia', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['modalidad_id']);
            $table->dropForeign(['dia_id']);
            $table->dropUnique('product_dia_product_id_modalidad_id_dia_id_unique');
            $table->dropColumn('modalidad_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('dia_id')->references('id')->on('dias')->onDelete('cascade');
            $table->unique(['product_id', 'dia_id']);
        });
    }
};
