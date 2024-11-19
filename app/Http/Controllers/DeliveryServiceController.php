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
        // OLD (http://webservice.oca.com.ar/ePak_Tracking_TEST/Oep_TrackEPak.asmx/Tarifar_Envio_Corporativo)
        // NEW (http://webservice.oca.com.ar/ePak_tracking/Oep_TrackEPak.asmx/Tarifar_Envio_Corporativo)
        $response = Http::get("http://webservice.oca.com.ar/ePak_tracking/Oep_TrackEPak.asmx/Tarifar_Envio_Corporativo", [
            'cuit'    => '20-33625064-2',
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

    public function track($sendNum)
    {
        // URL de la API de OCA
        $url = "http://webservice.oca.com.ar/epak_tracking/Oep_TrackEPak.asmx/Tracking_Pieza_ConIdEstado";

        // Realizar la solicitud GET a la API
        $response = Http::get($url, [
            'NumeroEnvio' => $sendNum,
        ]);


        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            // Obtener el contenido de la respuesta XML
            $xmlContent = $response->body();

            // Eliminar los namespaces del XML usando expresiones regulares
            $xmlContent = preg_replace('/\s+xmlns[^=]*="[^"]*"/i', '', $xmlContent);

            // Eliminar todos los prefijos de las etiquetas (ejemplo: msdata:, xs:, diffgr:)
            $xmlContent = preg_replace('/(<\/?)(\w+):([^>]+)/', '$1$3', $xmlContent);

            // Eliminar atributos específicos que causan errores (como msdata:IsDataSet)
            $xmlContent = preg_replace('/\s+msdata:[^=]+="[^"]*"/i', '', $xmlContent);

            // Eliminar atributos específicos que causan errores (como msdata:IsDataSet, diffgr:id, etc.)
            $xmlContent = preg_replace('/\s+(msdata|diffgr):[^=]+="[^"]*"/i', '', $xmlContent);


            // Cargar el XML en un objeto SimpleXMLElement
            $xml = simplexml_load_string($xmlContent, "SimpleXMLElement", LIBXML_NOCDATA);

            // Verificar si la carga del XML fue exitosa
            if ($xml === false) {
                return response()->json(['error' => 'Error al procesar el XML'], 500);
            }

            // Convertir el objeto XML a JSON para manejarlo más fácilmente
            $json = json_encode($xml);
            $array = json_decode($json, true);


            // Acceder a los datos específicos dentro del array
            if (isset($array['diffgram']['NewDataSet']['Table'])) {
                $trackingDetails = $array['diffgram']['NewDataSet']['Table'];
                return $trackingDetails;
            } else {
                return response()->json(['message' => 'No se encontraron datos de seguimiento para este número de envío.']);
            }
        } else {
            // En caso de que la solicitud a la API falle
            return response()->json(['error' => 'Error en la solicitud a la API de OCA'], $response->status());
        }
    }

}
