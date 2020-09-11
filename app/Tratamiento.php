<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $fillable = [

        'nombre', 'nombre_web', 'nombre_reducido', 'importe', 'importe_reducido', 'precio_coste', 'duracion_manual',
        'duracion_aparatos', 'edad', 'tpv', 'inventario', 'activo', 'username','bono'

    ];

    public static function selTratamientos(){

        return Tratamiento::select('id AS value', 'nombre AS text')
            ->orderBy('nombre', 'asc');


    }

    public function scopeBono($query){

        $query->where('bono', true);

        return $query;

    }


}
