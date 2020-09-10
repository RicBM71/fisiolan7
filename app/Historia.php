<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $fillable = [

        'paciente_id',
        'fecha',
        'motivo',
        'exploracion',
        'juicio',
        'tratamiento',
        'diagnosticado',
        'interno',
        'cie',
        'empleado_id',
        'username'

    ];

    // public function paciente(){
    //     return $this->hasOne(Paciente::class);
    // }

    public function paciente()
    {
    	return $this->belongsTo(Paciente::class);
    }

}
