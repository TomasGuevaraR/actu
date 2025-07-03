<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    protected $fillable = [
    'nombres',
    'apellidos',
    'numero_identificacion',
    'email',
    'telefono',
    'fecha_nacimiento',
    'edad',
    'direccion',
    'barrio',
    'estado',
];

}
