<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ganador extends Model
{
    use SoftDeletes;

    protected $table = 'ganadores';

    protected $fillable = [
        'user_id',
        'producto_id',
        'monto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }

    public static function definirGanador(Producto $producto)
    {
        $ganador = $producto->usuariosOferentes->sortByDesc('pivot.monto')->first();
        
        if (!$ganador) {
            return null;
        }

        $monto = Oferta::where('producto_id', $producto->id)->max('monto');

        $ganador = Ganador::create([
            'user_id' => $ganador->id,
            'producto_id' => $producto->id,
            'monto' => $monto,
        ]);

        return $ganador;
    }

}
