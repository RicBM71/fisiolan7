<?php

use App\Empleado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empleado::truncate();
        $reg = DB::connection('db2')->select('select * from fisios');

        $data=array();

        foreach($reg as $row){


            $data[]=array(
                'id'        => $row->id,
                'nombre'    => $row->nombre,
                'apellidos' => $row->apellidos,
                'cif'       => $row->dni,
                'poblacion' => $row->poblacion,
                'direccion' => $row->direccion,
                'cpostal'   => $row->cpostal,
                'provincia' => $row->provincia,
                'telefono1' => $row->telefono1,
                'telefono2' => $row->telefono2,
                'telefonom' => $row->tfmovil,
                'email'     => $row->email,
                'fecha_nacimiento'=> $row->fnacimiento == '0000-00-00' ? null : $row->fnacimiento,
                'colegiado' => $row->colegiado,
                'fecha_baja'=> $row->fechabaja == '0000-00-00' ? null : $row->fechabaja,
                'iban'      => "XX00".$row->entidad.$row->oficina.$row->dc.$row->cuenta,
                'color'     => $row->color,
                'alias'     => $row->alias,
                'numero_ss' => $row->numsegso,
                'grupo_id'  => $row->grupo,
                'categoria_id' => 1,
                'orden'      => $row->orden,
                'created_at' => ($row->fechaalta != "0000-00-00" && $row->fechaalta != null) ? $row->fechaalta.' 00:00:00' : $row->sysfum.' '.$row->syshum,
                'updated_at' => $row->sysfum.' '.$row->syshum,
                'username'   => $row->sysusr
            );

        }

        DB::table('empleados')->insert($data);

    }
}
