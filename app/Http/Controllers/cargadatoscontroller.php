<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class cargadatoscontroller extends Controller
{
    public function carga(Request $request)
    {

        DB::table('proyecto')->truncate();

        $request->validate([
            'archivo' => 'required|file|mimes:csv,txt|max:81200',
        ]);

        $archivo = $request->file('archivo');

        $handle = fopen(
            $archivo->getRealPath(),
            'r'
        );

        if (!$handle) {
            return response()->json([
                'mensaje' => 'No fue posible abrir el archivo'
            ], 500);
        }

        // Leer encabezados
        $encabezados = fgetcsv($handle, 0, ';');

        $cantidad = 0;

        while (($fila = fgetcsv($handle, 0, ';')) !== false) {

            if (count($fila) < 18) {
                continue;
            }

            

            DB::table('proyecto')->insert([
                'id_pre'        => $fila[0],
                'ds'            => $fila[1],
                'nombre_cli'    => $fila[2],
                'proyecto'      => $fila[3],
                'departamento'  => $fila[4],
                'ciudad'        => $fila[5],
                'direccion'     => $fila[6],
                'complemento'   => $fila[7],
                'nombre_edifi'  => $fila[8],
                'barrio'        => $fila[9],
                'latitud'       => $fila[10],
                'longitud'      => $fila[11],
                'coordenadas'   => $fila[12],
                'producto'      => $fila[13],
                'ancho_banda'   => $fila[14],
                'tipo_enlace'   => $fila[15],

                // CONVERTIR FECHA
                'fech_regi'     => $this->convertirFecha($fila[16]),

                'usuario_reg'   => $fila[17],
            ]);

            $cantidad++;
        }

        fclose($handle);

        return response()->json([
            'mensaje' =>
                "Archivo cargado correctamente. " .
                "Registros procesados: $cantidad"
        ]);
    }


    private function convertirFecha($fecha)
    {
        if (empty($fecha)) {
            return null;
        }

        $fecha = trim($fecha);

        $fechaConvertida = \DateTime::createFromFormat(
            'd/m/Y',
            $fecha
        );

        if (
            !$fechaConvertida ||
            $fechaConvertida->format('d/m/Y') !== $fecha
        ) {
            throw new \Exception(
                "Fecha inválida: {$fecha}"
            );
        }

        return $fechaConvertida->format('Y-m-d');
    }

    
}
