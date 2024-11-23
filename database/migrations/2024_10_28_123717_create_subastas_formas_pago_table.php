<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subastas_formas_pago', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subasta_id')->constrained('subastas', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('forma_pago_id')->constrained('formas_pago', 'id')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subastas_formas_pago');
    }
};
