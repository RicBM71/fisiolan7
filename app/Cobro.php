<?php

namespace App;

use App\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    protected $fillable = [
        'empresa_id','fecha','area_id','cita_id','paciente_id','fpago_id','fecha','tpv_id','username',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new EmpresaScope);

    }

    public function cita()
    {
    	return $this->belongsTo(Cita::class);
    }

}
