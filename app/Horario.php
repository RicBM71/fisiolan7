<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [

        'fecha',
        'inim_1','finm_1',
        'init_1','fint_1','inim_2','finm_2','init_2','fint_2','inim_3','finm_3','init_3','fint_3','inim_4','finm_4','init_4','fint_4',
        'inim_5','finm_5','init_5','fint_5','inim_6','finm_6','init_6','fint_6','inim_0','finm_0','init_0','fint_0','username',

    ];

    protected $dates =['fecha'];
}
