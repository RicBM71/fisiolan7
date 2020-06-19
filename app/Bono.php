<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bono extends Model
{
    protected $fillable = [

        'nombre','importe','tratamiento_id','sesiones','caducidad','username',

    ];

    public function tratamiento()
    {
    	return ($this->belongsTo(Tratamiento::class));
    }

}
