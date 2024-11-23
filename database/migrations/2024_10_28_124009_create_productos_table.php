<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 50);
            $table->string('descripcion', 255);
            $table->decimal('precio_base', 10, 2);
            $table->boolean('aprobado')->default(false);
            $table->foreignId('subasta_id')->constrained('subastas', 'id')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->foreignId('solicitado_por')->constrained('users', 'id')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->foreignId('aprobado_por')->constrained('admins', 'id')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
