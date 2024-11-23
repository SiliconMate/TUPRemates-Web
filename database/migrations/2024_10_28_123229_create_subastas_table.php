<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subastas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('descripcion', 150);
            $table->foreignId('categoria_id')->constrained('categorias', 'id')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->dateTime('fecha_apertura');
            $table->dateTime('fecha_cierre');
            $table->enum('estado', ['creada', 'activa', 'cerrada', 'cancelada'])
                ->default('creada');
            $table->foreignId('creado_por')->constrained('admins', 'id')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subastas');
    }
};
