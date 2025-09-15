<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_casilla',
        'categoria',
        'valor_mensual',
        'año',
        'responsable',
    ];

    // Relación con egresos
    public function egresos()
    {
        return $this->hasMany(Egreso::class, 'presupuesto_id');
    }
}
