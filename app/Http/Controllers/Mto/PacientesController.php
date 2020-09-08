<?php

namespace App\Http\Controllers\Mto;

use App\Medio;
use App\Mutua;
use App\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mto\UpdatePacienteRequest;

class PacientesController extends Controller
{
    public function index()
    {

        $data = Paciente::orderBy('id','desc')->get()->take(50);

        if (request()->wantsJson())
            return $data;
    }

    public function create()
    {
        //$this->authorize('create', new iva);

        if (request()->wantsJson())
            return [

            ];
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'nombre'    => ['required', 'string', 'max:50'],
            'apellidos' => ['required', 'string', 'max:50'],
        ]);

        $data['username'] = session('username');

        $reg = Paciente::create($data);

        if (request()->wantsJson())
            return ['paciente'=>$reg, 'message' => 'EL registro ha sido creado'];
    }

    public function edit(Paciente $paciente)
    {

        if ($paciente->recomendado_id > 0){
            $recomendado = Paciente::selPacienteId($paciente->recomendado_id);
        }else{

            $recomendado = null;
        }


        if (request()->wantsJson())
            return [
                'medios'   => Medio::selMedios(),
                'mutuas'   => Mutua::selMutuas(),
                'paciente' => $paciente,
                'recomendado' => $recomendado
            ];

    }

    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {

        //$this->authorize('update', $paciente);

        $data = $request->validated();

        $data['username'] = session('username');

        $paciente->update($data);

        if (request()->wantsJson())
            return ['paciente'=>$paciente, 'message' => 'EL registro ha sido modificado!'];

    }

    public function destroy(Paciente $paciente)
    {

        //$this->authorize('delete', $mutua);

        $data['fecha_baja'] = ($paciente->fecha_baja == null) ? date('Y-m-d') : null;
        $data['username'] = session('username');

        $paciente->update($data);

        if (request()->wantsJson()){
            return response()->json(Paciente::where('id', $paciente->id)->get());
        }


    }

}
