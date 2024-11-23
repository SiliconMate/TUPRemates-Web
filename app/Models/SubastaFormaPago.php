<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubastaFormaPago extends Model
{
    use SoftDeletes;

    protected $table = 'subastas_formas_pago';

    protected $fillable = [
        'subasta_id',
        'forma_pago_id',
    ];

    public function subasta()
    {
        return $this->belongsTo(Subasta::class, 'subasta_id', 'id');
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class, 'forma_pago_id', 'id');
    }
}
