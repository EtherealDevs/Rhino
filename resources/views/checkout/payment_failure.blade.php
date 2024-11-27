@extends('layouts.app')
@section('content')
    <div
        class="flex flex-col items-center justify-center w-full h-screen space-y-8 p-6 bg-gray-100">
        <div class="w-full lg:w-1/2 text-center">
            <p class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-red-500">Pago Rechazado</p>
        </div>
        <div class="w-full lg:w-2/3 xl:w-1/2 p-6 bg-white shadow-xl rounded-xl">
            <!-- Aquí empieza la información del pago -->
            <div class="p-6 bg-red-50 border-l-4 border-red-400 text-red-700 rounded-md">
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
                                El pago fue rechazado debido a un alto riesgo. Por favor, intente con otro método de pago.
                            @break

                            @case('cc_rejected_insufficient_amount')
                                El pago fue rechazado debido a fondos insuficientes. Verifique su saldo y vuelva a intentar.
                            @break

                            @case('cc_rejected')
                                El pago fue rechazado. Intente con otro método de pago.
                            @break

                            @default
                                Detalle desconocido
                        @endswitch
                    </p>

                    <!-- Método de pago -->
                    <p><strong>Método de Pago:</strong> {{ ucfirst(__($payment->payment_method->type)) }} -
                        {{ ucfirst($payment->payment_method->id) }}</p>

                    <!-- Monto -->
                    <p><strong>Monto:</strong> ${{ number_format($payment->transaction_amount / 100, 2, ',', '.') }}</p>

                    <!-- Fechas -->
                    <p><strong>Fecha de Creación:</strong>
                        {{ \Carbon\Carbon::parse($payment->date_created)->format('d/m/Y H:i') }}</p>
                    <p><strong>Fecha de Última Actualización:</strong>
                        {{ \Carbon\Carbon::parse($payment->date_last_updated)->format('d/m/Y H:i') }}</p>

                    <!-- Información del pagador -->
                    @if ($payment->payer->id)
                        <p><strong>ID del Pagador:</strong> {{ $payment->payer->id }}</p>
                    @endif
                    @if ($payment->payer->phone->number)
                        <p><strong>Teléfono del Pagador:</strong> {{ $payment->payer->phone->number }}</p>
                    @endif

                    <!-- Información de la tarjeta -->
                    <p><strong>Últimos 4 dígitos de la tarjeta:</strong> {{ $payment->card->last_four_digits }}</p>

                    <!-- Información de cuotas -->
                    @if ($payment->transaction_details->installment_amount)
                        <p><strong>Cantidad de Cuotas:</strong> {{ $payment->installments }}</p>
                        <p><strong>Monto por Cuota:</strong> ${{ number_format($payment->transaction_details->installment_amount / 100, 2, ',', '.') }}</p>
                    @endif

                    <!-- Moneda -->
                    <p><strong>Moneda:</strong> {{ $payment->currency_id }}</p>

                    <!-- Tipo de tarjeta -->
                    <p><strong>Tipo de Tarjeta:</strong> {{ ucfirst(__($payment->payment_method->type)) }}</p>

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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Volver a Inicio</span>
                </a>
            </div>
            <!-- Fin de la información del pago -->
        </div>
    </div>
@endsection
