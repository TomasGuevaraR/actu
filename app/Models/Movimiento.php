<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';

    protected $fillable = [
        'fecha',
        'consecutivo',      // opcional
        'detalle',
        'concepto',
        'casilla',
        'valor',
        'tipo',             // ingreso | egreso
        'saldo',
        'presupuesto_id',
        'miembro_id',
        'libro_contable_id', // <-- IMPORTANTE: permitir asignarlo
        'grupo_id'
    ];

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class, 'presupuesto_id');
    }

    public function diezmos()
    {
        return $this->hasMany(Diezmo::class, 'movimiento_id');
    }

    public function miembro()
    {
        return $this->belongsTo(Miembro::class, 'miembro_id');
    }

    public function libro()
    {
        return $this->belongsTo(LibroContable::class, 'libro_contable_id');
    }
    public function egresos()
    {
        return $this->hasMany(Egreso::class);
    }

}
