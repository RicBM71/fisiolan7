<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{
    protected $fillable = [
        'paciente_id','descripcion', 'path', 'username'
    ];


    public function paciente()
    {
    	return $this->belongsTo(Paciente::class);
    }

}
