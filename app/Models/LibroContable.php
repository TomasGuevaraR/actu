<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroContable extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'mes_libro',
        'anio_libro',
        'estado',
        'saldo_inicial',
        'saldo_final',
    ];

    // Relación con los movimientos
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'libro_contable_id');
    }

    // Accesor para obtener el nombre del mes
    public function getMesNombreAttribute()
    {
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        return $meses[$this->mes_libro] ?? 'Desconocido';
    }
    
}
