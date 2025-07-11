<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = [
    'fecha',
    'consecutivo',
    'detalle',
    'concepto',
    'casilla',
    'valor',
    'tipo',
    'saldo',
];

    // Relación inversa con presupuesto
    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class);
    }
}
