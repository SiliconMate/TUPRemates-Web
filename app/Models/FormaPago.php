<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormaPago extends Model
{
    use SoftDeletes;

    protected $table = 'formas_pago';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function subastas()
    {
        return $this->belongsToMany(Subasta::class, 'subastas_formas_pago', 'forma_pago_id', 'subasta_id')
            ->withTimestamps();
    }

    public function ofertas()
    {
        return $this->hasMany(Oferta::class);
    }
}
