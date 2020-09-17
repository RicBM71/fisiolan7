<?php

namespace App;

use App\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'id',
        'empresa_id',
        'area_id',
        'paciente_id',
        'fecha',
        'hora',
        'facultativo_id',
        'estado_id',
        'tratamiento_id',
        'importe',
        'importe_ponderado',
        'iva',
        'bono',
        'apunte',
        'fecha_cobro',
        'factura',
        'ejercicio',
        'sessiones',
        'mutua_id',
        'autorizacion',
        'tipo_envio',
        'envio_sms',
        'notas',
        'username',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new EmpresaScope);

    }

    public function paciente()
    {
    	return $this->belongsTo(Paciente::class);
    }

    public function tratamiento()
    {
    	return $this->belongsTo(Tratamiento::class);
    }

    public function facultativo()
    {
    	return $this->belongsTo(Facultativo::class);
    }

    public function mutua()
    {
    	return $this->belongsTo(Tratamiento::class);
    }

    public function estado()
    {
    	return $this->belongsTo(Estado::class);
    }

    public function cobros()
    {
        return $this->hasMany(Cobro::class);
    }


}
