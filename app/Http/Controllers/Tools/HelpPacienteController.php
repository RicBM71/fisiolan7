<?php

namespace App\Http\Controllers\Tools;

use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HelpPacienteController extends Controller
{


    public static function index(Request $request){

        $data = $request->validate([
            'search' => ['required','string']
        ]);

        //$cadena = 'ri,ba';

        if (request()->wantsJson()){

            return Paciente::select(DB::raw('id AS value, CONCAT(nombre," ",apellidos) AS text'))
                    ->razon($data['search'])
                    ->orderBy('nombre')
                    ->orderBy('apellidos')
                    ->get();
        }
    }


}
