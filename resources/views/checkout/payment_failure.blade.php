<div class="p-6 bg-red-100 text-red-800 rounded-lg shadow-lg">
    <div class="flex items-center">
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6m0 0v3m0-3V3m0 3h3m-3 0H9"></path>
        </svg>
        <p class="font-semibold text-xl">¡Error en el pago!</p>
    </div>
    <div class="mt-4">
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
        <p><strong>Método de Pago:</strong> {{ ucfirst($payment->payment_method->type) }} - {{ ucfirst($payment->payment_method->id) }}</p>

        <!-- Monto -->
        <p><strong>Monto:</strong> ${{ number_format($payment->transaction_amount / 100, 2) }}</p>

        <!-- Fechas -->
        <p><strong>Fecha de Creación:</strong> {{ \Carbon\Carbon::parse($payment->date_created)->format('d/m/Y H:i') }}</p>
        <p><strong>Fecha de Última Actualización:</strong> {{ \Carbon\Carbon::parse($payment->date_last_updated)->format('d/m/Y H:i') }}</p>

        <!-- Información del pagador -->
        @if($payment->payer->id)
            <p><strong>ID del Pagador:</strong> {{ $payment->payer->id }}</p>
        @endif
        @if($payment->payer->phone->number)
            <p><strong>Teléfono del Pagador:</strong> {{ $payment->payer->phone->number }}</p>
        @endif

        <!-- Información de la tarjeta -->
        <p><strong>Últimos 4 dígitos de la tarjeta:</strong> {{ $payment->card->last_four_digits }}</p>

        <!-- Información de cuotas -->
        @if($payment->transaction_details->installment_amount)
            <p><strong>Cantidad de Cuotas:</strong> {{ $payment->installments }}</p>
            <p><strong>Monto por Cuota:</strong> ${{ number_format($payment->transaction_details->installment_amount / 100, 2) }}</p>
        @endif

        <!-- Moneda -->
        <p><strong>Moneda:</strong> {{ $payment->currency_id }}</p>

        <!-- Tipo de tarjeta -->
        <p><strong>Tipo de Tarjeta:</strong> {{ ucfirst($payment->payment_method->type) }}</p>

        <!-- Procesador de pago -->
        <p><strong>Procesador de Pago:</strong> {{ ucfirst($payment->transaction_details->payment_method_reference_id ?? 'No disponible') }}</p>

        <!-- Estado de liberación de dinero -->
        <p><strong>Estado de Liberación de Dinero:</strong>
            @if($payment->money_release_status)
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
