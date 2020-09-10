<?php

use App\Medio;
use App\Paciente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paciente::truncate();
        Medio::truncate();

        $reg = DB::connection('db2')->select('select * from pacientes ORDER by id');

        $i = 0;
        foreach($reg as $row){


            $data[]=array(
                'id'     => $row->id,
                'nombre' => $row->nombre,
                'apellidos' => $row->apellidos,
                'direccion' => $row->direccion,
                'cpostal' => $row->cpostal,
                'poblacion' => $row->poblacion,
                'provincia' => $row->provincia,
                'telefono1' => $row->telefono1,
                'telefono2' => $row->telefono2,
                'telefonom' => $row->tfmovil,
                'sms' => $row->sms == 'S' ? true : false,
                'texto_tf2' => $row->textotf2,
                'email' => $row->email,
                'cif' => $row->dni,
                'sexo'  => $row->sexo,
                'fecha_nacimiento' => $row->fnacimiento == '0000-00-00' ? null : $row->fnacimiento,
                'descuento' => $row->descuento,
                'porcentual' => $row->porcentual == 'S' ? true : false,
                'profesion' => $row->profesion,
                'tarifa_reducidad' => $row->tarifared == 'S' ? true : false,
                'mutua_id' => $row->sociedad > 0 ? $row->sociedad : null,
                'fecha_baja' => $row->fechabaja == '0000-00-00' ? null : $row->fechabaja,
                'exportar' => $row->exportar == 'S' ? true : false,
                'riesgo' => $row->riesgo,
                'notas1' => $row->notas1,
                'notas2' => $row->notas2,
                'medio_id' => $row->medio > 0 ? $row->medio : null,
                'recomendado_id' => $row->bab,
                'ant1' => $row->ant1,
                'ant2' => $row->ant2,
                'ant3' => $row->ant3,
                'ant4' => $row->ant4,
                'ant5' => $row->ant5,
                'ant6' => $row->ant6,
                'antobs' => $row->antobs,
                'embarazada' => $row->embarazada == 'S' ? true : false,
                'peso' => $row->peso,
                'altura' => $row->altura,
                'lortad_evo' => $row->lortadevo == 'S' ? true : false,
                'lortad_fide' => $row->lortadfide == 'S' ? true : false,
                'obs_adm' => $row->obsadm,
                'espera' => $row->espera == 'S' ? true : false,
                'factura_auto' => $row->fauto == 'S' ? true : false,
                'created_at'    => $row->fechaalta.' 00:00:00',
                'updated_at'    => $row->sysfum.' '.$row->syshum,
                'username'      => $row->sysusr
            );

            $i++;

            if ($i % 1000 == 0){
                DB::table('pacientes')->insert($data);
                $data = array();
            }

        }

        DB::table('pacientes')->insert($data);

        $reg = DB::connection('db2')->select('select * from medios ORDER by id');

        $data = array();
        foreach($reg as $row){

            $data[]=array(

                'id'        => $row->id,
                'nombre'    => $row->nombre,
                'created_at'    => date('Y-m-d'),
                'updated_at'    => date('Y-m-d'),
                'username'      => $row->sysusr
            );

        }

        DB::table('medios')->insert($data);

    }
}
