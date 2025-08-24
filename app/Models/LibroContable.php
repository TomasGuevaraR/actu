<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroContable extends Model
{
    use HasFactory;

    protected $table = 'libro_contables';

    protected $fillable = [
        'nombre',        // Ejemplo: "Enero 2025"
        'monto',
        'estado_id',     // Relación con tabla libro_contable_estados
        'mes_libro',     // 1 = Enero, 2 = Febrero, etc.
        'anio_libro',    // Año del libro
    ];

    // Relación con estado (abierto, cerrado, aprobado)
    public function estado()
    {
        return $this->belongsTo(LibroContableEstado::class, 'estado_id');
    }

    // Método para verificar si el libro está abierto
    public function estaAbierto()
    {
        return $this->estado && $this->estado->nombre === 'Abierto';
    }

    // Método para cerrar el libro
    public function cerrar()
    {
        $this->estado_id = LibroContableEstado::where('nombre', 'Cerrado')->first()->id;
        $this->save();
    }

    // Método para abrir el libro
    public function abrir()
    {
        $this->estado_id = LibroContableEstado::where('nombre', 'Abierto')->first()->id;
        $this->save();
    }

    // Método estático para obtener el libro abierto actual
    public static function libroAbierto()
    {
        return self::whereHas('estado', function ($q) {
            $q->where('nombre', 'Abierto');
        })->first();
    }
}
