<?php

namespace App\Http\Controllers\Mto;

use App\Horario;
use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mto\UpdateHorarioRequest;

class HorariosController extends Controller
{

    public function index()
    {

        $data = Horario::where('empleado_id',session('empleado_id'))->get();

        if (request()->wantsJson())
            return [
                'horario' => $data,
                'empleado'=> Empleado::findOrFail(session('empleado_id'))
            ];
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'fecha' => ['required', 'date'],
        ]);

        $data['username'] = session('username');
        $data['empleado_id']=session('empleado_id');

        $reg = Horario::create($data);

        if (request()->wantsJson())
            return ['registro'=>$reg, 'message' => 'EL registro ha sido creado'];
    }


    public function edit(Horario $horario)
    {

        $horario->load('empleado');

        if (request()->wantsJson())
            return [
                'registro'     => $horario,
            ];

    }

    public function update(UpdateHorarioRequest $request, Horario $horario)
    {

        //$this->authorize('update', $empleado);

        $data = $request->validated();

        $data['username'] = session('username');

        $horario->update($data);

        if (request()->wantsJson())
            return ['registro'=>$horario, 'message' => 'EL registro ha sido modificado!'];

    }

    public function destroy(Horario $horario)
    {

        //$this->authorize('delete', $empleado);


        $horario->delete();

        if (request()->wantsJson())
            return Horario::where('empleado_id',session('empleado_id'))->get();


    }



}
