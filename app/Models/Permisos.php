<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    public $fillable = [
        'rol_id',
        'accion_id'
    ];

    // Relación con el rol
    public function rol(){
        return $this->belongsTo('App\Models\Roles', 'rol_id');
    }

    // Relación con la tabla acciones
    public function accion(){
        return $this->belongsTo('App\Models\Acciones', 'accion_id');
    }
}
