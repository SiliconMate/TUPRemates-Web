<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->string('calle', 50);
            $table->string('numero', 10);
            $table->string('piso', 10)->nullable();
            $table->string('departamento', 10)->nullable();
            $table->string('localidad', 50);
            $table->string('provincia', 50);
            $table->string('codigo_postal', 10);
            $table->foreignId('user_id')->constrained('users', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('telefono', 20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
