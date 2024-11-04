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
            $table->decimal('precio_base', 8, 2);
            $table->boolean('aprobado')->default(false);
            $table->boolean('activo')->default(false);
            $table->foreignId('subasta_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->foreignId('user_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->foreignId('admin_id')->constrained()
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
