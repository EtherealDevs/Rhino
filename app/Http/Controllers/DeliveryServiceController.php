<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OcaService;
use Illuminate\Support\Facades\Http;

class DeliveryServiceController extends Controller
{

    // Método para obtener tarifas desde la API
    public static function obtenerTarifas($params)
    {
        $response = Http::get("http://webservice.oca.com.ar/ePak_Tracking_TEST/Oep_TrackEPak.asmx/Tarifar_Envio_Corporativo", [
            'cuit'    => '30-53625919-4',
            'Operativa' =>  $params['operativa'],
            'PesoTotal'   => $params['peso'],
            'VolumenTotal'=> $params['volumen'],
            'CodigoPostalOrigen' => $params['cP'],
            'CodigoPostalDestino'=> $params['cPDes'],
            'CantidadPaquetes'=> $params['cantidad'],
            'ValorDeclarado'=> $params['valor'],
            // otros parámetros según la API
        ]);

        if ($response->successful()) {
                    // Obtener el cuerpo de la respuesta como una cadena
            $body = $response->body();

            // Usar una expresión regular para extraer el precio
            if (preg_match('/Precio="([^"]+)"/', $body, $matches)) {
                $precio = $matches[1]; // El precio está en el primer grupo de captura
                return $precio;
            }

            return response()->json(['error' => 'Precio no encontrado'], 404);
        }

        return $response->throw();
    }

    public static function obtenerSucursales($cp){
        $response = Http::get("http://webservice.oca.com.ar/epak_tracking/Oep_TrackEPak.asmx/GetCentrosImposicionConServiciosByCP", [
            'CodigoPostal' => $cp,
        ]);

        if($response->successful()){
            $body = $response->body();
            $sucursales = simplexml_load_string($body);
            $sucursales = json_encode($sucursales, JSON_FORCE_OBJECT);
            $sucursales = json_decode($sucursales, true);

            return $sucursales;
        }
        return $response->throw();

    }
}
