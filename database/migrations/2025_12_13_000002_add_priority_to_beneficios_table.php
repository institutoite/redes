<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('beneficios', function (Blueprint $table) {
            $table->unsignedInteger('priority')->default(0)->after('titulo');
        });
    }

    public function down(): void
    {
        Schema::table('beneficios', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }
};
