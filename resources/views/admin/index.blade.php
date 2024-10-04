@extends('layouts.admin')
@section('content')
    <div class="p-6 pt-20">
        <style>
            #loaderadmin {
                width: 60px;
                height: 10px;
                border-radius: 5px;
                background: linear-gradient(to right, #4a90e2, #4a90e2 50%, #ffffff 50%, #ffffff);
                background-size: 200% 100%;
                animation: slide 2.5s infinite linear;
                position: absolute;
            }

            @keyframes slide {
                0% {
                    background-position: 0 0;
                }

                100% {
                    background-position: 100% 0;
                }
            }

            @keyframes fadeOut {
                0% {
                    opacity: 1;
                }

                100% {
                    opacity: 0;
                }
            }

            @keyframes slideDown {
                0% {
                    transform: translateY(0);
                }

                100% {
                    transform: translateY(50px);
                    /* Ajusta la distancia del deslizamiento según sea necesario */
                }
            }

            #contain-loader {
                background: rgba(255, 255, 255, 0.8);
                position: fixed;
                /* Asegúrate de que el contenedor esté posicionado correctamente */
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 50;
                animation: fadeOut 1.5s forwards 5s, slideDown 1.5s forwards 5s;
                /* Agrega un retraso de 5 segundos para las animaciones de desvanecimiento y deslizamiento */
            }
        </style>


        <script>
            document.addEventListener("DOMContentLoaded", () => {
                showLoaderAdmin();
            });

            function showLoaderAdmin() {
                const loaderElement = document.querySelector("#contain-loader");

                if (loaderElement) {
                    loaderElement.style.display = "flex"; // Mostrar el loader
                }

                // Ocultar el loader después de 10 segundos
                setTimeout(() => {
                    hideLoaderAdmin();
                }, 10000); // 10000 ms = 10 segundos
            }

            function hideLoaderAdmin() {
                const loaderElement = document.querySelector("#contain-loader");

                if (loaderElement) {
                    loaderElement.style.animation = "fadeOut 1.5s forwards, slideDown 1.5s forwards";
                    setTimeout(() => {
                        loaderElement.style.display = "none"; // Ocultar el loader después del desvanecimiento
                    }, 1500); // 1500 ms = duración de la animación de desvanecimiento y deslizamiento
                }
            }
        </script>


        <div id="contain-loader"
            class="fixed h-screen bg-transparent backdrop-blur-md inset-0 flex items-center justify-center z-50">
            <div id="loaderadmin" class="w-16 h-16 border-4 border-t-4">
                <div class="absolute text-center text-gray-800 font-semibold text-lg">
                    <h2 class="text-xl font-thin text-gray-800">Hola, <span
                            class="uppercase font-extrabold font-blinker">{{ $user->name }}</span> 👋🏻</h2>
                </div>
            </div>
        </div>


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
                <div class="grid grid-cols-2 lg:grid-cols-4 p-1 justify-center">
                    <div class="col-span-2 ml-2 mb-3">
                        <div class="text-sm font-bold bg-black/20 p-1 w-8/12 px-5 rounded-lg text-white uppercase">
                            <i class="ri-calendar-2-line"></i> {{ $formattedDate }}
                        </div>

                        <div class="justify-center">
                            <h2 class="text-[#FFF1F1] font-encode font-bold text-2xl leading-8  italic">Bienvenido
                            </h2>
                            <h3 class="text-white uppercase mt-0 font-blinker font-bold font-lg text-semibold leading-6">
                                <span class="font-blinker">
                                    {{ $user->name }}
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div
                        class="bg-black/20 text-3xl flex justify-center items-center shadow-xl font-bold italic rounded-lg mr-3 lg:mb-3">
                        <span class="leading-loose text-white">{{ $currentTime }}</span>
                    </div>
                    <div>
                        <div>
                            @isset($errorMessage)
                                <div class="text-sm font-medium text-red-600">{{ $errorMessage }}</div>
                            @else
                                <div class="bg-black/20 rounded-lg ">
                                    <div class="w-full justify-center font-bold leading-loose text-xl">
                                        <p class="text-[#FFF1F1] italic font-blinker">
                                            <span class="text-3xl">
                                                {{ $emoji }}
                                            </span>
                                            {{ $temperature }}°C
                                        </p>
                                        <p class="text-white">
                                            <span class="font-black mt-1 text-lg px-2 capitalize italic rounded ">
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

            <div
                class="bg-white row-span-2 w-full lg:row-span-3 rounded-xl border border-gray-000 p-6 shadow-md shadow-black/5">
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
                <div class="p-2 bg-white rounded-xl">
                    <p class="font-blinker block font-medium text-md text-center p-4">
                        <span class="font-bold text-4xl">
                            {{ $pendingOrdersCount }} <span>🛒</span>
                        </span>
                        <br>
                        Pedidos Nuevos
                    </p>
                    <a class="text-blue-500  w-full flex justify-center border-t-2 mt-2 items-center text-center text-sm"
                        href={{ route('admin.orders.index') }}>
                        <p class="mt-2"> Ver todos
                        </p>
                    </a>
                </div>
                <div class="p-2 bg-white rounded-xl">
                    <p class="font-blinker font-medium text-md text-center p-4">
                        <span class="font-bold text-4xl">
                            {{ $totalStock }}
                        </span>
                        <br>
                        Productos con Stock
                    </p>
                    <a class="text-blue-500  w-full flex justify-center border-t-2 mt-2 items-center text-center text-sm"
                        href={{ route('admin.stock.index') }}>
                        <p class="mt-2"> Ver todos
                        </p>
                    </a>
                </div>
                <div class="p-2 bg-white rounded-xl">
                    <p class="font-blinker font-medium text-md text-center p-4">
                        <span class="font-bold text-4xl">
                            {{ $deliveredOrdersCount }} <span>📦</span>
                        </span>
                        <br>
                        Pedidos Entregados
                    </p>
                    <a class="text-blue-500  w-full flex justify-center border-t-2 mt-2 items-center text-center text-sm"
                        href={{ route('admin.ventas.index') }}>
                        <p class="mt-2"> Ver todos
                        </p>
                    </a>
                </div>
                <a href="/admin/ventas">
                    <div class="p-2 bg-white rounded-xl ">
                        <p class="font-blinker font-medium text-md text-center p-4">
                            <span class="font-bold text-2xl text-green-700">
                                ${{ number_format($totalGanancias, 2) }}
                            </span>
                            <br>
                            Ganancias Generadas
                            <br>
                            <span class="text-sm text-gray-300"> Ultimos 30 dias</span>
                        </p>
                    </div>
                </a>
            </div>

            <!-- Sección de Pedidos Pendientes -->
            <div
                class="p-6 col-span-2 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-white w-full shadow-xl rounded-xl mt-6">
                <div class="max-w-2xl mx-auto">
                    <!-- Header de la sección -->
                    <div class="flex justify-between w-full mb-6 items-center">
                        <h2 class="font-josefin font-bold italic text-3xl text-gray-800">
                            Pedidos
                        </h2>

                        <a href="{{ route('admin.orders.index') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                            Ver Todos los Pedidos
                        </a>
                    </div>

                    <!-- Contenido con altura fija y scroll -->
                    <div
                        class="w-full mx-auto px-12 md:px-6 h-96 overflow-y-auto border-t border-gray-200 divide-y divide-gray-200">
                        @if ($pendingOrders->isEmpty())
                            <p class="text-center text-gray-500 py-10">No hay pedidos pendientes.</p>
                        @else
                            <ul>
                                @foreach ($pendingOrders as $order)
                                    <!-- Pedido individual -->
                                    <li class="relative pl-8 sm:pl-32 py-16 group hover:bg-gray-50 transition duration-300">
                                        <!-- Etiqueta con el número del pedido -->
                                        <div class="font-medium text-indigo-500 mb-1 sm:mb-0">
                                            Pedido #{{ $order->id }} - Corrientes, Capital
                                        </div>

                                        <!-- Línea vertical y marcador de posición -->
                                        <div
                                            class="flex flex-col sm:flex-row items-start mb-1 group-last:before:hidden relative">
                                            {{-- <div
                                                class="absolute left-2 sm:left-0 before:h-full before:bg-gray-300 sm:before:left-28 before:absolute before:px-px before:-translate-x-1/2 before:translate-y-3">
                                                <div
                                                    class="after:absolute after:left-2 sm:after:left-28 after:w-2 after:h-2 after:bg-indigo-600 after:border-4 after:border-white after:rounded-full after:-translate-x-1/2 after:translate-y-1.5">
                                                </div>
                                            </div> --}}

                                            <!-- Fechas del pedido -->
                                            <div class="flex flex-col items-start mb-3 sm:mb-0">
                                                <time
                                                    class="inline-flex items-center justify-center text-xs font-semibold uppercase w-24 h-6 text-emerald-600 bg-emerald-100 rounded-full">{{ $order->created_at->format('d-m-Y') }}</time>
                                                <time
                                                    class="mt-2 inline-flex items-center justify-center text-xs font-semibold uppercase w-24 h-6 text-gray-600 bg-gray-100 rounded-full">{{ $order->created_at->format('H:i') }}</time>
                                            </div>

                                            <!-- Detalles del pedido -->
                                            <div class="text-xl font-bold text-slate-900 mt-2 sm:mt-0 ml-4">
                                                ${{ $order->total }} -
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                    class="text-blue-600 hover:underline">
                                                    Ver detalles →
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Información del usuario -->
                                        <div class="text-slate-500 mt-2 flex">
                                            <span class="mr-2">{{ $order->user->name }}</span> -
                                            <span class="ml-2">{{ $order->user->email }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    @vite('resources/js/app.js')
@endsection
