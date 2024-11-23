<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubastaMetodoEnvio extends Model
{
    use SoftDeletes;

    protected $table = 'subastas_metodos_envio';

    protected $fillable = [
        'subasta_id',
        'metodo_envio_id',
    ];

    public function subasta()
    {
        return $this->belongsTo(Subasta::class, 'subasta_id', 'id');
    }

    public function metodoEnvio()
    {
        return $this->belongsTo(MetodoEnvio::class, 'metodo_envio_id', 'id');
    }
}
