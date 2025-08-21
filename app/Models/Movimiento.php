<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = [
        'fecha',
        'consecutivo',      // opcional
        'detalle',
        'concepto',
        'casilla',
        'valor',
        'tipo',
        'saldo',
        'presupuesto_id',
        'miembro_id',       // agregamos la FK de miembro
    ];

    /**
     * Relación inversa con Presupuesto
     */
    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class, 'presupuesto_id');
    }

    /**
     * Relación con Diezmos (un movimiento puede tener varios diezmos)
     */
    public function diezmos()
    {
        return $this->hasMany(Diezmo::class, 'movimiento_id');
    }

    /**
     * Relación inversa con Miembro
     */
    public function miembro()
    {
        return $this->belongsTo(Miembro::class, 'miembro_id');
    }
}
