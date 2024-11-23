<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->enum('sexo', ['M', 'F', 'X'])->nullable();
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->date('fecha_nacimiento');
            $table->string('tipo_documento', 25);
            $table->string('numero_documento', 25);
            $table->foreignId('user_id')->constrained('users', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
