<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('modalidads', function (Blueprint $table) {
            $table->unique(['product_id', 'orden'], 'modalidads_product_orden_unique');
        });
    }

    public function down(): void
    {
        Schema::table('modalidads', function (Blueprint $table) {
            $table->dropUnique('modalidads_product_orden_unique');
        });
    }
};
