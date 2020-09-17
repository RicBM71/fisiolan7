<?php

use App\Adjunto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdjuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adjunto::truncate();

        $reg = DB::connection('db2')->select('select * from informes ORDER by id');

        $i = 0;
        foreach($reg as $row){


            // if ($row->fecha == '0200-12-20')
            //     $row->fecha = "2000-12-20";

            $data[]=array(

                'paciente_id'   => $row->paciente,
                'descripcion'   => $row->nombre,
                'path'          => '/storage/docs/d2000/'.$row->fichero,
                'created_at'    => $row->fecha.' 00:00:00',
                'updated_at'    => $row->sysfum.' '.$row->syshum,
                'username'      => $row->sysusr
            );

            $i++;

            if ($i % 1000 == 0){
                DB::table('historias')->insert($data);
                $data = array();
            }

        }

        DB::table('adjuntos')->insert($data);
    }
}
