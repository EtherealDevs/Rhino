@extends('layouts.app')

@section('content')
    <section>
        <div class="relative isolate px-6 pt-16 lg:px-8">
            <!-- Fondo superior optimizado -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-1/2 aspect-[1155/678] w-144 -translate-x-1/2 rotate-30 bg-gradient-to-tr from-gray-800 to-black opacity-30 sm:left-1/2 sm:w-288"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>

            <div class="text-black font-sans antialiased py-4">
                <div class="container mx-auto flex flex-col items-start md:flex-row my-12 md:my-24">
                    <!-- Sección de bienvenida optimizada -->
                    <div class="flex flex-col w-full lg:w-2/3 mt-4 md:mt-16 px-16 sticky top-0 relative overflow-hidden">
                        <!-- Div de la imagen con efecto pintura -->
                        <div class="relative text-center py-8 mt-32 z-10">
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
                            <div class="w-full mx-8 space-y-8 p-16">
                                <div class="grid grid-cols-6 gap-6">
                                    <!-- Imagen 1 -->
                                    <div class="overflow-hidden rounded-xl col-span-3 max-h-[28rem]">
                                        <img class="h-full w-full object-contain" src="img/about.jpg" alt="">
                                    </div>
                                    <!-- Imagen 2 -->
                                    <div class="overflow-hidden rounded-xl col-span-3 max-h-[28rem]">
                                        <img class="h-full w-full object-cover"
                                            src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1399&q=80"
                                            alt="">
                                    </div>
                                    <!-- Imagen 3 -->
                                    <div class="overflow-hidden rounded-xl col-span-2 max-h-[20rem]">
                                        <img class="h-full w-full object-cover"
                                            src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                                            alt="">
                                    </div>
                                    <!-- Imagen 4 -->
                                    <div class="overflow-hidden rounded-xl col-span-2 max-h-[20rem]">
                                        <img class="h-full w-full object-cover"
                                            src="https://images.unsplash.com/photo-1503602642458-232111445657?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                                            alt="">
                                    </div>
                                    <!-- Imagen 5 -->
                                    <div class="relative overflow-hidden rounded-xl col-span-2 max-h-[20rem]">
                                        <div
                                            class="text-white text-2xl absolute inset-0 bg-slate-900/80 flex justify-center items-center">
                                            <a href="#">
                                                <p>Ver más</p>
                                            </a>
                                        </div>
                                        <img class="h-full w-full object-cover"
                                            src="https://images.unsplash.com/photo-1560393464-5c69a73c5770?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=765&q=80"
                                            alt="">
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
                                        <p class="text-xs md:text-base leading-snug text-black text-opacity-100">
                                            {{ $event['description'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
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
