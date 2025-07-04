<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    // Permitir asignación masiva en estos campos
    protected $fillable = [
        'nombre_casilla',
        'tipo',
        'valor_mensual',
        'año',
    ];

    // Relación: un presupuesto tiene muchos movimientos
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
