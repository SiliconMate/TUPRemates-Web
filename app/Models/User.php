<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function persona(): HasOne
    {
        return $this->hasOne(Persona::class);
    }

    public function empresa(): HasOne
    {
        return $this->hasOne(Empresa::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::saving(function ($usuario) {
    //         if ($usuario->persona && $usuario->empresa) {
    //             throw new \Exception('Un usuario no puede ser parte de Persona y Empresa al mismo tiempo.');
    //         }

    //         if (!$usuario->persona && !$usuario->empresa) {
    //             throw new \Exception('Un usuario debe pertenecer a Persona o Empresa.');
    //         }
    //     });
    // }

    public function direcciones(): HasMany
    {
        return $this->hasMany(Direccion::class, 'user_id', 'id');
    }

    public function subastas(): HasMany
    {
        return $this->hasMany(Subasta::class, 'solcitado_por', 'id');
    }

    public function productos_ganados(): HasMany
    {
        return $this->hasMany(Ganador::class, 'user_id', 'id');
    }

    public function productosOfertados()
    {
        return $this->belongsToMany(Producto::class, 'ofertas')
            ->withPivot('forma_pago_id', 'monto')
            ->withTimestamps();
    }
}
