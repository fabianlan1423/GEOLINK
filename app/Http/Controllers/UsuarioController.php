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

    public function datoaconsultar(Request $request){
        DB::connection('conexion_osp')
        ->table('punto_sencillo')
        ->insert([
        'id_pre'=>$request->id_pre,
        'latitud'=> $request->latitud,
        'longitud'=> $request->longitud,
        'direccion'=> $request->direccion,
        'ciudad'=> $request->localidad


        ]);
         return response()->json([
            'mensaje' => 'Cordenadas agregadas a tabla'
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

            session([
                'usuario' => $usuario->nombre
            ]);
            
            return response()->json([
                'existe' => true
            ]);
        
        }else{
            return response()->json([
                'existe' => false
            ]);
        }

        
    }

    public function logout(Request $request){
            session()->forget('usuario');

            session()->invalidate();

            session()->regenerateToken();

            return response()->json([
                'success' => true
            ]);
        }

    public function consultalocalidades(Request $request){

        $localidades = DB::connection('conexion_osp')
            ->table('osp_3gys')
            ->select('localidad')
            ->distinct()
            ->get();

        return view('geolink', compact('localidades'));

       
    }
    public function lipiezatbpuntosencillo(Request $request){

        DB::connection('conexion_osp')
            ->statement('TRUNCATE table punto_sencillo');

        return response()->json([

            'mensaje' => 'Limpieza tabla punto sencillo exitosa'
        ]);
        

       
    }
    public function creaciongeom(Request $request){

        DB::connection('conexion_osp')
            ->statement('UPDATE punto_sencillo SET geom = ST_SetSRID(ST_MakePoint(longitud, latitud), 4326);');

        return response()->json([

            'mensaje' => 'Creacion de datos en GEOM'
        ]);
        

       
    }
    public function consultapordireccion(Request $request){

        $data = DB::connection('conexion_osp')
            ->select("SELECT 
	                CONCAT(c.latitud,' , ',c.longitud) as coordenadas,
                    c.direccion,
                    b.proveedor AS op1_coinversor,
                    b.olt_no AS op1olt,
                    b.proveedor AS op1feeder,
                    b.idplaca AS id_cto1,
                    b.cto AS op1cto,
                    b.direccion_cli,
                    '0' AS op1distanciacto,
                    b.puertos_libres_cto AS op1dipscto,
                    0 as lat_cto,
                    0 as long_cto,
                    '' as grupo_cto
                FROM osp_3gys AS b
                JOIN punto_sencillo AS c
                    ON b.localidad = c.ciudad
                WHERE REPLACE(b.direccion_cli,' ','') = REPLACE(c.direccion,' ','')
                LIMIT 1;");

        return response()->json([
            'data' => $data 
            
        ]);
        

       
    }
    
   
     public function consultadireccion(Request $request){
        $valor = $request->valor;
        
        $data = DB::connection('conexion_osp')
            ->select("select cto, localidad, direccion_cli
                        from osp_3gys
                        where cto like ?
                        group by direccion_cli, localidad, cto
                    ", ["%{$valor}%"]);

        return response()->json([
            'data' => $data 
            
        ]);
        

       
    }

    public function consultazatigo(Request $request){
        $data = DB::connection('conexion_osp')
        ->select("SELECT 
                    p.latitud,
                    p.longitud,
                    p.direccion,
                    o.olt_id as olt,
                    o.armario_id AS armario,
                    o.nap_id AS id_nap,
                    o.tipo_nap AS Tipo_Nap,
                    o.direccion AS direccion_punto,
                    o.estadohilo AS estado_hilo,
                    O.central,
                    ST_Distance(p.geom::geography, o.geom::geography)::numeric(10,2) AS op1distanciacto,
                    --o.puertos_libres_cto AS op1dipscto,
                    --o.lat_equipo as lat_cto,
                    --o.long_equipo as long_cto,
                    CONCAT(o.latitud,',',o.longitud) as coordenadas,
                    CONCAT(o.longitud,',',o.latitud,',',o.nap_id) as coorde,
                    'ZA-FENIX' as grupo
                FROM punto_sencillo p
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
                            ST_DWithin(p.geom::geography, o.geom::geography, 600)
                            and o.estadohilo > 1
                            and o.tipo_nap <> 'INTERNO'
                            AND p.respuesta IS NULL
                    ) t
                    WHERE rn = 1   -- solo la más cercana por cada CTO
                    ORDER BY p.geom <-> t.geom
                    LIMIT 5        -- ahora sí: 2 CTO diferentes
                ) o ON TRUE
                ORDER BY op1distanciacto;");

                return response()->json([
                    'data'=>$data
                ]);

    }

    public function consultaza(Request $request){

        $data = DB::connection('conexion_osp')
        ->select("SELECT 
                            p.latitud,
                            p.longitud,
                            p.direccion,
                            o.proveedor AS op1_coinversor,
                            o.olt_no AS op1olt,
                            o.proveedor AS op1feeder,
                            o.idplaca AS id_cto1,
                            o.cto AS op1cto,
                            O.direccion_cli,
                            ST_Distance(p.geom::geography, o.geom::geography)::numeric(10,2) AS op1distanciacto,
                            o.puertos_libres_cto AS op1dipscto,
                            o.lat_equipo as lat_cto,
                            o.long_equipo as long_cto,
                            CONCAT(o.lat_equipo,' , ',o.long_equipo) as coordenadas,
						    CONCAT(o.long_equipo,',',o.lat_equipo,',',o.cto) as coorde,
                            'ZA' as grupo
                        FROM punto_sencillo p
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
                                    ST_DWithin(p.geom::geography, o.geom::geography, 600)
                                    AND o.grupo_cto LIKE '%Abierta%'
                                    AND o.puertos_libres_cto > 1
                                    AND p.respuesta IS NULL
                                    AND o.cto NOT LIKE '%PC%'
                            ) t
                            WHERE rn = 1   -- solo la más cercana por cada CTO
                            ORDER BY p.geom <-> t.geom
                            LIMIT 2        -- ahora sí: 2 CTO diferentes
                        ) o ON TRUE
                        ORDER BY op1distanciacto;");
        
        return response()->json([
            'data'=>$data
        ]);
        

    }
    public function consultazc(Request $request){

        $data = DB::connection('conexion_osp')
        ->select("SELECT 
                        p.latitud,
                        p.longitud,
						p.direccion,
						o.proveedor AS op1_coinversor,
						o.olt_no AS op1olt,
						o.proveedor AS op1feeder,
						o.idplaca AS id_cto1,
						o.cto AS op1cto,
                        O.direccion_cli,
						ST_Distance(p.geom, o.geom)::numeric(10,2) AS op1distanciacto,
						o.puertos_libres_cto AS op1dipscto,
						CONCAT(o.lat_equipo,' , ',o.long_equipo) as coordenadas,
						CONCAT(o.long_equipo,',',o.lat_equipo,',',o.cto) as coorde,
						'ZC' as grupo
                    FROM punto_sencillo p
                    JOIN LATERAL (
                      
                            SELECT o.*
                            FROM osp_3gys o
                            WHERE 
                                ST_DWithin(p.geom, o.geom, 50)
                                and o.grupo_cto  <> 'Zona Abierta'
                                and O.puertos_libres_cto > 1
                                and p.respuesta is null
                            ORDER BY p.geom <-> o.geom       -- orden por distancia entre coordenadas
                            LIMIT 1                         -- limite de datos analizar
                       
                    ) o ON TRUE order by op1distanciacto;");
        
        return response()->json([
            'data'=>$data
        ]);
        

    }
    public function consultaemp(Request $request){

        $data = DB::connection('conexion_osp')
        ->select("SELECT 
                            p.latitud,
                            p.longitud,
                            p.direccion,
                            o.coordenada_x,
                            o.coordenada_y,
                            o.terminal_fibra_optica_id AS idemp,
                            o.terminal_fibra_optica_codigo AS empalme,
                            ST_Distance(p.geom, o.geom)::numeric(10,2) AS distancia,
                            o.propietario AS feeder,
                            '-' AS puertos,
                            '-' AS op1_coinversor,
                            CONCAT(o.coordenada_x,',',o.coordenada_y) as coordenadas, -- COORDENDADA_X = LONGITUD COORDENDADA_Y = LATITUD
                            CONCAT(o.coordenada_y,',',o.coordenada_x,',',o.terminal_fibra_optica_codigo) as coorde,
                            'EMP' AS consultaemp
                        FROM punto_sencillo p
                        JOIN LATERAL (
                        SELECT *
                        FROM (
                            SELECT 
                                o.*,
                                ROW_NUMBER() OVER (
                                    PARTITION BY o.terminal_fibra_optica_codigo
                                    ORDER BY p.geom <-> o.geom
                                ) as rn
                            FROM emp_v2 o
                            WHERE 
                                ST_DWithin(p.geom::geography, o.geom::geography, 1000)
                                AND o.punto_acceso_tipo_punto_acceso LIKE '%Cámara%'
                        ) t
                        WHERE rn = 1   -- solo la más cercana por cada CTO
                        ORDER BY p.geom <-> t.geom
                        LIMIT 4        -- ahora sí: 2 CTO diferentes
                    ) o ON TRUE;");
        
        return response()->json([
            'data'=>$data
        ]);
        

    }

    public function consultanodo(){

        $data = DB::connection('conexion_osp')
        ->select("SELECT 
                            p.latitud,
                            p.longitud,
                            p.direccion,
                            o.lat,
                            o.lon,
                            o.hl,
                            o.ip,
                            o.modelo,
                            o.anillo,
                            o.nombre_equipo AS nombre_equipo,
                            ST_Distance(p.geom, o.geom)::numeric(10,2) AS distancianodo,
                            o.marca AS marca,
                            '-' AS puertos,
                            '-' AS op1_coinversor,
                            CONCAT(o.lat,',',o.lon) as coordenadas,
                            CONCAT(o.lon,',',o.lat,',',o.modelo) as coorde,
                            'NODO' as consulta
                        FROM punto_sencillo p
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
                                ST_DWithin(p.geom::geography, o.geom::geography, 600)
                                and p.respuesta is null
                                AND (
								    o.nota_2 IS NULL
								    OR o.nota_2 <> 'APAGADO RED UNICA'
								)
                        ) t
                        WHERE rn = 1   -- solo la más cercana por cada CTO
                        ORDER BY p.geom <-> t.geom
                        LIMIT 4        -- ahora sí: 2 CTO diferentes
                    ) o ON TRUE");

        return response() -> json([
            'data'=>$data
        ]);

       


    }
   

}
