<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetodoEnvio extends Model
{
    use SoftDeletes;

    protected $table = 'metodos_envio';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function subastas()
    {
        return $this->belongsToMany(Subasta::class, 'subastas_metodos_envio', 'metodo_envio_id', 'subasta_id')
            ->withTimestamps();
    }
}
