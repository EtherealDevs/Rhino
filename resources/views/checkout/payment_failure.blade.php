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
                                class= "inline-block text-left backdrop-blur-lg rounded-lg overflow-hidden align-bottom transition-all transform shadow-lg sm:my-8 sm:align-middle sm:max-w-xl sm:w-full">
                                <div class="items-center w-full mr-auto ml-auto relative max-w-7xl md:px-12 lg:px-6">
                                    <div class="grid grid-cols-1">
                                        <div class="mt-4 mr-auto mb-4 ml-auto  max-w-lg">
                                            <div class="flex flex-col items-center pt-6 pr-6 pb-6 pl-6">
                                                <div class="relative inline-block">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                                                        viewBox="0 0 24 24"
                                                        class="flex-shrink-0 w-16 h-16 p-2 border border-red-500 rounded-full shadow-xl"
                                                        fill="none" stroke="red" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5" color="red">
                                                        <g>
                                                            <path
                                                                d="M3.47 4q-.17.129-.322.282C2 5.446 2 7.32 2 11.066v1.987c0 3.746 0 5.62 1.148 6.783C4.297 21 6.145 21 9.841 21h5.881c2.092 0 3.395 0 4.278-.375M18.865 14.5c.087-.215.135-.452.135-.7c0-.994-.77-1.8-1.719-1.8c-.281 0-.546.07-.78.196" />
                                                            <path
                                                                d="M18 7c0-.93 0-1.395-.102-1.776a3 3 0 0 0-2.121-2.122C15.395 3 14.93 3 14 3h-4c-.946 0-1.773 0-2.5.018M11.243 7H16c2.828 0 4.243 0 5.121.879C22 8.757 22 10.172 22 13v2c0 .996 0 1.816-.038 2.5M2 2l20 20" />
                                                        </g>
                                                    </svg>
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
                                                    El pago fue Rechazado</p>

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
                                                            ${{ $payment->transaction_amount }}
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
                                                <!-- Aquí empieza la información del pago -->

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
                                                    <!-- Fin de la información del pago -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
