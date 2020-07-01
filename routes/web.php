<?php


Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dash', 'HomeController@dash')->name('dash');
Route::post('/profile/avatar', 'HomeController@avatar');
Route::put('/profile/destroy', 'HomeController@destroy');

// Route::get('/test', 'HomeController@test');

Route::get('/expired', 'HomeController@expired')->name('expired');


Route::group([
    //'as' => '.admin' ver php artisan r:l para ver problema admin.admin.
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth']],
    function (){

        Route::post('users/password/update', 'UsersController@updatePassword');

    }
);


Route::group([
    //'as' => '.admin' ver php artisan r:l para ver problema admin.admin.
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth','password']],
    function (){

        Route::resource('parametros', 'ParametrosController', ['only'=>['index','update'], 'as' => 'root']);
        Route::post('parametros/main', 'ParametrosController@main');
        Route::put('parametros/main/delete', 'ParametrosController@deletemain');
        Route::post('parametros/section', 'ParametrosController@section');
        Route::put('parametros/section/delete', 'ParametrosController@deletesection');

        Route::resource('roles', 'RolesController', ['as' => 'root']);
        Route::resource('permissions', 'PermissionsController', ['except'=>'show', 'as' => 'root']);

        Route::resource('users', 'UsersController', ['as' => 'admin']);

        Route::middleware(['role_or_permission:Root|users'])
            ->put('users/{user}/roles','UsersRolesController@update');

        // Route::middleware('role:Root|Admin')
        //     ->put('users/{user}/permissions','UsersPermissionsController@update');
        Route::middleware(['role_or_permission:Root|users'])
            ->put('users/{user}/permissions','UsersPermissionsController@update');

        Route::middleware(['role_or_permission:Root|users'])
            ->put('users/{user}/empresas','UsersEmpresasController@update');


        Route::put('users/{user}/empresa', 'UsersController@updateEmpresa');
        Route::put('users/{user}/reset', 'UsersController@reset');

        Route::post('users/{user}/avatar', 'AvatarsController@store');
        Route::delete('avatars/{user}/delete', 'AvatarsController@destroy');


        Route::resource('empresas', 'EmpresasController', ['except'=>'show','as' => 'admin']);
        Route::post('empresas/{empresa}/logo', 'EmpresasController@logo');
        Route::put('empresas/{empresa}/logo/delete', 'EmpresasController@deletelogo');
        Route::post('empresas/{empresa}/fondo', 'EmpresasController@fondo');
        Route::put('empresas/{empresa}/fondo/delete', 'EmpresasController@deletefondo');

        Route::resource('ipusers', 'IpUsersController', ['only'=>['store','destroy'], 'as' => 'admin']);

    }
);


Route::group([
    'prefix' => 'mto',
    'namespace' => 'Mto',
    'middleware' => ['auth','password']],
    function (){
        // Route::resource('clientes', 'ClientesController', ['as' => 'mto']);
        // Route::put('clientes/{cliente}/obs', 'ClientesController@obs');
        // Route::get('clientes/{cliente}/albaranes', 'ClientesController@albaranes');
        // Route::post('clientes/filtrar', 'ClientesController@filtrar');
        // Route::resource('clidocs', 'ClidocsController', ['only'=>['store','destroy'],'as' => 'mto']);
        // Route::get('clidocs/{cliente_id}/{compra_id?}/create', 'ClidocsController@create');

        Route::resource('almacenes', 'AlmacenesController', ['as' => 'mto']);
        Route::resource('bonos', 'BonosController', ['as' => 'mto']);
        Route::resource('ivas', 'IvasController', ['as' => 'mto']);
        Route::resource('tratamientos', 'TratamientosController', ['as' => 'mto']);
        Route::post('empleados/filtrar', 'EmpleadosController@filtrar');
        Route::resource('empleados', 'EmpleadosController', ['as' => 'mto']);

        Route::resource('cajas', 'CajasController', ['as' => 'mto']);
        Route::post('cajas/filtrar', 'CajasController@filtrar');
        Route::post('cajas/cerrar', 'CajasController@cerrar');
        Route::post('cajas/saldo', 'CajasController@saldo');
        Route::post('cajas/excel', 'CajasController@excel');

        // Route::resource('libros', 'LibrosController', ['as' => 'mto']);
        // Route::post('libros/filtrar', 'LibrosController@filtrar');
        // Route::resource('garantias', 'GarantiasController', ['as' => 'mto']);
        // Route::resource('talleres', 'TalleresController', ['as' => 'mto']);
        // Route::resource('apuntes', 'ApuntesController', ['as' => 'mto']);

        // Route::resource('cruces', 'CrucesController', ['as' => 'mto']);


        // Route::resource('productos', 'ProductosController', ['as' => 'mto']);
        // Route::post('productos/filtrar', 'ProductosController@filtrar');
        // Route::get('productos/print/{id}', 'PrintGarantiaDepositoController@print');
        // Route::post('/productos/excel', 'ProductosController@excel');

        // Route::resource('traspasos', 'TraspasosController', ['as' => 'mto']);
        // Route::post('traspasos/filtrar', 'TraspasosController@filtrar');

        // Route::resource('contadores', 'ContadoresController', ['as' => 'mto']);
        // Route::post('contadores/filtrar', 'ContadoresController@filtrar');

        // Route::post('recuentos/close', 'RecuentosController@close');
        // Route::post('recuentos/reset', 'RecuentosController@reset');
        // Route::resource('recuentos', 'RecuentosController', ['as' => 'mto']);
        // Route::post('recuentos/filtrar', 'RecuentosController@filtrar');
        // Route::post('recuentos/excel', 'RecuentosController@excel');

        // Route::middleware('role:Root|Admin')->group(function () {
        //     Route::resource('transferencias', 'TransferenciasController', ['as' => 'mto']);
        //     Route::post('transferencias/filtrar', 'TransferenciasController@filtrar');
        // });
    }
);

Route::group([
    'prefix' => 'utilidades',
    'namespace' => 'Utilidades',
    'middleware' => ['auth','password']],
    function (){
        Route::get('helpgrupos', 'HelpGruposController@index');
      //  Route::get('helpgrupos/productos', 'HelpGruposController@productos');
        Route::get('helpgrupos/{grupo_id}/clases', 'HelpGruposController@clases');
        Route::post('helpcli', 'HelpCliController@index');
        Route::post('helpcli/blacklist', 'HelpCliController@blacklist');
        Route::post('helpcli/compras', 'HelpCliController@compras');
        Route::post('helpcli/ventas', 'HelpCliController@ventas');
        Route::post('helpcli/dni', 'HelpCliController@dni');
        Route::post('helplibro', 'HelpLibroController@index');
        Route::post('helplibro/ejercicio', 'HelpLibroController@ejercicio');
        Route::get('helplibro/abiertos', 'HelpLibroController@abiertos');
        Route::post('helpdepo', 'HelpDepositosController@index');
        Route::post('helppro/vendibles', 'HelpProductoController@vendibles');
        Route::post('helppro/producto', 'HelpProductoController@producto');
        Route::post('helppro/albaranes', 'HelpProductoController@albaranes');
        Route::post('helppro/find', 'HelpProductoController@find');

        Route::get('helppro/filtro', 'HelpProductoController@filtro');
        Route::get('helpfases/compra', 'HelpFasesController@compra');
        Route::get('helpfases/venta', 'HelpFasesController@venta');
        Route::get('helpfiltroalb', 'HelpFiltroAlbController@index');
        Route::post('helptaller/ventas', 'HelpTalleresController@ventas');
        Route::put('reacli', 'ReasignarClienteController@reasignar');
        Route::get('helpapuntes', 'HelpApuntesController@index');

        Route::get('check/{ejercicio?}', 'ContadorCheckController@index');
        Route::post('intercambio', 'IntercambioController@submit');

        Route::put('reasignar/empresa/producto/{producto}', 'ReasignarEmpresaProductoController@update');
        Route::post('importar/producto', 'ImportarProductoController@store');

        Route::post('cierre', 'CierreController@submit');

     //   Route::get('helpbanco', 'HelpBancosController@index');
    }
);


Route::any('{all}', function () {
    return view('welcome');
})->where(['all' => '.*']);
