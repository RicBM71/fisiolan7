<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{

    protected $dates =['fecha_nacimiento','fecha_baja'];

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'nombre','apellidos','cif','poblacion','direccion','cpostal','provincia','telefono1','telefono2','telefonom',
        'email', 'fecha_nacimiento','colegiado','fecha_baja','iban','color','alias','numero_ss','grupo_id','categoria_id','orden',
        'username',

    ];

    protected $appends = ['nom_ape'];

    public function getNomApeAttribute(){

        return $this->nombre." ".$this->apellidos;

    }

    public function categoria()
    {
    	return ($this->belongsTo(Categoria::class));
    }

    public function scopeActivos($query, $activo)
    {

        return ($activo) ? $query->whereNull('fecha_baja') :  $query;

    }

}
