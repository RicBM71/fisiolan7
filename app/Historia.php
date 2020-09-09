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
        'fisio_id',
        'username'

    ];

}
