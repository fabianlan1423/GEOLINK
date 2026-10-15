<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;
use App\Mail\EnviarCorreo;
use DateTime;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\table;

class correo extends Controller{


    public function nuevacontrasenia(Request $request){
        
        $usuario = $request->usuario;
        $recuperacionPassword = $request->recuperacionPassword;
        $recuperacionPassword2 = $request->recuperacionPassword2;
        $nomusuario = $request->nomusuario;

        // Validar que las contraseñas coincidan
        if ($recuperacionPassword !== $recuperacionPassword2) {
            return response()->json([
                'mensaje' => 'Las contraseñas no coinciden'
            ], 422);
        }

        // Ejecutar las actualizaciones en una transacción
        $resultado = DB::transaction(function () use (
            $usuario,
            $nomusuario,
            $recuperacionPassword
        ) {
            $actualizados = DB::table('registro_users')
                ->where('id', $usuario)
                ->where('usuario', $nomusuario)
                ->update([
                    'contrasenia' => Hash::make($recuperacionPassword)
                ]);

            // Si no se actualizó ninguna fila, no continuar
            if ($actualizados === 0) {
                return false;
            }

            // Marcar la recuperación como utilizada
            $recuperados = DB::table('recuperacion')
                ->where('id', $usuario)
                ->update([
                    'usado' => true,
                    'intentos' => 1
                ]);

            if ($recuperados === 0) {
                throw new \RuntimeException(
                    'No se pudo actualizar el registro de recuperación.'
                );
            }

            return true;
        });

        return response()->json([
            'mensaje' => $resultado
                ? 'Contraseña actualizada correctamente'
                : 'No se encontró el usuario o no se pudo actualizar la contraseña'
        ], $resultado ? 200 : 404);
    }


    public function codrecuperacioncontrasenia(Request $request){

        $datorecuperacion = $request -> datorecuperacion;
        $idusuario = $request -> idusuario;

        $recuperacion = DB::table('recuperacion')
            ->where('usuario_id',$idusuario)
            ->where('codigo',$datorecuperacion)
            ->where('expira','>', now()->setTimezone('America/Bogota'))
            ->where('usado',false)
            ->first();

            if($recuperacion){
                return response()->json([
                    'estado' => true
                                    
                ]);
            }

            return response()->json([
                    'estado' => false,
                    'mensaje' => 'Codigo De Recuperacion Incorrecto'
                
                ]);




    }


    public function enviarCorreo(Request $request)    {
        $correo = $request->correo;
        $codigo = $request->codigo;
        $iduser = $request->iduser;
        $solicitado = $request->solicitado;

        Mail::raw(
            "Código de recuperación GEOLINK: $codigo",
            function ($message) use ($correo) {

                $message->to($correo)
                        ->subject('Código de recuperación GEOLINK');
            }

            
        );
        
        DB::table('recuperacion')->insert([
            'usuario_id' =>  $request->iduser,
            'codigo' =>  $request->codigo,
            'expira' =>  now()->setTimezone('America/Bogota')->addMinutes(15),
            'usado' =>  false,
            'intentos' =>  0,
            'solicitado' => now()->setTimezone('America/Bogota'),

        ]);

        return response()->json([
            'exito' => true,
            'mensaje' => 'Correo enviado correctamente'
        ]);
    }


    public function recuperacioncontrasenia(Request $request ){
        $correo = $request->correo;

        $data = DB::connection('conexion_osp')
        ->select("select id,
                        nombre,
                        correo,
                        usuario
                    from registro_users
                        where correo = ? ", [$correo]);


            return response()->json([
                'data' => $data
            ]);

    }

   
}
