<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'valor',
        'detalle',
        'concepto',
        'presupuesto_id',
        'movimiento_id'
    ];

    // Relación con movimiento
    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }

    // Relación con presupuesto/casilla
    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class);
    }
}
