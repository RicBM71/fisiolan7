<?php

namespace App\Http\Controllers\Mto;

use App\Empleado;
use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mto\UpdateEmpleadoRequest;

class EmpleadosController extends Controller
{



        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Empleado::with(['categoria'])->activos(true)->get();

        if (request()->wantsJson())
            return $data;
    }

    public function filtrar(Request $request)
    {

        $data = $request->validate([
            'activo' => ['boolean'],
        ]);


        if (request()->wantsJson()){
            return $this->seleccionar($data);
        }

    }

    /**
     *  @param array $data // condiciones where genéricas
     *  @param array $doc  // condiciones para documentos
     */
    private function seleccionar($data){


        return Empleado::with(['categoria'])->activos($data['activo'])->get();


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
                'categorias' => Categoria::selCategorias()
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
            'apellidos' => ['required', 'string', 'max:50'],
            'categoria_id' => ['required', 'integer'],
        ]);

        $data['username'] = session('username');

        $reg = Empleado::create($data);

        if (request()->wantsJson())
            return ['registro'=>$reg, 'message' => 'EL registro ha sido creado'];
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {

      //  $this->authorize('update', $user->load('empresas'));


        if (request()->wantsJson())
            return [
                'registro'     => $empleado,
                'categorias' => Categoria::selCategorias()
            ];

    }

    public function update(UpdateEmpleadoRequest $request, Empleado $empleado)
    {

        //$this->authorize('update', $empleado);

        $data = $request->validated();

        $empleado->update($data);

        if (request()->wantsJson())
            return ['registro'=>$empleado, 'message' => 'EL registro ha sido modificado!'];

    }

    public function destroy(Empleado $empleado)
    {

        //$this->authorize('delete', $empleado);

        $empleado->delete();

        if (request()->wantsJson()){
            return response()->json(Empleado::with(['categoria'])->activos(true)->get());
        }


    }


}
