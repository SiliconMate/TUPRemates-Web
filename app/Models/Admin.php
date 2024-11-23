<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use SoftDeletes;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function subastas()
    {
        return $this->hasMany(Subasta::class, 'creado_por', 'id');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'aprobado_por', 'id');
    }
}
