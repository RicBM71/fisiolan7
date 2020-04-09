<?php

use App\Iva;
use App\Fpago;
use App\Almacen;
use App\Empresa;
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

        DB::table('empresa_user')->truncate();


        $emp = new Empresa;
        $emp->nombre = "Demo";
        $emp->razon = "Demo";
        $emp->cif="B82848417";
        $emp->titulo = "Sanaval";
       // $emp->logo = "logo.jpg";
        $emp->certificado = "";
        $emp->passwd_cer="";
        $emp->almacen_id = 1;
        $emp->flags='11111000000000000000';
        $emp->save();


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
        $reg->rebu = false;
        $reg->save();

        $reg = new Iva;
        $reg->nombre = "Exento IVA";
        $reg->importe = 0;
        $reg->leyenda="IVA NO APLICABLE SEGUN LEY 55/1999. BOE 30.12.1999";
        $reg->rebu = false;
        $reg->save();

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
