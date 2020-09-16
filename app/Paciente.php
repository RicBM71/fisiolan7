<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Paciente extends Model
{

    protected $fillable = [

                'nombre',
                'apellidos',
                'direccion',
                'cpostal',
                'poblacion',
                'provincia',
                'telefono1',
                'telefono2',
                'telefonom',
                'sms',
                'texto_tf2',
                'email',
                'cif',
                'sexo',
                'fecha_nacimiento',
                'descuento',
                'porcentual',
                'profesion',
                'tarifa_reducida',
                'mutua_id',
                'fecha_baja',
                'exportar',
                'riesgo',
                'notas1',
                'notas2',
                'medio_id',
                'recomendado_id',
                'ant1',
                'ant2',
                'ant3',
                'ant4',
                'ant5',
                'ant6',
                'antobs',
                'embarazada',
                'peso',
                'altura',
                'lortad_evo',
                'lortad_fide',
                'obs_adm',
                'espera',
                'factura_auto',
                'username'

        ];

        protected $appends = ['nom_ape','edad', 'foto'];

        public function getNomApeAttribute(){

            return $this->nombre." ".$this->apellidos;

        }

        public function getFotoAttribute(){

            $foto = '/fotos/'.$this->id.'.jpg';

            return Storage::disk('public')->exists($foto) ? '/storage'.$foto : false;

        }

        public function getEdadAttribute(){

            if ($this->fecha_nacimiento==null) return 0;

            list($anio,$mes,$dia) = explode("-",$this->fecha_nacimiento);

            $anio_dif = date("Y") - $anio;
            $mes_dif = date("m") - $mes;
            $dia_dif = date("d") - $dia;

            //if ($dia_dif < 0 && $mes_dif < 0)
                //$anio_dif--;

            if ($mes_dif < 0)
               $anio_dif--;
            else if ($dia_dif < 0 && $mes_dif == 0)
                  $anio_dif--;



            return $anio_dif;

        }

        public function historias()
        {
            return $this->hasMany(Historia::class);
        }

        public function pacbonos()
        {
            return $this->hasMany(Pacbono::class);
        }

        public function adjuntos()
        {
            return $this->hasMany(Adjunto::class);
        }


        public function scopeRazon($query, $razon){

            if (!Empty($razon)){
                if (strpos($razon,',')){
                    $cli = explode(",", $razon);
                    $query->where('nombre','like',$cli[0].'%')
                          ->where('apellidos','like',$cli[1].'%');
                }else{
                    $query->where('apellidos','like','%'.$razon.'%');
                }
            }

            return $query;

        }

        public function scopeNombre($query, $texto){


            if (Empty($texto)) return $query;

            if (strpos($texto,',') !== false){

                $data_exp = explode(",", $texto);

                if ($data_exp[0] != '' && $data_exp[1] != ''){
                    $query->where('nombre','like',$data_exp[0].'%')
                          ->where('apellidos','like',$data_exp[1].'%');
                }elseif ($data_exp[0] != ''){
                    $query->where('nombre','like',$data_exp[0].'%');
                }elseif ($data_exp[1] != ''){
                    $query->where('apellidos','like',$data_exp[1].'%');
                }

                return $query;

            }

            return $query->where('apellidos','like',$texto.'%');

        }

        public function scopeDireccion($query, $texto){

            if (Empty($texto)) return $query;

            return $query->where('direccion','like',$texto.'%');
        }

        public function scopeTelefono($query, $texto){

            if (Empty($texto)) return $query;

            return $query->where('telefono1','like',$texto.'%')
                  ->OrWhere('telefono2','like',$texto.'%')
                  ->OrWhere('telefonom','like',$texto.'%');

        }

        public function scopeEspera($query, $espera){

            return ($espera == true) ? $query->where('espera', $espera) : $query;

        }


        public static function selPacienteId($id)
        {

            return Paciente::select(DB::raw('id AS value, CONCAT(nombre," ",apellidos) AS text'))
                ->where('id', $id)
                ->orderBy('nombre', 'asc')
                ->get();

        }

}
