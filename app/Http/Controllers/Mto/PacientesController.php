<?php

namespace App\Http\Controllers\Mto;

use App\Cita;
use App\Medio;
use App\Mutua;
use App\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Mto\UpdatePacienteRequest;

class PacientesController extends Controller
{
    public function index()
    {

        $data = Paciente::orderBy('id','desc')->get()->take(50);

        if (request()->wantsJson())
            return $data;
    }

    public function filtrar(Request $request)
    {

        $data = $request->validate([
            'nombre' => ['nullable'],
            'direccion' => ['nullable'],
            'telefono' => ['nullable'],
            'espera' => ['boolean'],
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


        return Paciente::nombre($data['nombre'])
                        ->direccion($data['direccion'])
                        ->telefono($data['telefono'])
                        ->espera($data['espera'])
                        ->orderBy('id','desc')
                        ->get()
                        ->take(500);


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

    public function show(Paciente $paciente)
    {

        if (request()->wantsJson())
            return [
                'paciente' => $paciente,
            ];

    }

    public function edit(Paciente $paciente)
    {

        if ($paciente->recomendado_id > 0){
            $recomendado = Paciente::selPacienteId($paciente->recomendado_id);
        }else{

            $recomendado = null;
        }



        $paciente->load(['historias','pacbonos.tratamiento', 'adjuntos']);

        if (request()->wantsJson())
            return [
                'medios'   => Medio::selMedios(),
                'mutuas'   => Mutua::selMutuas(),
                'paciente' => $paciente,
                'recomendado' => $recomendado,
                'citas'     => Cita::with(['tratamiento','estado','facultativo'])->where('paciente_id', $paciente->id)->get(),
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

    public function capture(Request $request)
    {

        $data = $request->validate([
            'paciente_id'   => ['required', 'integer'],
            'img'           => ['required', 'string'],
        ]);


        $file = 'fotos/'.$data['paciente_id'].'.jpg';

        $imgdata = explode( ",", $data['img']);

        $i = base64_decode($imgdata[1]);

        Storage::disk('public')->put($file, $i);

    }

    public function delcap(Request $request)
    {

        $data = $request->validate([
            'paciente_id'   => ['required', 'integer'],
        ]);


        $file = 'public/fotos/'.$data['paciente_id'].'.jpg';

        //$fotoPath = str_replace('storage', 'public', $file);

        Storage::delete($file);

        return $file;

    }


    private function getDecript($file,$pdf){

        if (Storage::disk('docs')->exists($file))
            $myFile = Storage::disk('docs')->get($file);
        else
            return false;


        //return ($pdf) ?($myFile) : "data:image/jpg;base64,".$myFile;
        return ($pdf) ? Crypt::decryptString($myFile) : "data:image/jpg;base64,".Crypt::decryptString($myFile);
    }


}
