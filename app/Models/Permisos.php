<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    public $fillable = [
        'usuario_id',
        'accion_id'
    ];

    // Relación con el usuario
    public function usuario(){
        return $this->belongsTo('App\Models\Usuarios', 'usuario_id');
    }

    // Relación con la tabla acciones
    public function accion(){
        return $this->belongsTo('App\Models\Acciones', 'accion_id');
    }
}
