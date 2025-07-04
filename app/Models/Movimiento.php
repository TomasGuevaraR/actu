<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = [
        'presupuesto_id',
        'fecha',
        'tipo',
        'valor',
        'descripcion',
    ];

    // Relación inversa con presupuesto
    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class);
    }
}
