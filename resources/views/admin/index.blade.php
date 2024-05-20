@extends('layouts.admin')
@section('content')
    <div class="p-6 pt-20">
        <!-- Carrousel -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <script>
            document.addEventListener("alpine:init", () => {
                Alpine.data("imageSlider", () => ({
                    currentIndex: 1,
                    images: [
                        "https://unsplash.it/640/425?image=30",
                        "https://unsplash.it/640/425?image=40",
                        "https://unsplash.it/640/425?image=50",
                    ],
                    previous() {
                        if (this.currentIndex > 1) {
                            this.currentIndex = this.currentIndex - 1;
                        }
                    },
                    forward() {
                        if (this.currentIndex < this.images.length) {
                            this.currentIndex = this.currentIndex + 1;
                        }
                    },
                }));
            });
        </script>

        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 grid-rows-2 gap-x-6 row-span-1">
            <div
                class="bg-gradient-to-r from-[#2F3467] to-[#7D86DD] bg-r  col-span-2 h-5/6 rounded-xl border-t-4 border-purple-300 p-4 mb-2 shadow-md shadow-black/5">
                <?php
                use Carbon\Carbon;
                
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                
                // Obtenemos la fecha actual en Buenos Aires
                $now = Carbon::now('America/Argentina/Buenos_Aires');
                
                // Formateamos la fecha para mostrar "hoy es martes 16 de agosto"
                setlocale(LC_TIME, 'es_ES'); // Establecer el idioma local a español
                $formattedDate = $now->translatedFormat('l j \de F'); // "l" para el día de la semana, "j" para el día, "F" para el mes
                
                // Obtenemos la hora actual
                $currentTime = $now->format('H:i'); // Formato hora:minuto:segundo
                
                // Obtener el pronóstico del clima actual usando OpenWeatherMap API
                $apiKey = '4eb017fd3584fc1e33ce24ef2f3dad38'; // Reemplaza 'TU_API_KEY' con tu propia API key de OpenWeatherMap
                $city = 'Corrientes';
                
                // Codificar el nombre de la ciudad para evitar problemas con caracteres especiales
                $encodedCity = urlencode($city);
                
                // Construir la URL de la solicitud
                $url = "https://api.openweathermap.org/data/2.5/weather?q={$encodedCity}&units=metric&appid={$apiKey}";
                
                // Realizar la solicitud HTTP para obtener los datos del clima
                $response = file_get_contents($url);
                
                // Decodificar la respuesta JSON
                $weatherData = json_decode($response);
                
                // Verificar si se recibió una respuesta válida
                if ($weatherData && isset($weatherData->main, $weatherData->weather)) {
                    // Extraer los datos del clima
                    $temperature = $weatherData->main->temp;
                    $description = strtolower($weatherData->weather[0]->description); // Convertir descripción a minúsculas
                
                    // Asignar emoji según la descripción del clima en inglés
                    $emoji = '';
                
                    if (strpos($description, 'clear') !== false || strpos($description, 'sunny') !== false) {
                        $emoji = '☀️'; // Soleado o claro
                    } elseif (strpos($description, 'rain') !== false || strpos($description, 'shower') !== false) {
                        $emoji = '🌧️'; // Lluvia o chubascos
                    } elseif (strpos($description, 'cloud') !== false || strpos($description, 'overcast') !== false) {
                        $emoji = '☁️'; // Nublado
                    } elseif (strpos($description, 'storm') !== false || strpos($description, 'thunderstorm') !== false) {
                        $emoji = '⛈️'; // Tormenta
                    }
                } else {
                    $errorMessage = 'No se pudo obtener la información del clima en este momento.';
                
                    if ($response) {
                        $errorMessage .= " Respuesta de la API: {$response}";
                    }
                }
                ?>

                {{-- HEADER --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 justify-center">
                    <div class="col-span-2 ml-3 mb-3">
                        <div class="my-1 text-md font-bold text-white uppercase">
                            caa {{ $formattedDate }}
                        </div>

                        <div class="justify-center">
                            <h2 class="text-[#FFF1F1] font-encode font-bold text-2xl leading-8  italic">Bienvenido
                            </h2>
                            <h3 class="text-white uppercase mt-0 font-lg text-semibold leading-6">
                                <span>
                                    Usuario
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="bg-black/20 p-8 rounded-lg mr-3 lg:mb-3">
                        <span class="leading-loose text-white">{{ $currentTime }}</span>
                    </div>
                    <div>
                        <div>
                            @isset($errorMessage)
                                <div class="text-sm font-medium text-red-600">{{ $errorMessage }}</div>
                            @else
                                <div class="bg-black/20 rounded-lg ">
                                    <div class="w-full justify-center font-bold leading-loose text-2xl">
                                        <p class="text-[#FFF1F1] italic font-blinker">
                                            <span class="text-3xl">
                                                {{ $emoji }}
                                            </span>
                                            {{ $temperature }}°C
                                        </p>
                                        <p class="text-white">
                                            <span class="font-black text-lg px-2 capitalize italic rounded ">
                                                {{ $description }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white row-span-2 w-full lg:row-span-3 rounded-xl border border-gray-000 p-6 shadow-md shadow-black/5">
                <div class="flex justify-between gap-3 pb-2">
                    <div class="justify-start">
                        <h2 class="font-bold text-xl mb-2 font-encode"> <i
                                class='bx bx-bell mr-1 text-xl font-bold'></i>Notificaciones
                        </h2>
                    </div>
                    <div class="justify-end">
                        <button class="bg-blue-700 px-2 p-1 rounded-xl">
                            <a class="text-white text-sm font-bold font-sans" href="/shop">Ver mas</a>
                        </button>
                    </div>
                </div>

                <div class="container mx-auto flex justify-center h-56">
                    <div class="w-full pl-4  h-full flex flex-col">
                        <div class="w-full h-full overflow-auto shadow bg-white" id="journal-scroll">
                            <table class="w-full">
                                <tbody class="">
                                    {{-- @if (count($client->user->notifications) != 0)
                                        @foreach ($client->user->notifications as $notification)
                                            <tr
                                                class="relative transform scale-100 text-xs py-1 border-b-2 border-blue-100 cursor-default bg-blue-500 bg-opacity-25">
                                                <td class="pl-5 pr-3 whitespace-no-wrap">
                                                    <div class="text-gray-400">Today</div>
                                                    <div>07:45</div>
                                                </td>

                                                <td class="px-2 py-2 whitespace-no-wrap">
                                                    <div class="leading-5 text-gray-500 font-medium" id="notifHeader">
                                                        {{ $notification->data['reminder'] }}</div>
                                                    <div class="leading-5 text-gray-900" id="notifBody">Te recordamos que
                                                        tenes una deuda pendiende a un valor de
                                                        ${{ $notification->data['value'] }} pesos
                                                    </div>
                                                    <div class="leading-5 text-gray-800">Vencimiento en:
                                                        {{ $notification->data['days'] }} días</div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr
                                            class="relative transform scale-100 text-xs py-1 border-b-2 border-blue-100 cursor-default bg-blue-500 bg-opacity-25">
                                            <td class="pl-5 pr-3 whitespace-no-wrap">
                                                <div class="text-gray-400">Today</div>
                                                <div>07:45</div>
                                            </td>

                                            <td class="px-2 py-2 whitespace-no-wrap">
                                                <div class="leading-5 text-gray-900" id="notifBody">No hay notificaciones
                                                </div>
                                            </td>

                                        </tr>
                                    @endif --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 md:grid-cols-2 col-span-2 h-5/6 gap-6">
                <div class="p-2 bg-white rounded-xl ">
                    <p class="font-blinker font-medium text-md text-center p-4">
                        <span class="font-bold text-4xl">
                            36
                        </span>
                        <br>
                        Pedidos Nuevos
                    </p>
                </div>
                <div class="p-2 bg-white rounded-xl ">
                    <p class="font-blinker font-medium text-md text-center p-4">
                        <span class="font-bold text-4xl">
                            36
                        </span>
                        <br>
                        Productos con Stock
                    </p>
                </div>
                <div class="p-2 bg-white rounded-xl ">
                    <p class="font-blinker font-medium text-md text-center p-4">
                        <span class="font-bold text-4xl">
                            36
                        </span>
                        <br>
                        Ventas
                    </p>
                </div>
                <div class="p-2 bg-white rounded-xl ">
                    <p class="font-blinker font-medium text-md text-center p-4">
                        <span class="font-bold text-4xl">
                            36
                        </span>
                        <br>
                        Productos Estrella
                    </p>
                </div>
            </div>
            <div
                class="p-6 col-span-2 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-white w-full shadow-lg rounded-xl">
                <div class="max-w-2xl mx-auto">
                    <h2 class="font-encode font-bold text-xl mb-3">Pedidos</h2>
                    <p class="mt-5">Deslizar para ver todos los Remitos Adeudados
                        <a class="text-blue-600 hover:underline" href="/remitos" target="_blank">
                            Ir a seccion
                            Remitos
                        </a>
                    </p>
                    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
@endsection
