<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->decimal('monto', 12, 2);
            $table->foreignId('forma_pago_id')->constrained('formas_pago', 'id')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};
