<?php

namespace App\Http\Controllers\Mto;

use App\Bono;
use App\Tratamiento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BonosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Bono::all();

        if (request()->wantsJson())
            return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', new iva);

        if (request()->wantsJson())
            return [
                'tratamientos' => Tratamiento::selTratamientos()
            ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:50'],
            'tratamiento_id' => ['required', 'integer'],
        ]);

        $data['username'] = session('username');

        $reg = Bono::create($data);

        if (request()->wantsJson())
            return ['registro'=>$reg, 'message' => 'EL registro ha sido creado'];
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bono $bono)
    {

      //  $this->authorize('update', $user->load('empresas'));


        if (request()->wantsJson())
            return [
                'bono'         => $bono,
                'tratamientos' => Tratamiento::selTratamientos()
            ];

    }
}
