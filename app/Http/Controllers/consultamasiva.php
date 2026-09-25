<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;

class consultamasiva extends Controller
{
    function datogeomproyec(){

        DB::connection('conexion_osp')
            ->statement("
                UPDATE proyecto
                SET geom = ST_SetSRID(
                    ST_MakePoint(longitud, latitud),
                    4326
                );
            ");

        return response()->json([
            'mensaje' => 'Creación de datos en GEOM realizada correctamente.'
        ]);

    }

    public function limpieza(Request $request){

        try{

            DB::connection('conexion_osp')
            ->statement("truncate table respuesta");

        } catch (\Exception $e) { 
            return response()->json([ 
                'success' => false, 
                'mensaje' => 'Error en la limpieza de tabla respuesta'
                ], 500);
        
        }
    }

    public function consultazamasivo(Request $request){

        try{

        $cantza = $request->validate([
            'cantza' => 'required|integer|min:1|max:100'
        ])['cantza'];

        $data = DB::connection('conexion_osp')
        ->statement("INSERT INTO respuesta (
                    id_pre,
                    anio,
                    mes,
                    estadovb,
                    tipo,
                    nit,
                    ds,
                    cliente,
                    proyecto,
                    departamento,
                    ciudad,
                    direccion,
                    complemento,
                    nombre_edifi,
                    zona,
                    latitud,
                    longitud,
                    tipo_servicio,
                    pb,
                    ancho_banda,
                    op1_coinversor,
                    op1_central,
                    op1olt,
                    op1feeder,
                    id_cto1,
                    op1cto,
                    op1distanciacto,
                    op1dipscto,                    
                    op2_coinversor,
                    op2_central,
                    op2feeder,
                    id_cto2,
                    op2cto,
                    op2distanciacto,
                    oc2dipscto,
                    fecha_solicitud,
                    lat_cto,
                    long_cto,
                    grupo_cto
                )
                SELECT 
                    p.id_pre AS id_proyecto,
                    EXTRACT(YEAR FROM CURRENT_DATE),
                    EXTRACT(MONTH FROM CURRENT_DATE),
                    NULL AS estadovb,
                    NULL AS tipo,
                    NULL AS nit,
                    p.ds,
                    p.nombre_cli,
                    P.proyecto,
                    P.departamento,
                    p.ciudad,
                    p.direccion,
                    p.complemento,
                    p.nombre_edifi,
                    null as zona,
                    p.latitud AS lat_proyecto,
                    p.longitud AS lon_proyecto,
                    p.producto as tipo_servicio,
                    p.tipo_enlace as pb,
                    p.ancho_banda,
                    o.proveedor AS op1_coinversor,
                    NULL AS op1_central,
                    o.olt_no AS op1olt,
                    CONCAT('CA', o.cable) AS op1feeder,
                    o.idplaca AS id_cto1,
                    o.cto AS cto_osp,
                    ST_Distance(p.geom, o.geom) * 1.5::numeric(10,2) AS distancia_metros,
                    o.puertos_libres_cto as puertos_libres,
                    '' AS op2_coinversor,
                    '' AS op2_central,
                    '' AS op2feeder,
                    '' AS id_cto2,
                    '' AS op2cto,
                    '' AS op2distanciacto,
                    '' AS oc2dipscto,
                    CURRENT_DATE AS fecha_solicitud,
                    o.lat_equipo AS lat_osp,
                    o.long_equipo AS lon_osp,
                    'ZA'
                FROM proyecto p
                JOIN LATERAL (
                        SELECT *
                        FROM (
                            SELECT 
                                o.*,
                                ROW_NUMBER() OVER (
                                    PARTITION BY o.cto 
                                    ORDER BY p.geom <-> o.geom
                                ) as rn
                            FROM osp_3gys o
                            WHERE 
                                ST_DWithin(p.geom::geography, o.geom::geography, 400)
                                AND o.grupo_cto LIKE '%Abierta%'
                                AND o.puertos_libres_cto > 1
                                AND p.respuesta IS NULL
                                AND o.cto like '%CT%'
                        ) t
                        WHERE rn = 1   -- solo la más cercana por cada CTO
                        ORDER BY p.geom <-> t.geom
                        LIMIT ?      -- ahora sí: 2 CTO diferentes
                    ) o ON TRUE", [$cantza]);


            $eliminados = DB::connection('conexion_osp')
                    ->affectingStatement(" DELETE FROM respuesta a USING ( 
                        SELECT 
                            MIN(ctid) AS ctid_keep, 
                            id_pre, 
                            lat_cto, 
                            long_cto, 
                            op1distanciacto 
                        FROM respuesta 
                            GROUP BY id_pre, lat_cto, long_cto, op1distanciacto 
                            HAVING COUNT(*) > 1 ) b 
                        WHERE a.id_pre = b.id_pre 
                            AND a.lat_cto IS NOT DISTINCT FROM b.lat_cto 
                            AND a.long_cto IS NOT DISTINCT 
                        FROM b.long_cto 
                            AND a.op1distanciacto IS NOT DISTINCT FROM b.op1distanciacto 
                            AND a.ctid <> b.ctid_keep ");

        
        return response()->json([ 
            'success' => true, 
            'data' => 'Proceso ZA ejecutado correctamente.',
            'eliminados' => 'Limpieza duplicados ZA' 
        ]); 
        } catch (\Exception $e) { 
            return response()->json([ 
                'success' => false, 
                'mensaje' => $e->getMessage() 
                ], 500);
        
        }
    }
    public function consultanodomasivo(Request $request){

        try{

        $cantnodo = $request->validate([
            'cantnodo' => 'required|integer|min:1|max:100'
        ])['cantnodo'];

        $data = DB::connection('conexion_osp')
        ->statement("INSERT INTO respuesta (
                                id_pre,
                                anio,
                                mes,
                                estadovb,
                                tipo,
                                nit,
                                ds,
                                cliente,
                                proyecto,
                                departamento,
                                ciudad,
                                direccion,
                                complemento,
                                nombre_edifi,
                                zona,
                                latitud,
                                longitud,
                                tipo_servicio,
                                pb,
                                ancho_banda,
                                op1_coinversor,
                                op1_central,
                                op1olt,
                                op1feeder,
                                id_cto1,
                                op1cto,
                                op1distanciacto,
                                op1dipscto,
                                op2_coinversor,
                                op2_central,
                                op2feeder,
                                id_cto2,
                                op2cto,
                                op2distanciacto,
                                oc2dipscto,
                                fecha_solicitud,
                                lat_cto,
                                long_cto,
                                grupo_cto
                            )
                            SELECT 
                                p.id_pre AS id_proyecto,
                                EXTRACT(YEAR FROM CURRENT_DATE),
                                EXTRACT(MONTH FROM CURRENT_DATE),
                                NULL AS estadovb,
                                NULL AS tipo,
                                NULL AS nit,
                                p.ds,
                                p.nombre_cli,
                                P.proyecto,
                                P.departamento,
                                p.ciudad,
                                p.direccion,
                                p.complemento,
                                p.nombre_edifi,
                                null as zona,
                                p.latitud AS lat_proyecto,
                                p.longitud AS lon_proyecto,
                                p.producto as tipo_servicio,
                                p.tipo_enlace as pb,
                                p.ancho_banda,
                                'TEF' AS op1_coinversor,
                                '-' AS op1_central,
                                '-' AS op1olt,
                                '-' AS op1feeder,
                                o.cod_mov AS id_cto1,
                                o.hl AS cto_osp,
                                ST_Distance(p.geom, o.geom) AS distancia_metros,
                                '-' as puertos_libres,
                                '-' AS op2_coinversor,
                                '' AS op2_central,
                                '' AS op2feeder,
                                '' AS id_cto2,
                                '' AS op2cto,
                                '' AS op2distanciacto,
                                '' AS oc2dipscto,
                                CURRENT_DATE AS fecha_solicitud,
                                o.lat AS lat_osp,
                                o.lon AS lon_osp,
                                'nodo_TEF'
                            FROM proyecto p
                            JOIN LATERAL (
                                SELECT *
                                FROM (
                                    SELECT 
                                        o.*,
                                        ROW_NUMBER() OVER (
                                            PARTITION BY o.nombre_equipo 
                                            ORDER BY p.geom <-> o.geom
                                        ) as rn
                                    FROM nodo_central o
                                    WHERE 
                                        ST_DWithin(p.geom::geography, o.geom::geography, 1000)
                                        
                                ) t
                                WHERE rn = 1   -- solo la más cercana por cada CTO
                                and tx <> 'RADIO'
                                ORDER BY p.geom <-> t.geom
                                LIMIT ?       -- ahora sí: 2 NODOS diferentes
                            ) o ON TRUE", [$cantnodo]);


            $eliminados = DB::connection('conexion_osp')
                    ->affectingStatement(" DELETE FROM respuesta a
                                USING (
                                    SELECT 
                                        MIN(ctid) AS ctid_keep,
                                        id_pre,
                                        lat_cto,
                                        long_cto,
                                        op1distanciacto
                                    FROM respuesta
                                    GROUP BY 
                                        id_pre,
                                        lat_cto,
                                        long_cto,
                                        op1distanciacto
                                    HAVING COUNT(*) > 1
                                ) b
                                WHERE
                                    a.id_pre = b.id_pre
                                    AND a.lat_cto = b.lat_cto
                                    AND a.long_cto = b.long_cto
                                    AND a.op1distanciacto = b.op1distanciacto
                                    AND a.ctid <> b.ctid_keep;");

        
        return response()->json([ 
            'success' => true, 
            'data' => 'Proceso NODO ejecutado correctamente.',
            'eliminados' => 'Limpieza duplicados NODO' 
        ]); 
        } catch (\Exception $e) { 
            return response()->json([ 
                'success' => false, 
                'mensaje' => $e->getMessage() 
                ], 500);
        
        }
    }
    public function consultafenixmasivo(Request $request){

        try{

        $catnfenix = $request->validate([
            'catnfenix' => 'required|integer|min:1|max:100'
        ])['catnfenix'];

        $data = DB::connection('conexion_osp')
        ->statement("INSERT INTO respuesta (
                    id_pre,
                    anio,
                    mes,
                    estadovb,
                    tipo,
                    nit,
                    ds,
                    cliente,
                    proyecto,
                    departamento,
                    ciudad,
                    direccion,
                    complemento,
                    nombre_edifi,
                    zona,
                    latitud,
                    longitud,
                    tipo_servicio,
                    pb,
                    ancho_banda,
                    op1_coinversor,
                    op1_central,
                    op1olt,
                    op1feeder,
                    id_cto1,
                    op1cto,
                    op1distanciacto,
                    op1dipscto,
                    op2_coinversor,
                    op2_central,
                    op2feeder,
                    id_cto2,
                    op2cto,
                    op2distanciacto,
                    oc2dipscto,
                    fecha_solicitud,
                    lat_cto,
                    long_cto,
                    grupo_cto
                )
                SELECT 
                    p.id_pre AS id_proyecto,
                    EXTRACT(YEAR FROM CURRENT_DATE),
                    EXTRACT(MONTH FROM CURRENT_DATE),
                    NULL AS estadovb,
                    NULL AS tipo,
                    NULL AS nit,
                    p.ds,
                    p.nombre_cli,
                    P.proyecto,
                    P.departamento,
                    p.ciudad,
                    p.direccion,
                    p.complemento,
                    p.nombre_edifi,
                    null as zona,
                    p.latitud AS lat_proyecto,
                    p.longitud AS lon_proyecto,
                    p.producto as tipo_servicio,
                    p.tipo_enlace as pb,
                    p.ancho_banda,
                    'TIGO' AS op1_coinversor,
                    '-' AS op1_central,
                    '-' AS op1olt,
                    '-' AS op1feeder,
                    concat(o.olt_id,'-',o.armario_id) AS id_cto1,
                    o.nap_id AS cto_osp,
                    ST_Distance(p.geom, o.geom) AS distancia_metros,
                    o.estadohilo as puertos_libres,
                    '-' AS op2_coinversor,
                    '' AS op2_central,
                    '' AS op2feeder,
                    '' AS id_cto2,
                    '' AS op2cto,
                    '' AS op2distanciacto,
                    '' AS oc2dipscto,
                    CURRENT_DATE AS fecha_solicitud,
                    o.latitud AS lat_osp,
                    o.longitud AS lon_osp,
                    'Fenix'
                FROM proyecto p
                JOIN LATERAL (
                    SELECT *
                    FROM (
                        SELECT 
                            o.*,
                            ROW_NUMBER() OVER (
                                PARTITION BY o.armario_id 
                                ORDER BY p.geom <-> o.geom
                            ) as rn
                        FROM consulta_fenix o
                        WHERE 
                            ST_DWithin(p.geom::geography, o.geom::geography, 300)
                            
                    ) t
                    WHERE rn = 1   -- solo la más cercana por cada CTO
                    and tipo_nap <> 'INTERNO'
                    ORDER BY p.geom <-> t.geom
                    LIMIT ?       -- DOS RESPUESTAS POR PUNTO
                ) o ON TRUE", [$catnfenix]);


            $eliminados = DB::connection('conexion_osp')
                    ->affectingStatement("DELETE FROM respuesta a
                                USING (
                                    SELECT 
                                        MIN(ctid) AS ctid_keep,
                                        id_pre,
                                        lat_cto,
                                        long_cto,
                                        op1distanciacto
                                    FROM respuesta
                                    GROUP BY 
                                        id_pre,
                                        lat_cto,
                                        long_cto,
                                        op1distanciacto
                                    HAVING COUNT(*) > 1
                                ) b
                                WHERE
                                    a.id_pre = b.id_pre
                                    AND a.lat_cto = b.lat_cto
                                    AND a.long_cto = b.long_cto
                                    AND a.op1distanciacto = b.op1distanciacto
                                    AND a.ctid <> b.ctid_keep;");

        
        return response()->json([ 
            'success' => true, 
            'data' => 'Proceso NODO ejecutado correctamente.',
            'eliminados' => 'Limpieza duplicados NODO' 
        ]); 
        } catch (\Exception $e) { 
            return response()->json([ 
                'success' => false, 
                'mensaje' => $e->getMessage() 
                ], 500);
        
        }
    }

    public function consultazcmasivo(Request $request){

        

        

        try{

        $cantzc = $request->validate([
            'cantzc' => 'required|integer|min:1|max:100'
        ])['cantzc'];

        $data = DB::connection('conexion_osp')
        ->statement("INSERT INTO respuesta (
                        id_pre,
                        anio,
                        mes,
                        estadovb,
                        tipo,
                        nit,
                        ds,
                        cliente,
                        proyecto,
                        departamento,
                        ciudad,
                        direccion,
                        complemento,
                        nombre_edifi,
                        zona,
                        latitud,
                        longitud,
                        tipo_servicio,
                        pb,
                        ancho_banda,
                        op1_coinversor,
                        op1_central,
                        op1olt,
                        op1feeder,
                        id_cto1,
                        op1cto,
                        op1distanciacto,
                        op1dipscto,
                        op2_coinversor,
                        op2_central,
                        op2feeder,
                        id_cto2,
                        op2cto,
                        op2distanciacto,
                        oc2dipscto,
                        fecha_solicitud,
                        lat_cto,
                        long_cto,
                        grupo_cto
                    )
                    SELECT 
                        p.id_pre AS id_proyecto,
                        EXTRACT(YEAR FROM CURRENT_DATE),
                        EXTRACT(MONTH FROM CURRENT_DATE),
                        NULL AS estadovb,
                        NULL AS tipo,
                        NULL AS nit,
                        p.ds,
                        p.nombre_cli,
                        P.proyecto,
                        P.departamento,
                        p.ciudad,
                        p.direccion,
                        p.complemento,
                        p.nombre_edifi,
                        null as zona,
                        p.latitud AS lat_proyecto,
                        p.longitud AS lon_proyecto,
                        p.producto as tipo_servicio,
                        p.tipo_enlace as pb,
                        p.ancho_banda,
                        o.proveedor AS op1_coinversor,
                        NULL AS op1_central,
                        o.olt_no AS op1olt,
                        CONCAT('CA', o.cable) AS op1feeder,
                        o.idplaca AS id_cto1,
                        o.cto AS cto_osp,
                        ST_Distance(p.geom, o.geom)::numeric(10,2) AS distancia_metros,
                        o.puertos_libres_cto as puertos_libres,
                        '' AS op2_coinversor,
                        '' AS op2_central,
                        '' AS op2feeder,
                        '' AS id_cto2,
                        '' AS op2cto,
                        '' AS op2distanciacto,
                        '' AS oc2dipscto,
                        CURRENT_DATE AS fecha_solicitud,
                        o.lat_equipo AS lat_osp,
                        o.long_equipo AS lon_osp,
                        'ZC'
                    FROM proyecto p
                    JOIN LATERAL (
                        SELECT *
                        FROM (
                            SELECT 
                                o.*,
                                ROW_NUMBER() OVER (
                                    PARTITION BY o.cto 
                                    ORDER BY p.geom <-> o.geom
                                ) as rn
                            FROM osp_3gys o
                            WHERE 
                                o.grupo_cto  <> 'Zona Abierta'
                                AND ST_DWithin(p.geom::geography, o.geom::geography, 50)
                                and o.puertos_libres_cto > 1
                                and p.respuesta is null
                        ) t
                        WHERE rn = 1   -- solo la más cercana por cada CTO
                        ORDER BY p.geom <-> t.geom
                        LIMIT ?        -- ahora sí: 2 CTO diferentes
                    ) o ON TRUE", [$cantzc]);


        return response()->json([ 
            'success' => true, 
            'data' => 'Proceso ZC ejecutado correctamente.',
            
        ]); 
        } catch (\Exception $e) { 
            return response()->json([ 
                'success' => false, 
                'mensaje' => $e->getMessage() 
                ], 500);
        
        }
    }

   
    public function exportarRespuestaCsv(Request $request)
    {
        
        
        $request->validate([ 'cargaarchivo' => 'required|string' ]); // Nombre que viene desde el input 
        
        $nombre = pathinfo( 
                $request->input('cargaarchivo'), 
                PATHINFO_FILENAME ); 
                $nombreArchivo = $nombre . '_R_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $nombreArchivo . '"',
        ];

        $callback = function () {

            $archivo = fopen('php://output', 'w');

            // BOM para que Excel reconozca UTF-8 correctamente
            fprintf($archivo, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Encabezados
            $resultado = DB::connection('conexion_osp')
                ->select('SELECT * FROM respuesta LIMIT 0');

            if (!empty($resultado)) {
                fputcsv($archivo, array_keys((array) $resultado[0]), ';');
            } else {
                // Si la tabla está vacía, puedes colocar aquí
                // los nombres de las columnas manualmente.
                fputcsv($archivo, [
                    'wdt_id',
                    'id_pre',
                    'anio',
                    'mes',
                    'estadovb',
                    'tipo',
                    'nit',
                    'ds',
                    'cliente',
                    'proyecto',
                    'departamento',
                    'ciudad',
                    'direccion',
                    'complemento',
                    'nombre_edifi',
                    'zona',
                    'latitud',
                    'longitud',
                    'tipo_servicio',
                    'pb',
                    'ancho_banda',
                    'op1_coinversor',
                    'op1_central',
                    'op1olt',
                    'op1feeder',
                    'id_cto1',
                    'op1cto',
                    'op1distanciacto',
                    'op1dipscto',
                    'op2_coinversor',
                    'op2_central',
                    'op2feeder',
                    'id_cto2',
                    'op2cto',
                    'op2distanciacto',
                    'oc2dipscto',
                    'fecha_solicitud',
                    'lat_cto',
                    'long_cto',
                    'grupo_cto',

                ], ';');
            }

            // Datos
            $filas = DB::connection('conexion_osp')
                ->cursor('SELECT * FROM respuesta');

            foreach ($filas as $fila) {
                fputcsv($archivo, (array) $fila, ';');
            }

            fclose($archivo);
        };

        return response()->stream($callback, 200, $headers);
    }
   
}
