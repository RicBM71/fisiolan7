<?php

use App\Cita;
use App\Cobro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cita::truncate();
        Cobro::truncate();

        $reg = DB::connection('db2')->select('select * from citas ORDER by id');

        $i = 0;
        foreach($reg as $row){


            // if ($row->fecha == '0200-12-20')
            //     $row->fecha = "2000-12-20";

            $data[]=array(

                'id' => $row->id,
                'empresa_id' => 1,
                'area_id' => $row->centro,
                'paciente_id' => $row->paciente,
                'fecha' => $row->fecha,
                'hora' => $row->hora,
                'facultativo_id' => $row->fisio,
                'estado_id' => $row->estado,
                'tratamiento_id' => $row->tratamiento < 0 ? 1 : $row->tratamiento,
                'importe' => $row->importe,
                'importe_ponderado' => $row->impreal,
                'iva' => $row->iva,
                'bono' => $row->bono==0 ? null : $row->bono,
                'apunte'=> $row->apunte==0 ? null: $row->apunte,
                'fecha_cobro'=> $row->pagado== '0000-00-00' ? null : $row->pagado,
                'factura'=> $row->factura == 0 ? null : $row->factura,
                'ejercicio'=> $row->ejercicio == 0 ? null : $row->ejercicio,
                'sesiones'=> $row->sesiones,
                'mutua_id'=> $row->sociedad <=0 ? null : $row->sociedad,
                'autorizacion'=> $row->autorizacion,
                'tipo_envio'=> $row->tipoenv,
                'envio_sms'=> $row->sms == '0000-00-00 00:00:00' ? null : $row->sms,
                'notas'=> $row->texto,
                'created_at'    => $row->sysfum.' 00:00:00',
                'updated_at'    => $row->sysfum.' '.$row->syshum,
                'username'      => $row->sysusr
            );

            $i++;

            if ($i % 1000 == 0){
                DB::table('citas')->insert($data);
                $data = array();
            }

        }

        DB::table('citas')->insert($data);


        $reg = DB::connection('db2')->select('select * from cobrosmov ORDER by id');

        $i = 0;
        $data = array();
        foreach($reg as $row){

            $data[]=array(

                'id' => $row->id,
                'empresa_id' => 1,
                'area_id' => $row->centro,
                'cita_id' => $row->sesion,
                'paciente_id' => $row->paciente,
                'fpago_id' => $row->fpago,
                'fecha' => $row->fecha,
                'tpv_id' => $row->tpv,
                'autorizacion'=> $row->autorizacion,
                'created_at'    => $row->sysfum.' 00:00:00',
                'updated_at'    => $row->sysfum.' '.$row->syshum,
                'username'      => $row->sysusr
            );

            $i++;

            if ($i % 1000 == 0){
                DB::table('cobros')->insert($data);
                $data = array();
            }

        }

        DB::table('cobros')->insert($data);
    }
}
