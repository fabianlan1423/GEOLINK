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


