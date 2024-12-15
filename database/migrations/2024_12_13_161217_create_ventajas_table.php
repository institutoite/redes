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
        Schema::create('ventajas', function (Blueprint $table) {
            $table->id();
            $table->string('ventaja', 25)->nullable();
            $table->string('detalle', 100)->nullable();
            $table->boolean("estado", true)->nullable();
            
            $table->unsignedBigInteger("modalidad_id");
            $table->foreign("modalidad_id")->references("id")->on("modalidads");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventajas');
    }
};
