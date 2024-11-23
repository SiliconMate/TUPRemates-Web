<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direccion extends Model
{
    use SoftDeletes;

    protected $table = 'direcciones';

    protected $fillable = [
        'calle',
        'numero',
        'piso',
        'departamento',
        'localidad',
        'provincia',
        'pais',
        'codigo_postal',
        'user_id',
        'telefono',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
