@extends('layouts.app')

@section('content')
    <section>
        <div class="relative isolate px-6 pt-14 lg:px-8">
            <!-- Fondo superior optimizado -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                <div class="relative left-1/2 aspect-[1155/678] w-144 -translate-x-1/2 rotate-30 bg-gradient-to-tr from-gray-800 to-black opacity-30 sm:left-1/2 sm:w-288"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>

            <div class="text-black font-sans antialiased py-8">
                <div class="container mx-auto flex flex-col items-start md:flex-row my-12 md:my-24">
                    <!-- Sección de bienvenida optimizada -->
                    <div class="flex flex-col w-full lg:w-1/3 mt-2 md:mt-12 px-8">
                        <div class="text-center">
                            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Bienvenidos a RINO Indumentaria</h1>
                            <p class="mt-6 text-lg leading-8 text-gray-600">
                                Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.
                            </p>
                        </div>
                    </div>

                    <!-- Línea de tiempo optimizada -->
                    <div class="ml-0 md:ml-12 lg:w-2/3">
                        <div class="relative wrap overflow-hidden p-10 h-full">
                            <!-- Líneas verticales simplificadas -->
                            <div class="absolute h-full border-2 border-black left-1/2 transform -translate-x-1/2 rounded-md"></div>

                            <!-- Eventos de la línea de tiempo -->
                            @php
                                $events = [
                                    [
                                        'date' => '1-6 May, 2018',
                                        'title' => 'Apertura',
                                        'description' => 'Pick your favourite event(s) and register in that event by filling the form corresponding to that event. It\'s that easy :)',
                                        'side' => 'right'
                                    ],
                                    [
                                        'date' => '6-9 May, 2021',
                                        'title' => 'Inicio de expansión',
                                        'description' => 'Participate online. The links for your registered events will be sent to you via email and WhatsApp groups. Use those links and show your talent.',
                                        'side' => 'left'
                                    ],
                                    [
                                        'date' => '10 May, 2021',
                                        'title' => 'Adquisición de nuevas herramientas',
                                        'description' => 'The ultimate genius will be revealed by our judging panel on 10th May, 2021 and the results will be announced on the WhatsApp groups and will be mailed to you.',
                                        'side' => 'right'
                                    ],
                                    [
                                        'date' => '12 May, 2021',
                                        'title' => 'Continua la expansión',
                                        'description' => 'The winners will be contacted by our team for their addresses and the winning goodies will be sent to their addresses.',
                                        'side' => 'left'
                                    ],
                                ];
                            @endphp

                            @foreach($events as $event)
                                <div class="mb-8 flex justify-between items-center w-full {{ $event['side'] === 'right' ? 'flex-row-reverse' : '' }}">
                                    <div class="w-5/12"></div>
                                    <div class="w-5/12 px-1 py-4 text-{{ $event['side'] === 'right' ? 'right' : 'left' }}">
                                        <p class="mb-3 text-base text-black">{{ $event['date'] }}</p>
                                        <h4 class="mb-3 font-bold text-lg md:text-2xl">{{ $event['title'] }}</h4>
                                        <p class="text-sm md:text-base leading-snug text-black text-opacity-100">
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
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
                <div class="relative left-1/2 aspect-[1155/678] w-144 -translate-x-1/2 bg-gradient-to-tr from-gray-600 to-indigo-900 opacity-30 sm:left-1/2 sm:w-288"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>
    </section>
@endsection
