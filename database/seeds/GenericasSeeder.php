<?php

use App\Iva;
use App\Fpago;
use App\Estado;
use App\Almacen;
use App\Empresa;
use App\Categoria;
use App\Parametro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class GenericasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Empresa::truncate();
        Almacen::truncate();
        FPago::truncate();
        Iva::truncate();
        Estado::truncate();

        DB::table('empresa_user')->truncate();

        $reg = DB::connection('db2')->select('select * from empresa');

        foreach($reg as $row){

            $data[]=array(
                'id'        => $row->id,
                'nombre'    => $row->nombre,
                'razon'     => $row->razon,
                'titulo'    => 'Sanaval',
                'cif'       => $row->cif,
                'poblacion' => $row->poblacion,
                'direccion' => $row->direccion,
                'cpostal'   => $row->cpostal,
                'provincia' => $row->provincia,
                'telefono1' => $row->telefono,
                'email'     => $row->email,
                'ult_bono'  => $row->bono,
                'txtpie1'   => $row->txtpie1,
                'txtpie2'   => $row->txtpie2,
                'sms_usr'   => $row->smsusr,
                'sms_password'=> $row->smspasswd,
                'sms_licencia'=>$row->smslic,
                'sms_sender'  =>$row->smssender,
                'sms_pais'   =>$row->smspais,
                'sms_zona'   =>$row->smszona,
                'sms_am'     =>$row->smsam,
                'sms_pm'     =>$row->smspm,
                'ccc_ss'     =>$row->cccss,
                'tpv'        =>true,
                'disco'      =>'disk',
                'created_at' => $row->sysfum.' 00:00:00',
                'updated_at' => $row->sysfum.' '.$row->syshum,
                'username'   => $row->sysusr
            );

        }

        DB::table('empresas')->insert($data);



    //     $emp = new Empresa;
    //     $emp->nombre = "Demo";
    //     $emp->razon = "Demo";
    //     $emp->cif="B82848417";
    //     $emp->titulo = "Sanaval";
    //    // $emp->logo = "logo.jpg";
    //     $emp->certificado = "";
    //     $emp->passwd_cer="";
    //     $emp->flags='11111000000000000000';
    //     $emp->save();


        $alm = new Almacen;
        $alm->empresa_id=1;
        $alm->nombre = "Almacén 1";
        $alm->save();

        DB::table('empresa_user')->insert(
            ['empresa_id' => 1, 'user_id' => '1'],
            ['empresa_id' => 1, 'user_id' => '2']
        );

        $fp = new Fpago;
        $fp->id =1 ;
        $fp->nombre = "Efectivo";
        $fp->save();

        $fp = new Fpago;
        $fp->id =2 ;
        $fp->nombre = "Transferencia";
        $fp->save();

        $fp = new Fpago;
        $fp->id =3 ;
        $fp->nombre = "Talón";
        $fp->save();

        $fp = new Fpago;
        $fp->id =4 ;
        $fp->nombre = "Tarjeta";
        $fp->save();


        $par = new Parametro;
        $par->pie_rebu1 = "Dispone de un plazo máximo de 15 días para su devolución. No se reembolsará dinero.";
        $par->retencion = 0;
        //$par->img1 = 'hero.jpeg';
        $par->save(); // con valores defecto migración de momento.

        $reg = new Iva;
        $reg->nombre = "General";
        $reg->importe = 21;
        $reg->save();

        $reg = new Iva;
        $reg->nombre = "Exento IVA";
        $reg->importe = 0;
        $reg->leyenda="Actividad exenta de IVA s/Art. 20 IVA.";
        $reg->save();

        $cat = new Categoria;
        $cat->nombre = "Fisioterapueta";
        $cat->save();

        $cat = new Categoria;
        $cat->nombre = "Servicios";
        $cat->save();

        $fp = new Estado;
        $fp->id =1 ;
        $fp->nombre = "Pendiente";
        $fp->color = "orange--text darken-4";
        $fp->save();

        $fp = new Estado;
        $fp->id =2 ;
        $fp->nombre = "Ok";
        $fp->color = "green--text darken-1";
        $fp->save();

        $fp = new Estado;
        $fp->id =3 ;
        $fp->nombre = "Pagada";
        $fp->color = "green--text darken-4";
        $fp->save();
        
        $fp = new Estado;
        $fp->id =4 ;
        $fp->nombre = "Cancelada";
        $fp->color = "red--text darken-4";
        $fp->save();


        // $mot = new Motivo();
        // $mot->nombre = "Falta de información importante en el documento";
        // $mot->save();

        // $mot = new Motivo();
        // $mot->nombre = "Error o ausencia en los datos profesionales";
        // $mot->save();

        // $mot = new Motivo();
        // $mot->nombre = "IVA erróneo";
        // $mot->save();

        // $mot = new Motivo();
        // $mot->nombre = "Importes erroneos";
        // $mot->save();

        // $mot = new Motivo();
        // $mot->nombre = "Devolución de productos";
        // $mot->save();

        // $mot = new Motivo();
        // $mot->nombre = "Otros";
        // $mot->save();



    }
}
