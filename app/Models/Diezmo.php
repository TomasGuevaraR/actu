<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diezmo extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'diezmos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'valor',
        'fecha',
        'movimiento_id',
    ];

    // Casts (opcional, útil para fechas)
    protected $casts = [
        'fecha' => 'date',
    ];
}
