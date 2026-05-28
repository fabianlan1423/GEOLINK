<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\DB;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', function () {
    return view('registro');
});

Route::get('/geolink', function () {
    return view('geolink');
})->name('consulta');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


// rutas para interaccion con bases de datos 

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


