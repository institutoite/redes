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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_estudiante');
            $table->date('fecha_nacimiento');
            $table->text('requerimiento');
            $table->enum('como_nos_conocio', ['facebook', 'instagram', 'web', 'recomendacion', 'otro']);
            $table->string('nombre_apoderado');
            $table->string('telefono_apoderado');
            $table->string('comprobante')->nullable();
            $table->boolean('reservado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
