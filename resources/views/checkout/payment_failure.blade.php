@extends('layouts.paid')
@section('content')
    <section>
        <div class="relative h-full isolate px-6 lg:px-8">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-2xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#be4c4c] to-[#ff0000] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
            <div class=" text-black font-sans antialiased py-8">
                <div class="container mx-auto flex flex-col items-center ">
                    <div class="flex-shrink-0 flex">
                        <img class="justify-center xl:ml-2 lg:ml-2 lg:px-8 xl:w-48 2xl:w-48 lg:w-48 w-24 mt-12"
                            src="/img/rino-black.png" alt="Your Company">
                    </div>
                    <div class="overflow-y-auto sm:p-0 pt-4 pr-4 pb-20 pl-4 ">
                        <div class="flex justify-center items-end text-center min-h-screen sm:block">
                            <div class="bg-gray-500 transition-opacity bg-opacity-75"></div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">​</span>
                            <div
                                class= "inline-block text-left bg-slate-50 rounded-lg overflow-hidden align-bottom transition-all transform shadow-2xl sm:my-8 sm:align-middle sm:max-w-xl sm:w-full">
                                <div class="items-center w-full mr-auto ml-auto relative max-w-7xl md:px-12 lg:px-24">
                                    <div class="grid grid-cols-1">
                                        <div class="mt-4 mr-auto mb-4 ml-auto  max-w-lg">
                                            <div class="flex flex-col items-center pt-6 pr-6 pb-6 pl-6">
                                                <div class="relative inline-block">
                                                    <img src="https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;w=500"
                                                        class="flex-shrink-0 object-cover object-center w-16 h-16 border border-red-500 rounded-full shadow-xl">
                                                    <span
                                                        class="absolute bottom-0 right-0 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center">
                                                        <!-- Ícono de "X" -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M10 8.586l3.707-3.707a1 1 0 00-1.414-1.414L10 6.172 6.707 2.879a1 1 0 10-1.414 1.414L8.586 10l-3.707 3.707a1 1 0 001.414 1.414L10 11.414l3.707 3.707a1 1 0 001.414-1.414L11.414 10l3.707-3.707a1 1 0 00-1.414-1.414L10 8.586z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <p
                                                    class="mt-8 text-2xl font-semibold leading-none text-slate-950 tracking-tighter lg:text-3xl">
                                                    El pago fue exitoso</p>
                                                <div class="w-full lg:w-2/3 xl:w-1/2 p-6 bg-white shadow-xl rounded-xl">
                                                    <!-- Aquí empieza la información del pago -->
                                                    <div
                                                        class="p-6 bg-red-50 border-l-4 border-red-400 text-red-700 rounded-md">
                                                        <div class="flex items-center mb-4">
                                                            <p class="font-bold text-xl">¡Error en el pago!</p>
                                                        </div>
                                                        <div class="space-y-2">
                                                            <!-- Estado -->
                                                            <p><strong>Estado del Pago:</strong>
                                                                @switch($payment->status)
                                                                    @case('rejected')
                                                                        Pago rechazado
                                                                    @break

                                                                    @case('approved')
                                                                        Pago aprobado
                                                                    @break

                                                                    @case('pending')
                                                                        Pago pendiente de confirmación
                                                                    @break

                                                                    @default
                                                                        Estado desconocido
                                                                @endswitch
                                                            </p>

                                                            <!-- Detalle del estado -->
                                                            <p><strong>Detalle:</strong>
                                                                @switch($payment->status_detail)
                                                                    @case('cc_rejected_high_risk')
                                                                        El pago fue rechazado debido a un alto riesgo. Por favor,
                                                                        intente con otro método de pago.
                                                                    @break

                                                                    @case('cc_rejected_insufficient_amount')
                                                                        El pago fue rechazado debido a fondos insuficientes.
                                                                        Verifique su saldo y vuelva a intentar.
                                                                    @break

                                                                    @case('cc_rejected')
                                                                        El pago fue rechazado. Intente con otro método de pago.
                                                                    @break

                                                                    @default
                                                                        Detalle desconocido
                                                                @endswitch
                                                            </p>

                                                            <!-- Método de pago -->
                                                            <p><strong>Método de Pago:</strong>
                                                                {{ ucfirst(__($payment->payment_method->type)) }} -
                                                                {{ ucfirst($payment->payment_method->id) }}</p>

                                                            <!-- Monto -->
                                                            <p><strong>Monto:</strong>
                                                                ${{ number_format($payment->transaction_amount / 100, 2, ',', '.') }}
                                                            </p>

                                                            <!-- Fechas -->
                                                            <p><strong>Fecha de Creación:</strong>
                                                                {{ \Carbon\Carbon::parse($payment->date_created)->format('d/m/Y H:i') }}
                                                            </p>
                                                            <p><strong>Fecha de Última Actualización:</strong>
                                                                {{ \Carbon\Carbon::parse($payment->date_last_updated)->format('d/m/Y H:i') }}
                                                            </p>

                                                            <!-- Información del pagador -->
                                                            @if ($payment->payer->id)
                                                                <p><strong>ID del Pagador:</strong>
                                                                    {{ $payment->payer->id }}</p>
                                                            @endif
                                                            @if ($payment->payer->phone->number)
                                                                <p><strong>Teléfono del Pagador:</strong>
                                                                    {{ $payment->payer->phone->number }}</p>
                                                            @endif

                                                            <!-- Información de la tarjeta -->
                                                            <p><strong>Últimos 4 dígitos de la tarjeta:</strong>
                                                                {{ $payment->card->last_four_digits }}</p>

                                                            <!-- Información de cuotas -->
                                                            @if ($payment->transaction_details->installment_amount)
                                                                <p><strong>Cantidad de Cuotas:</strong>
                                                                    {{ $payment->installments }}</p>
                                                                <p><strong>Monto por Cuota:</strong>
                                                                    ${{ $payment->transaction_details->installment_amount }}
                                                                </p>
                                                            @endif

                                                            <!-- Moneda -->
                                                            <p><strong>Moneda:</strong> {{ $payment->currency_id }}</p>

                                                            <!-- Tipo de tarjeta -->
                                                            <p><strong>Tipo de Tarjeta:</strong>
                                                                {{ ucfirst(__($payment->payment_method->type)) }}</p>

                                                            <!-- Procesador de pago -->
                                                            <p><strong>Procesador de Pago:</strong>
                                                                {{ ucfirst($payment->transaction_details->payment_method_reference_id ?? 'No disponible') }}
                                                            </p>

                                                            <!-- Estado de liberación de dinero -->
                                                            <p><strong>Estado de Liberación de Dinero:</strong>
                                                                @if ($payment->money_release_status)
                                                                    @switch($payment->money_release_status)
                                                                        @case('pending')
                                                                            Dinero aún en proceso de liberación.
                                                                        @break

                                                                        @case('released')
                                                                            El dinero ya fue liberado.
                                                                        @break

                                                                        @default
                                                                            Estado desconocido
                                                                    @endswitch
                                                                @else
                                                                    En espera de confirmación.
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-6 text-center">
                                                        <a href="/"
                                                            class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-150">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span>Volver a Inicio</span>
                                                        </a>
                                                    </div>
                                                    <!-- Fin de la información del pago -->
                                                </div>
                                                <div class="w-full mt-6">
                                                    <a href="{{ url('/') }}"
                                                        class="flex text-center items-center justify-center w-full pt-4 pr-10 pb-4 pl-10 text-base
                                                        font-medium text-white bg-indigo-600 rounded-xl transition duration-500 ease-in-out transform hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Seguir
                                                        comprando</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="https://wa.me/c/5493794316606">
                        <button class="p-2 px-2 bg-green-500 text-black rounded-2xl flex items-center space-x-2">
                            <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                    fill="#FFFFFF" />
                            </svg>
                            <p class="font-bold text-white">Ver Catalogo de Whatsapp</p>
                        </button>
                    </a>

                </div>
            </div>
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr  from-[#be4c4c] to-[#ff0000] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>
    </section>
@endsection
