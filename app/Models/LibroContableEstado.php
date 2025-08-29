<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroContableEstado extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    /**
     * Relación inversa con libros contables
     */
    public function libros()
    {
        return $this->hasMany(LibroContable::class, 'estado_id', 'id');
    }
}