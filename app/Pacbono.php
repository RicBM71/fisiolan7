<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pacbono extends Model
{
    protected $fillable = [

        'paciente_id',
        'bono',
        'fecha',
        'sesiones',
        'tratamiento_id',
        'importe',
        'caducidad',
        'caducado',
        'texto',
        'username',

    ];

    public static function selBonos(){

        return Bono::select('id AS value', 'nombre AS text')
            ->orderBy('nombre', 'asc')
            ->get();


    }


    public function paciente()
    {
    	return $this->belongsTo(Paciente::class);
    }

    public function tratamiento()
    {
    	return $this->belongsTo(tratamiento::class);
    }
}
