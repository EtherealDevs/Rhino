@extends('layouts.app')

@section('content')
    <section>
        <div class="relative isolate px-2 pt-16 lg:px-8">
            <!-- Fondo superior optimizado -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-1/2 aspect-[1155/678] w-144 -translate-x-1/2 rotate-30 bg-gradient-to-tr from-gray-800 to-black opacity-30 sm:left-1/2 sm:w-288"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>

            <div class="text-black font-sans antialiased">
                <div class="container mx-auto flex flex-col items-start md:flex-row my-12 md:my-24">
                    <!-- Sección de bienvenida optimizada -->
                    <div class="flex flex-col w-full lg:w-2/3 md:mt-12 mt-12 px-16 sticky top-0 relative overflow-hidden">
                        <!-- Div de la imagen con efecto pintura -->
                        <div class="relative text-center py-8 mt-12 z-10">
                            <h1 class="text-3xl lg:text-6xl font-extrabold tracking-tight text-gray-900 sm:text-2xl">
                                Nuestra Historia
                            </h1>
                            <p class="mt-8 text-xl leading-9 text-gray-700">
                                Desde nuestros humildes comienzos hasta convertirnos en una referencia de estilo y calidad.
                                Acompáñanos en este viaje de pasión, esfuerzo y crecimiento, donde cada prenda cuenta una
                                historia y cada cliente es parte de nuestra familia.
                            </p>
                        </div>
                        <!-- component -->
                        <div class="flex justify-center items-center">
                            <div class="w-full px-1">
                                <div class="grid grid-cols-6 gap-2">
                                    <!-- Imagen 1 -->
                                    <div class="overflow-hidden rounded-2xl col-span-4">
                                        <img class="w-full object-cover h-[150px] lg:h-[320px]" src="img/about/jufacu3.webp" alt="">
                                    </div>
                                    <!-- Imagen 2 -->
                                    <div class="overflow-hidden rounded-2xl col-span-2">
                                        <img class="w-full object-cover h-[150px] lg:h-[320px]" src="img/about/jufacu.webp" alt="">
                                    </div>
                                    <!-- Imagen 3 -->
                                    <div class="overflow-hidden rounded-2xl col-span-2">
                                        <img class="h-[150px] lg:h-[220px] w-full object-cover" src="img/about/jufacu2.webp" alt="">
                                    </div>
                                    <!-- Imagen 4 -->
                                    <div class="overflow-hidden rounded-2xl col-span-2">
                                        <img class="h-[150px] lg:h-[220px] w-full object-cover" src="img/about/rino.webp" alt="">
                                    </div>
                                    <!-- Imagen 5 -->
                                    <div class="relative py-12 overflow-hidden rounded-2xl col-span-2 max-h-[28rem]">
                                        <div
                                            class="text-white text-2xl absolute inset-0 h-[150px] lg:h-[220px] bg-black/60 flex justify-center items-center">
                                            <a href="https://www.instagram.com/rino.indumentaria/" class="hover:underline">
                                                <p class="font-josefin leading text-lg px-6">¡¡Seguinos en Instagram!!</p>
                                            </a>
                                        </div>
                                        <img class="h-[150px] lg:h-[220px] w-full object-cover" src="img/about/rino1.webp" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Línea de tiempo optimizada -->
                    <div class="ml-0 md:ml-12 lg:w-2/3 backdrop-blur-3xl lg:backdrop-blur-none">
                        <div class="relative wrap overflow-hidden p-10 h-full">
                            <!-- Líneas verticales simplificadas -->
                            <div
                                class="absolute h-full border-2 border-black left-1/2 transform -translate-x-1/2 rounded-md">
                            </div>

                            <!-- Eventos de la línea de tiempo -->
                            @php
                                $events = [
                                    [
                                        'date' => '1-6 May, 2018',
                                        'title' => 'El Comienzo de un Sueño 🌟',
                                        'description' =>
                                            '¡Hola a todos! 👋 ¿Listos para descubrir cómo comenzó nuestra emocionante travesía en el universo de la moda? Hace diez años, con una pequeña bebé y solo un año de convivencia, mi pareja y yo decidimos dar el primer paso en este hermoso camino. Nuestra misión siempre ha sido clara: proveer ropa de calidad y estilo para que cada persona se sienta cómoda y segura en su propia piel. :)',
                                        'side' => 'right',
                                    ],
                                    [
                                        'date' => '6-9 May, 2021',
                                        'title' => 'El Primer Paso 👣',
                                        'description' =>
                                            'Iniciamos nuestro viaje con recursos limitados, ofreciendo prendas en concesión y una mezcla de estilos. Con cada cliente que atendíamos, crecimos en experiencia y pasión, comprendiendo la importancia de ofrecer moda contemporánea y tendencias actuales que resonaran con la esencia de quienes somos.',
                                        'side' => 'left',
                                    ],
                                    [
                                        'date' => '10 May, 2021',
                                        'title' => 'Evolución y Crecimiento 🚀',
                                        'description' =>
                                            'La demanda de nuestros clientes fue un gran impulso que nos llevó a enfocarnos en Rino, nuestra línea de moda urbana masculina. Con una actitud de lucha, seguridad y perseverancia, comenzamos a crear piezas que no solo visten, sino que empoderan. "Conócete a ti mismo y vencerás" se convirtió en nuestro mantra.',
                                        'side' => 'right',
                                    ],
                                    [
                                        'date' => '12 May, 2021',
                                        'title' => 'Reconocimiento y Comunidad 💪👥',
                                        'description' =>
                                            'Hoy, somos reconocidos y queridos en nuestra ciudad y en los alrededores. La satisfacción de nuestros clientes nos motiva a seguir creciendo. Nuestro objetivo es expandir nuestro alcance y llevar nuestras prendas a cada rincón del país, convirtiéndonos en una referencia de estilo y calidad en el mundo de la moda.',
                                        'side' => 'left',
                                    ],
                                    [
                                        'date' => '12 May, 2021',
                                        'title' => 'Compromiso con Nuestros Clientes 🤝❤️',
                                        'description' =>
                                            'Esperamos que su experiencia con nosotros sea siempre positiva y que podamos superar sus expectativas en cada compra. Estamos aquí para brindarles lo mejor, porque su confianza y satisfacción son nuestra mayor recompensa. ¡Gracias por ser parte de nuestra historia! 🫂',
                                        'side' => 'right',
                                    ],
                                ];
                            @endphp

                            @foreach ($events as $event)
                                <div
                                    class="mb-8 flex justify-between items-center w-full {{ $event['side'] === 'right' ? 'flex-row-reverse' : '' }}">
                                    <div class="w-5/12"></div>
                                    <div class="w-5/12 px-1 py-4 text-{{ $event['side'] === 'right' ? 'right' : 'left' }}">
                                        <p class="mb-3 text-sm md:text-base text-black">{{ $event['date'] }}</p>
                                        <h4 class="mb-3 font-bold text-lg md:text-2xl">{{ $event['title'] }}</h4>
                                        <p class="text-md md:text-base leading text-black text-opacity-100">
                                            {{ $event['description'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <section>
                    <div class="relative px-2 py-6 pt-12 sm:px-6 lg:px-8 bg-blue-600 rounded-3xl">
                        <!-- Sección de publicaciones de Instagram -->
                       {{--  <div class="mb-16">
                            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">Últimas publicaciones de
                                Instagram</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                                <!-- Placeholder de publicaciones dinámicas -->
                                <div
                                    class="overflow-hidden rounded-lg shadow-lg bg-white hover:scale-105 transition-transform">
                                    <img src="/path-to-placeholder-image.jpg" alt="Instagram post"
                                        class="w-full h-60 object-cover">
                                    <div class="p-4">
                                        <p class="text-gray-700 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit.</p>
                                        <a href="#" target="_blank"
                                            class="text-blue-600 hover:underline mt-3 block text-sm">Ver en Instagram</a>
                                    </div>
                                </div>
                                <!-- Más publicaciones pueden ser añadidas aquí -->
                            </div>
                        </div> --}}

                        <!-- Sección de capturas de mensajes -->
                        <div class="">
                            <h2 class="text-3xl font-extrabold text-white text-center mb-12">Mensajes de Clientes
                                Satisfechos</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-2">
                                <!-- Mensaje individual -->
                                <div
                                    class="overflow-hidden rounded-xl shadow-lg bg-white hover:scale-105 transition-transform">
                                    <img src="img/about/recomend1.webp" alt="Mensaje de cliente"
                                        class="w-full h-[500px] object-cover">
                                    <div class="p-4">
                                        <p class="text-gray-700 font-josefin font-bold text-sm">"Me probe y me quedo de diez. Gracias por las calcos"</p>
                                        <span class="text-gray-500 text-xs block mt-2"></span>
                                    </div>
                                </div>
                                <div
                                    class="overflow-hidden rounded-xl shadow-lg bg-white hover:scale-105 transition-transform">
                                    <img src="img/about/recomend2.webp" alt="Mensaje de cliente"
                                        class="w-full h-[500px] object-cover">
                                    <div class="p-4">
                                        <p class="text-gray-700 font-josefin font-bold text-sm">"Premio del sorteo de los mejores"</p>
                                        <span class="text-gray-500 text-xs block mt-2">— Adrian</span>
                                    </div>
                                </div>
                                <div
                                    class="overflow-hidden rounded-xl shadow-lg bg-white hover:scale-105 transition-transform">
                                    <img src="img/about/recomend3.webp" alt="Mensaje de cliente"
                                        class="w-full h-[500px] object-cover">
                                    <div class="p-4">
                                        <p class="text-gray-700 font-josefin font-bold text-sm">"La mejor ropa y atencion siempre..."</p>
                                        <span class="text-gray-500 text-xs block mt-2">— Alejandro</span>
                                    </div>
                                </div>
                                <div
                                    class="overflow-hidden rounded-xl shadow-lg bg-white hover:scale-105 transition-transform">
                                    <img src="img/about/recomend4.webp" alt="Mensaje de cliente"
                                        class="w-full h-[500px] object-cover">
                                    <div class="p-4">
                                        <p class="text-gray-700 font-josefin font-bold text-sm">"Estan espectaculares, de lujo..."</p>
                                        {{-- <span class="text-gray-500 text-xs block mt-2">— John Doe</span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            <!-- Fondo inferior optimizado -->
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-1/2 aspect-[1155/678] w-144 -translate-x-1/2 bg-gradient-to-tr from-gray-600 to-indigo-900 opacity-30 sm:left-1/2 sm:w-288"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>
    </section>
@endsection
