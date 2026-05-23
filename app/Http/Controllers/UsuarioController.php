<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;


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

    public function consultausuario(Request $request){

        $usuario = DB::table('registro_users')
            ->where('correo', $request->correo)
            ->exists();

            return response()->json([
                'existe' => $usuario
            ]);

       
    }
    public function accesousuario(Request $request){

        $usuario = DB::table('registro_users')
            ->where('nombre', $request->usuario)
            ->first();

        if($usuario && Hash::check($request->password, $usuario->contraseña)){
            
            return response()->json([
                'existe' => true
            ]);
        
        }else{
            return response()->json([
                'existe' => false
            ]);
        }

           

       
    }
    public function consultalocalidades(Request $request){

        $localidades = DB::connection('conexion_osp')
            ->table('osp_3gys')
            ->select('localidad')
            ->distinct()
            ->get();

        return view('geolink', compact('localidades'));

       
    }
   

}
