<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = [
        'anio', 'mes', 'saldo_inicial', 'entradas', 'salidas', 'saldo_final'
    ];
}
