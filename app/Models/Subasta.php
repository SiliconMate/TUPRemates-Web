<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subasta extends Model
{
    use SoftDeletes;

    protected $table = 'subastas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria_id',
        'fecha_apertura',
        'fecha_cierre',
        'estado',
        'creado_por',
    ];

    public function getRouteKeyName()
    {
        return 'nombre';
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

    public function creado_por()
    {
        return $this->belongsTo(Admin::class, 'creado_por', 'id');
    }

    public function formasPago()
    {
        return $this->belongsToMany(FormaPago::class, 'subastas_formas_pago','subasta_id', 'forma_pago_id')
            ->withTimestamps();
    }

    public function metodosEnvio()
    {
        return $this->belongsToMany(MetodoEnvio::class, 'subastas_metodos_envio','subasta_id', 'metodo_envio_id')
            ->withTimestamps();
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'subasta_id', 'id');
    }
}
