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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->string("horario");
            $table->boolean("estado")->default(1);

            $table->unsignedBigInteger("clicks")->default(0);
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
        Schema::dropIfExists('horarios');
    }
};
