<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
   public function guardar(Request $request){

        DB::table('registro_users')->insert([

            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contraseña' => Hash::make($request->contrasenia1)


        ]);

        return response()->json([
            'mensaje' => 'usuario creado'
        ]);

    }
}
