<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acciones extends Model
{
    protected $table = 'acciones';

    public $fillable = [
        'nombre',
        'url',
        'modulo'
    ];

    public function permisos(){
        return $this->hasMany('App\Models\Permisos');
    }
}
