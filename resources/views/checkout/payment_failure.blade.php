<div class="p-6 bg-red-100 text-red-800 rounded-lg shadow-lg">
    <div class="flex items-center">
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6m0 0v3m0-3V3m0 3h3m-3 0H9"></path>
        </svg>
        <p class="font-semibold text-xl">¡Error en el pago!</p>
    </div>
    <div class="mt-4">
        <p><strong>Estado:</strong> {{ $paymentJson->status }}</p>
        <p><strong>Detalle:</strong> {{ $paymentJson->status_detail }}</p>
        <p><strong>Método de Pago:</strong> {{ ucfirst($paymentJson->payment_method->type) }} - {{ ucfirst($paymentJson->payment_method->id) }}</p>
        <p><strong>Monto:</strong> ${{ number_format($paymentJson->transaction_amount / 100, 2) }}</p>

        @if($paymentJson->status_detail == 'cc_rejected_high_risk')
            <p><em>El pago fue rechazado debido a un alto riesgo. Por favor, intente con otro método de pago.</em></p>
        @endif

        <p><strong>Fecha de Creación:</strong> {{ \Carbon\Carbon::parse($paymentJson->date_created)->format('d/m/Y H:i') }}</p>
        <p><strong>Fecha de Última Actualización:</strong> {{ \Carbon\Carbon::parse($paymentJson->date_last_updated)->format('d/m/Y H:i') }}</p>

        @if($paymentJson->payer->id)
            <p><strong>ID del Pagador:</strong> {{ $paymentJson->payer->id }}</p>
        @endif

        @if($paymentJson->payer->phone->number)
            <p><strong>Teléfono del Pagador:</strong> {{ $paymentJson->payer->phone->number }}</p>
        @endif

        <p><strong>Últimos 4 dígitos de la tarjeta:</strong> {{ $paymentJson->card->last_four_digits }}</p>

        @if($paymentJson->transaction_details->installment_amount)
            <p><strong>Cantidad de Cuotas:</strong> {{ $paymentJson->installments }}</p>
            <p><strong>Monto por Cuota:</strong> ${{ number_format($paymentJson->transaction_details->installment_amount / 100, 2) }}</p>
        @endif

        <p><strong>Moneda:</strong> {{ $paymentJson->currency_id }}</p>
        <p><strong>Tipo de Tarjeta:</strong> {{ ucfirst($paymentJson->payment_method->type) }}</p>
        <p><strong>Procesador de Pago:</strong> {{ ucfirst($paymentJson->transaction_details->payment_method_reference_id ?? 'N/A') }}</p>

        <p><strong>Estado de Liberación de Dinero:</strong> {{ $paymentJson->money_release_status ?? 'Pendiente' }}</p>
    </div>
</div>
