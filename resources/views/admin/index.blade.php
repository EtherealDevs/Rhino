@extends('layouts.admin')
@section('content')
    <div class="p-6 pt-20">
        <!-- Carrousel -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


        <style>
            #map {
                height: 100%;
                width: 100%;
                z-index: 50;
            }
        </style>

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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div class="bg-white col-span-2 rounded-xl border-t-4 border-blue-700 p-8 shadow-md shadow-black/5">
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

                <div class="grid grid-cols-2 justify-between ">
                    <div class="justify-start">

                        <h2 class="text-gray-900 font-encode font-bold text-2xl leading-8 my-1">Bienvenido </h2>
                        <h3 class="text-gray-600 font-lg text-semibold leading-6"></h3>
                        <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">Descripcion</p>
                        <div>
                            @isset($errorMessage)
                                <div class="text-sm font-medium text-red-600">{{ $errorMessage }}</div>
                            @else
                                <div class=" mt-6">
                                    <div class="text-md font-medium text-gray-600">
                                        Clima actual en <span class="font-bold">{{ $city }}</span>
                                    </div>
                                    <div class="font-bold leading-loose text-xl mt-3">
                                        <span class=" bg-slate-800 text-gray-400 p-2 rounded-lg">{{ $temperature }}°C</span>
                                        <br>
                                        <span
                                            class="font-bold bg-blue-600 py-1 px-2 uppercase rounded text-white">{{ $description }}
                                            {{ $emoji }}</span>
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>

                    <div class="justify-end">
                        <div class="my-1 text-2xl font-bold text-gray-700 uppercase">
                            {{ $formattedDate }}
                            <span class="leading-loose bg-slate-800 text-gray-400 p-2 rounded-lg">{{ $currentTime }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-000 p-6 shadow-md shadow-black/5">
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


                <!-- component -->
                <style>
                    #journal-scroll::-webkit-scrollbar {
                        width: 4px;
                        cursor: pointer;

                    }

                    #journal-scroll::-webkit-scrollbar-track {
                        background-color: rgba(229, 231, 235, var(--bg-opacity));
                        cursor: pointer;
                    }

                    #journal-scroll::-webkit-scrollbar-thumb {
                        cursor: pointer;
                        background-color: #a0aec0;
                    }
                </style>

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
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <div class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-white w-full shadow-lg rounded-xl">
                <div class="max-w-2xl mx-auto">

                    <h2 class="font-encode font-bold text-xl mb-3">Pedidos</h2>


                    <p class="mt-5">Deslizar para ver todos los Remitos Adeudados
                        <a class="text-blue-600 hover:underline" href="/remitos" target="_blank">Ir a seccion
                            Remitos</a>.
                    </p>
                    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                </div>
            </div>

            <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-xl lg:col-span-1">
                <div class="flex justify-between mb-4 items-start">
                    <h2 class="font-encode font-bold text-xl">Mi Tienda en el Mapa</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                    <div id="map">
                    </div>
                </div>
                <div>
                    <canvas id="order-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
    @vite('resources/js/app.js')
    {{-- <script>
        let client = {!! json_encode($client, JSON_HEX_TAG) !!}
        Echo.private('App.Models.User.' + client.id)
            .notification((notification) => {
                document.getElementById('notif-amount').innerHTML = notifAmount;
                addNotificationToModalBody(notification);
            });
    </script> --}}
    {{-- <script>
        let icon = L.icon({
            iconUrl: 'img/location.png',
            iconSize: [43, 55], // size of the icon
        });

        let map = L.map('map', {
                scrollWheelZoom: false
            })
            .setView([-27.4758916, -58.8192536], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 200,
        }).addTo(map);

        let points = {!! json_encode($points) !!};
        for (let i in points) {
            let marker = L.marker([points[i].latitude, points[i].longitude], {
                    icon: icon
                })
                .addTo(map)

                .bindPopup(points[i].name + "<br>Horarios: " + points[i].schedule + "<br>Direccion: " + points[i].direction)
                .openPopup()
        }

        function expandTheContainerMap() {
            const container = document.getElementById("mapConteiner");
            container.classList.add("h-full");
            container.classList.add("w-full");

            const map = document.getElementById("map");
            map.style.width = "173vh";
            map.style.height = "100vh";
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(success, error);
            } else {
                alert("No podemos acceder la localizacion");
            }

            let options = {
                enableHighAccuracy: true,
                timeout: 1000,
                maximumAge: 0,
            };

            function success(geolocationPosition) {
                let coords = geolocationPosition.coords;
                let icon = L.icon({
                    iconUrl: 'img/locationuser.svg',
                    iconSize: [43, 48], // size of the icon
                });
                let marker = L.marker([coords.latitude, coords.longitude], {
                    icon: icon
                }).addTo(map);
            }

            function error(err) {
                document.getElementById("alert-2").classList.remove("hidden");
                document.getElementById("alert-2").classList.add("flex");
                document.getElementById("info").innerHTML = err.message;
            }
        }
    </script> --}}
@endsection
