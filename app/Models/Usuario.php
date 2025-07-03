<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'numero_identificacion',
        'email',
        'password',
        'rol',
        'estado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Forzar fallo de autenticación si el usuario está inactivo
     */
    public function getAuthPassword()
    {
        if ($this->estado !== 'activo') {
            return bcrypt('usuario_inactivo');
        }

        return $this->password;
    }
}
