<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class Usuarios extends Authenticatable
{
    use HasFactory, Notifiable;
    public $fillable = [
        'nombre',
        'telefono',
        'id_rol',
        'email',
        'password'
    ];

    // Relación uno a uno entre Usuario y Roles
    public function rol() {
        return $this->belongsTo('App\Models\Roles', 'id_rol');
    }

    // Definir el helper(función global) para comprobar si el usuario tiene permisos
    public function tienePermiso($nombreAccion) {
        return $this->rol && $this->rol->permisos->contains(function ($permiso) use($nombreAccion){
            return $permiso->accion->nombre === $nombreAccion;
        });
    }
}
