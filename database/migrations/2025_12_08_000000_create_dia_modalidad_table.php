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
        Schema::create('dia_modalidad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dias_id');
            $table->unsignedBigInteger('modalidad_id');
            $table->foreign('dias_id')->references('id')->on('dias')->onDelete('cascade');
            $table->foreign('modalidad_id')->references('id')->on('modalidads')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['dias_id', 'modalidad_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dia_modalidad');
    }
};
