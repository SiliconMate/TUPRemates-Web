<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'titulo',
        'descripcion',
        'precio_base',
        'aprobado',
        'subasta_id',
        'solicitado_por',
        'aprobado_por',
    ];

    public function subasta()
    {
        return $this->belongsTo(Subasta::class, 'subasta_id', 'id');
    }

    public function solicitado_por()
    {
        return $this->belongsTo(User::class, 'solicitado_por', 'id');
    }

    public function aprobado_por()
    {
        return $this->belongsTo(Admin::class, 'aprobado_por', 'id');
    }

    public function ganador()
    {
        return $this->hasOne(Ganador::class, 'producto_id', 'id');
    }

    public function imagenes()
    {
        return $this->hasMany(ProductoImagen::class, 'producto_id', 'id');
    }

    public function usuariosOferentes()
    {
        return $this->belongsToMany(User::class, 'ofertas')
            ->withPivot('forma_pago_id', 'monto')
            ->withTimestamps();
    }
    
}
