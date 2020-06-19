<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $fillable = [

        'nombre', 'nombre_web', 'nombre_reducido', 'importe', 'importe_reducido', 'precio_coste', 'duracion_manual',
        'duracion_aparatos', 'edad', 'tpv', 'inventario', 'activo', 'username'

    ];

    public static function selTratamientos(){

        return Almacen::select('id AS value', 'nombre AS text')
            ->orderBy('nombre', 'asc')
            ->get();

    }

}
