<?php

namespace App\Http\Controllers;

use App\User;
use App\Empresa;
use App\Traspaso;
use App\Parametro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

         return view('home');
    }

    public function dash(Request $request)
    {

        $authUser = $request->user();

        // $admin = ($request->user()->hasRole('Root') || $request->user()->hasRole('Admin'));

        $role_user=[];
        $data = User::find($authUser->id)->roles()->get();
        foreach($data as $role){
            $role_user[]=$role->name;
        }

        $permisos_user=[];
        //$data = User::find($authUser->id)->permissions()->get();
        $data = auth()->user()->getAllPermissions();
        foreach($data as $permiso){
            $permisos_user[]=$permiso->name;
        }

        $empresas_usuario = collect();
        foreach ($authUser->empresas as $empresa){
            if ($empresa->flags[0] == false)
                continue;

            $empresa_id = $empresa->id;

            $empresas_usuario->push($empresa->id);
            $empresas[] = [
                'value' => $empresa->id,
                'text' => $empresa->titulo
            ];
        }


        $parametros = Parametro::find(1);

        // empresa seleccionada
        $e = DB::table('empresa_user')->select('empresa_id')
                                    ->where('user_id', $authUser->id)
                                    ->where('activa', true)
                                    ->get()->first();
        if ($e != null)
            $empresa_id = $e->empresa_id;
        else{
            DB::table('empresa_user')->where('user_id', $authUser->id)
                        ->where('empresa_id', $empresa_id)
                        ->update(['activa' => true]);
        }

        $empresa = Empresa::findOrFail($empresa_id);

        $user = [
            'id'            => $authUser->id,
            'name'          => $authUser->name,
            'username'      => $authUser->username,
            'avatar'        => $authUser->avatar,
            'empresa_id'    => $empresa_id,
            'empresa_nombre'=>$empresa->titulo,
            'roles'         => $role_user,
            'permisos'      => $permisos_user,
            'empresas'      => $empresas,
            'parametros'    =>$parametros,
            'img_fondo'     => $empresa->img_fondo,
            'aislar_empresas'  => $parametros->aislar_empresas
        ];

       // de momento no quito filtros, ya veremos.
        $this->unloadSession($request);

        $jobs  = DB::table('jobs')->count();

        session([
            'empresa_id'       => $empresa_id,
            'empresa'          => Empresa::find($empresa_id),
            'username'         => $authUser->username,
            'empresas_usuario' => $empresas_usuario,
            'parametros'       => $parametros,
            'aislar_empresas'  => $parametros->aislar_empresas
            ]);

        if (request()->wantsJson())
            return [
                'user'      => $user,
                'expired'   => $this->verificarExpired($request),
                'authuser'  => $authUser,
                'jobs'      => $jobs,
            ];
    }

    public function avatar(Request $request){

        $request->validate([
    		'avatar' => 'required|image|max:256'	//jpeg png, gif, svg
    	]);

        $user = $request->user();

    	$foto = request()->file('avatar')->store('avatars','public');


    	$fotoUrl = Storage::url($foto);

    	// 	//insert en la tabla photos
    	$user->update([
    	 	'avatar'	=> $fotoUrl,
    	 	'id'         => $user->id
        ]);

        return ['url'=>$fotoUrl];

    }

    public function destroy(Request $request)
    {

        $user = $request->user();

       $fotoPath = str_replace('storage', 'public', $user->avatar);
       $user->update([
            'avatar'    =>  null,
            'id'         => $user->id
        ]);

       // dd($fotoPath);

        Storage::delete($fotoPath);

        if (request()->wantsJson())
            return ['msg' => 'Avatar eliminado'];

    }

    /**
     *  Descarga todos los filtros al pasar por inicio
     */
    private function unloadSession($request){
        $data = $request->session()->all();
        foreach ($data as $key => $value){
            if (strstr($key, '_', true)=='filtro'){
                $request->session()->forget($key);
            }
        }
    }

    public function expired(){
    }

    public function verificarExpired($request){

        if ($request->user()->expira != 0 || is_null($request->user()->fecha_expira)){

            $f = Carbon::parse($request->user()->fecha_expira);
            $dias = $f->diffInDays(Carbon::now());

            if ($dias > ($request->user()->expira)  || is_null($request->user()->fecha_expira))
                return true;
        }
        return false;
    }


}
