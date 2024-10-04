<?php

namespace App\Http\Controllers;

use App\Http\Validators\AddressValidator;
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

    /**
     * Obtiene las sucursales de OCA que tienen el servicio de entrega de paquetes para un código postal dado.
     *
     * @param string|int $cp Código postal para el cual se buscarán las sucursales.
     * @return array|Illuminate\Http\Client\Response Un array con las sucursales que tienen el servicio de entrega,
     * o una respuesta de excepción en caso de error.
     */
    public static function obtenerSucursales($cp){
        $addressValidator = new AddressValidator();
        $cp = $addressValidator->validateZipCode($cp);
        $cp = (int) $cp;
        $response = Http::get("http://webservice.oca.com.ar/epak_tracking/Oep_TrackEPak.asmx/GetCentrosImposicionConServiciosByCP", [
            'CodigoPostal' => $cp,
        ]);

        if($response->successful()){
            // $body = $response->body();
            // $sucursales = simplexml_load_string($body);
            // $sucursales = json_encode($sucursales, JSON_FORCE_OBJECT);
            // $sucursales = json_decode($sucursales, true);

            // return $sucursales;
            $body = $response->body();
            $sucursales = simplexml_load_string($body);
            $sucursales = json_decode(json_encode($sucursales), true);

            // Filtramos las sucursales que tengan el servicio "Entrega de paquetes"
            $sucursalesEntrega = collect($sucursales['Centro'])->filter(function($sucursal) {
                if (isset($sucursal['Servicios']['Servicio'])) {
                    $servicios = $sucursal['Servicios']['Servicio'];

                    // Si solo hay un servicio, convertirlo en array para evitar errores
                    if (!is_array($servicios)) {
                        $servicios = [$servicios];
                    }

                    // Recorremos los servicios y verificamos si hay "Entrega de paquetes"
                    foreach ($servicios as $servicio) {
                        if (isset($servicio['ServicioDesc']) && $servicio['ServicioDesc'] === "Entrega de paquetes") {
                            return true;
                        }
                    }
                }
                return false;
            });

            return $sucursalesEntrega->values();
        }
        return $response->throw();
    }
}
