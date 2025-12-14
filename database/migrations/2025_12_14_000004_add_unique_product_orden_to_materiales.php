<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('materiales', function (Blueprint $table) {
            $table->unique(['product_id', 'orden'], 'materiales_product_orden_unique');
        });
    }

    public function down(): void
    {
        Schema::table('materiales', function (Blueprint $table) {
            $table->dropUnique('materiales_product_orden_unique');
        });
    }
};
