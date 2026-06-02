<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RutaController extends Controller
{
    public function ruta(Request $request)
    {
        try {

            $coordinates = $request->input('coordinates');

            if (!$coordinates || count($coordinates) < 2) {

                return response()->json([
                    'error' => 'Coordenadas inválidas'
                ], 400);

            }

           
    
            $response = Http::withoutVerifying()
            ->timeout(30)
            ->withHeaders([
                'Authorization' => 'eyJvcmciOiI1YjNjZTM1OTc4NTExMTAwMDFjZjYyNDgiLCJpZCI6Ijg0ZDdiZmZlYjBhZDQ2MjI5YmU4ZTE4Mzc1YWIxMDA3IiwiaCI6Im11cm11cjY0In0=',
                'Accept' => 'application/json, application/geo+json',
                'Content-Type' => 'application/json'
            ])
            ->post('https://api.openrouteservice.org/v2/directions/foot-walking/geojson', [
                'coordinates' => $coordinates
            ]);



            return response()->json(
                $response->json(),
                $response->status()
            );

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);

        }
    }
}



