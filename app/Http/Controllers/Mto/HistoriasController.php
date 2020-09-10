<?php

namespace App\Http\Controllers\Mto;

use App\Empleado;
use App\Historia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mto\UpdateHistoriaRequest;

class HistoriasController extends Controller
{

    public function store(Request $request)
    {

        //\Log::info($request);

        $data = $request->validate([
            'paciente_id'    => ['required', 'integer'],
        ]);

        $data['fecha'] = Carbon::today();
        $data['username'] = session('username');

        $reg = Historia::create($data);

        if (request()->wantsJson())
            return ['historia'=>$reg, 'message' => 'EL registro ha sido creado'];
    }


    public function edit(Historia $historia)
    {

        $historia->load('paciente');

        if (request()->wantsJson())
            return [
                'historia'  => $historia,
                'empleados' => Empleado::selFisios()
            ];

    }

    public function update(UpdateHistoriaRequest $request, Historia $historia)
    {

        //$this->authorize('update', $historia);

        $data = $request->validated();

        $data['username'] = session('username');

        \Log::info($data);

        $historia->update($data);

        if (request()->wantsJson())
            return ['historia'=>$historia, 'message' => 'EL registro ha sido modificado!'];

    }


}
