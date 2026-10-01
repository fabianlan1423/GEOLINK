<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\cargadatoscontroller;
use App\Http\Controllers\consultamasiva;
use App\Http\Controllers\RutaController;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use PhpParser\Node\Stmt\Return_;

/*Route::get('/', function () {
    return view('welcome');
});*/

// Route::post('\usuarioconectado', function (Request $request){
//     return View
// })->name('usuarioconecta');

Route::get('/', function () {
    return view('registro');
});


Route::get('/geolink', function () {
    return view('geolink');
})->name('consulta');

Route::get('/mapacalor', function () {
    return view('mapacalor');
})->name('mapacalor');

Route::get('/geolinkmasivo', function () {
    return view('geolinkmasivo');
})->name('geolinkmasivo');

// apertura a menu principal GEOLINK
Route::get('/menu', function () {
    return View('menu');
});


Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');





// rutas para interaccion con bases de datos 

Route::post('/carga_coordenadas',
    [UsuarioController::class, 'carga_coordenadas']
);
Route::post('/carga-datos',
    [cargadatoscontroller::class, 'carga']
);


Route::post('/registro_usuario',
    [UsuarioController::class,'guardar']
);

Route::post('/existente',
    [UsuarioController::class,'consultausuario']
);
Route::post('/acceso',
    [UsuarioController::class,'accesousuario']
);
Route::get('/geolink',
    [UsuarioController::class,'consultalocalidades']
);
Route::post('/limpiezatbrespuesta',
    [UsuarioController::class,'lipiezatbpuntosencillo']
);
Route::post('/geom',
    [UsuarioController::class,'creaciongeom']
);
Route::post('/datosconsulta',
    [UsuarioController::class,'datoaconsultar']
);
Route::post('/pordireccion',
    [UsuarioController::class,'consultapordireccion']
);
Route::post('/pordireccion',
    [UsuarioController::class,'consultapordireccion']
);
Route::post('/zc',
    [UsuarioController::class,'consultazc']
);
Route::post('/za',
    [UsuarioController::class,'consultaza']
);
Route::post('/emp',
    [UsuarioController::class,'consultaemp']
);

Route::post('/ors/ruta', 
    [RutaController::class, 'ruta']
);
Route::post('/consult_direccion', 
    [UsuarioController::class, 'consultadireccion']
);
Route::post('/consultnodo', 
    [UsuarioController::class, 'consultanodo']
);
Route::post('/zatigo', 
    [UsuarioController::class, 'consultazatigo']
);
Route::post('/consultacolum', 
    [UsuarioController::class, 'consultacolumnas']
);




Route::post('/geomproyec', 
    [consultamasiva::class, 'datogeomproyec']
);
Route::post('/zamasivo', 
    [consultamasiva::class, 'consultazamasivo']
);
Route::post('/zcmasivo', 
    [consultamasiva::class, 'consultazcmasivo']
);
Route::post('/nodomasivo', 
    [consultamasiva::class, 'consultanodomasivo']
);
Route::post('/fenixmasivo', 
    [consultamasiva::class, 'consultafenixmasivo']
);
Route::post('/limpiatabla', 
    [consultamasiva::class, 'limpieza']
);
Route::post('/exportaarchivo', 
    [consultamasiva::class, 'exportarRespuestaCsv']
);






Route::post('/logout', function () {
    session()->forget('usuario');
    session()->invalidate();
    session()->regenerateToken();

    return response()->json([
        'success' => true
    ]);
});




use Illuminate\Support\Facades\Http;

Route::get('/test-ors', function () {

    try {

        $response = Http::withoutVerifying()
            ->timeout(20)
            ->get('https://api.openrouteservice.org');

        return [
            'status' => $response->status(),
            'body' => substr($response->body(), 0, 200)
        ];

    } catch (\Exception $e) {

        return [
            'error' => $e->getMessage()
        ];

    }
    

});

Route::get('/phpinfo', function () {
    phpinfo();
});