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
        Schema::create('subastas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('descripcion', 150);
            $table->foreignId('categoria_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->dateTime('fecha_apertura');
            $table->dateTime('fecha_cierre');
            $table->enum('estado', ['creada', 'activa', 'cerrada', 'cancelada'])
                ->default('creada');
            $table->foreignId('admin_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subastas');
    }
};
