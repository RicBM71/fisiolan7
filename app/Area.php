<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    protected $fillable = [

        'nombre','hora1','hora2','tarde','activo','frecuencia','username',

    ];

}
