@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="container mx-auto mt-14 lg:p-12 p-4 bg-white rounded-lg shadow-lg">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Detalle del Pedido #{{ $order->id }}</h1>

            <div class="grid lg:grid-cols-6 grid-cols-1">

                <div class="col-span-1 lg:col-span-3">
                    <!-- Información del Usuario -->
                    <div class="mb-10 border-b border-blue-gray-50">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Información del Usuario</h2>
                        <p class="text-lg text-gray-600"><strong class="font-medium">Nombre:</strong> {{ $order->user->name }}
                        </p>
                        <p class="text-lg text-gray-600"><strong class="font-medium">Email:</strong>
                            {{ $order->user->email }}</p>
                        <p class="text-lg mb-4 text-gray-600"><strong class="font-medium">Teléfono:</strong>
                            {{ $order->user->phone_number }}
                        </p>
                    </div>

                    <!-- Estado y Método de Pago -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Estado y Método de Pago</h2>
                        <p class="text-lg text-gray-600">
                            <strong class="font-medium">Estado del Pedido:</strong>
                            <span
                                class="inline-flex items-center justify-center text-xs font-semibold uppercase px-2 py-1 rounded-full
                    @if ($order->orderStatus->id == 5) text-red-500 bg-red-100
                    @elseif ($order->orderStatus->id == 1)
                        text-yellow-600 bg-yellow-300
                    @else
                        text-emerald-600 bg-emerald-100 @endif">
                                {{ $order->orderStatus->name }}
                            </span>
                        </p>
                        <p class="text-lg text-gray-600"><strong class="font-medium">Método de Pago:</strong>
                            {{ __($order->paymentMethod->payment_method) }}</p>
                        <p class="text-lg mb-6 text-gray-600"><strong class="font-medium">Fecha de Creación:</strong>
                            {{ $order->created_at->format('d-m-Y H:i') }}</p>
                    </div>


                    <!-- Información de Entrega -->
                    <div class="mb-10 border-b border-blue-gray-50">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Información de Entrega</h2>

                        @if ($order->deliveryService)
                            <div class="mb-6">
                                <div class="flex items-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-600 w-6 h-6 mr-4"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-800">Servicio de Entrega</h3>
                                </div>
                                <p class="text-lg text-gray-600"><strong class="font-medium">Servicio:</strong>
                                    {{ $order->deliveryService->name }}</p>
                                <p class="text-lg text-gray-600"><strong class="font-medium">Costo:</strong>
                                    ${{ number_format($order->delivery_price / 100, 2, ',', '.') }}</p>
                            </div>

                            <div class="p-4">
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="relative">
                                        <select name="order_status_id"
                                            class="form-select mt-1 block w-full mr-10 p-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700">
                                            @foreach ($orderStatuses as $status)
                                                <option value="{{ $status->id }}"
                                                    {{ $status->id == $order->order_status_id ? 'selected' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit"
                                            class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-blue-500 text-white rounded-lg px-3 py-1 text-xs font-semibold shadow hover:bg-blue-600 transition">
                                            Actualizar
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @if ($order->order_status_id == 3)
                                @livewire('admin.shipping-number-form', ['orderId' => $order->id])
                            @endif
                        @endif

                        @if ($order->address)
                            <div class="">
                                <div class="flex items-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-600 w-6 h-6 mr-4"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-800">Dirección de Entrega</h3>
                                </div>
                                <p class="text-lg text-gray-600"><strong class="font-medium">Dirección:</strong>
                                    {{ $order->address->address }}</p>
                                <p class="text-lg text-gray-600"><strong class="font-medium">Calle:</strong>
                                    {{ $order->address->street }}</p>
                                <p class="text-lg text-gray-600"><strong class="font-medium">Número:</strong>
                                    {{ $order->address->number }}</p>
                                <p class="text-lg text-gray-600"><strong class="font-medium">Departamento:</strong>
                                    {{ $order->address->department ?? 'No disponible' }}</p>
                                <p class="text-lg text-gray-600"><strong class="font-medium">Detalles:</strong>
                                    {{ $order->address->observation }}</p>

                                <div class="mt-4">
                                    <p class="text-lg text-gray-600"><strong class="font-medium">Provincia:</strong>
                                        {{ $order->address->province->name }}</p>
                                    @if ($order->address->city != null)
                                        <p class="text-lg text-gray-600"><strong class="font-medium">Ciudad:</strong>
                                            {{ $order->address->city->name }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="col-span-1 lg:col-span-3 w-full">
                    <div class="w-full flex lg:items-start justify-center">
                        <div class="bg-gray-100 text-gray-800 p-6 rounded-lg shadow-lg w-full">

                            <!-- Título principal -->
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Detalles de Mercado Pago</h3>

                            <!-- Información básica del pedido -->
                            <div class="text-gray-600">
                                <p><strong>ID de Pedido:</strong> {{ $mpOrder->id ?? 'No disponible' }}</p>
                                <p><strong>Estado del Pedido:</strong>
                                    <span class="font-semibold">
                                        @switch($mpOrder->status ?? 'unknown')
                                            @case('approved')
                                                Aprobado
                                            @break

                                            @case('rejected')
                                                Rechazado
                                            @break

                                            @case('pending')
                                                Pendiente
                                            @break

                                            @default
                                                Desconocido
                                        @endswitch
                                    </span>
                                </p>
                            </div>
                            {{-- {{ $mpOrderJson }} --}}

                            <!-- Detalle del pago -->
                            <div class="mt-6">
                                <h4 class="text-lg font-medium text-gray-700 mb-2">Detalle del Pago:</h4>
                                <ul class="list-disc pl-6 space-y-2 text-gray-600">
                                    <li><strong>Estado del Pago:</strong> {{ $mpOrder->payment_status ?? 'No disponible' }}
                                    </li>
                                    <li><strong>Detalle:</strong> {{ $mpOrder->status_detail ?? 'No disponible' }}</li>
                                    <li><strong>Monto Total Pagado:</strong>
                                        ${{ number_format($mpOrder->transaction_details->total_paid_amount ?? 0, 2) }}</li>
                                    <li><strong>Monto Neto Recibido:</strong>
                                        ${{ number_format($mpOrder->transaction_details->net_received_amount ?? 0, 2) }}
                                    </li>
                                    <li><strong>Monto por Cuota:</strong>
                                        ${{ number_format($mpOrder->transaction_details->installment_amount ?? 0, 2) }}
                                    </li>
                                    <li><strong>Últimos 4 dígitos de la tarjeta:</strong>
                                        {{ $mpOrder->card->last_four_digits ?? 'No disponible' }}</li>
                                    <li><strong>Nombre del Titular de la Tarjeta:</strong>
                                        {{ $mpOrder->card->cardholder->name ?? 'No disponible' }}</li>
                                    <li><strong>Cuotas:</strong> {{ $mpOrder->installments ?? 'Pago único' }}</li>
                                    <li><strong>Moneda:</strong> {{ $mpOrder->currency_id ?? 'No disponible' }}</li>
                                </ul>
                            </div>

                            <!-- Información adicional del pedido -->
                            <div class="mt-6">
                                <h4 class="text-lg font-medium text-gray-700 mb-2">Información Adicional:</h4>
                                <ul class="list-disc pl-6 space-y-2 text-gray-600">
                                    <li><strong>Email del Pagador:</strong> {{ $mpOrder->payer->email ?? 'No disponible' }}
                                    </li>
                                    <li><strong>Identificación del Pagador:</strong>
                                        {{ $mpOrder->payer->identification->number ?? 'No disponible' }}</li>
                                    <li><strong>Descripción en el Estado de Cuenta:</strong>
                                        {{ $mpOrder->statement_descriptor ?? 'No disponible' }}</li>
                                    <li><strong>Fecha de Creación:</strong>
                                        {{ \Carbon\Carbon::parse($mpOrder->created_at ?? now())->format('d/m/Y H:i') }}
                                    </li>
                                    <li><strong>Método de Pago:</strong>
                                        {{ is_string($mpOrder->payment_method ?? null) ? ucfirst($mpOrder->payment_method) : 'No disponible' }}
                                    </li>
                                </ul>
                            </div>

                            <!-- Detalle de los costos de Mercado Pago -->
                            <div class="mt-6">
                                <h4 class="text-lg font-medium text-gray-700 mb-2">Costos de Mercado Pago:</h4>
                                <ul class="list-disc pl-6 space-y-2 text-gray-600">
                                    <li><strong>Monto Total Pagado:</strong>
                                        ${{ number_format($mpOrder->transaction_details->total_paid_amount ?? 0, 2) }}</li>
                                    <li><strong>Monto Neto Recibido:</strong>
                                        ${{ number_format($mpOrder->transaction_details->net_received_amount ?? 0, 2) }}
                                    </li>
                                    <li><strong>Comisión de Mercado Pago:</strong>
                                        ${{ number_format(($mpOrder->transaction_details->total_paid_amount ?? 0) - ($mpOrder->transaction_details->net_received_amount ?? 0), 2) }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Total del Pedido -->
            <div class="mb-10 mt-6 rounded-lg bg-gray-100 p-6">
                <!-- Detalles del Pedido -->
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Productos</h3>
                <!-- Detalles del Pedido -->
                <ul class="space-y-4">
                    @foreach ($order->details as $detail)
                        <li class="flex flex-col lg:flex-row items-center justify-between bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center space-x-4 mb-2 lg:mb-0">
                                <img class="lg:w-14 w-12 h-12 rounded-full border-gray-200 border transform hover:scale-110 transition duration-150"
                                    src="{{ url(Storage::url($detail->productItem()->images->first()->url)) }}"
                                    alt="{{ $detail->productItem()->name }}">
                                <div class="text-center lg:text-left">
                                    <p class="text-lg font-medium text-gray-700">
                                        {{ $detail->productItem()->product->name }}</p>
                                    <p class="text-sm text-gray-500">Cantidad: {{ $detail->amount }}</p>
                                    <p class="text-sm text-gray-500">Talle: {{ $detail->itemVariation()->size->name }}</p>
                                    <p class="text-sm text-gray-500">Color: {{ $detail->productItem()->color->name }}</p>
                                </div>
                            </div>
                            <p class="text-lg font-semibold text-gray-700 text-center lg:text-right mt-2 lg:mt-0">
                                ${{ number_format($detail->price / 100, 2, ',', '.') }}</p>
                        </li>
                    @endforeach
                </ul>
                <h2 class="text-2xl font-semibold text-gray-600 mt-10 mb-4">Detalle de Pedido</h2>
                <li><strong>Comisión de Mercado Pago:</strong>
                    ${{ number_format(($mpOrder->transaction_details->total_paid_amount ?? 0) - ($mpOrder->transaction_details->net_received_amount ?? 0), 2) }}
                </li>
                @if ($order->deliveryService)
                    <li><strong>Costo Envio:</strong>
                        ${{ number_format($order->delivery_price / 100, 2, ',', '.') }}</li>
                @endif
                <p class="text-xl mt-4 text-gray-800 font-semibold"><strong>Total:</strong>
                    ${{ number_format($order->total / 100, 2, ',', '.') }}
                </p>
            </div>



            <!-- Acciones -->
            <div x-data="{ open: false }" class="flex flex-col lg:flex-row items-center mt-6 gap-6">
                <!-- Botón único que abre el modal -->
                <button @click="open = true"
                    class="inline-block px-6 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold shadow-lg transform transition-all hover:scale-105">
                    Contactar al Cliente
                </button>

                <a href="{{ route('admin.orders.index') }}"
                    class="inline-block px-6 py-3 text-white bg-gray-900 hover:bg-gray-700 rounded-lg font-semibold shadow-lg transform transition-all hover:scale-105">
                    Volver a la lista de pedidos
                </a>

                <!-- Modal -->
                <div x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="fixed inset-0 backdrop-blur-xl bg-opacity-75 flex items-center justify-center z-50">

                    <!-- Contenido del Modal -->
                    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md space-y-4">
                        <h2 class="text-xl font-bold mb-6 text-center text-gray-800">Selecciona una opción para contactar
                        </h2>

                        <!-- Botón de contacto por Correo -->
                        <a href="mailto:{{ $order->user->email }}?subject=Contacto sobre el Pedido #{{ $order->id }}&body=Hola {{ $order->user->name }},"
                            class="flex items-center justify-center gap-3 mb-4 text-white bg-slate-600 hover:bg-gray-900 rounded-full px-4 py-3 transition-all transform hover:scale-105">
                            <div class="bg-white p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7l8-5V6l-8 5l-8-5v2z" />
                                </svg>
                            </div>
                            <span class="font-semibold text-lg">Contactar por Correo</span>
                        </a>

                        <!-- Botón de contacto por WhatsApp -->
                        <a href="https://wa.me/{{ $order->user->phone_number }}?text=Hola%20{{ $order->user->name }},%20te%20contacto%20en%20relación%20al%20pedido%20numero%20{{ $order->id }}."
                            class="flex items-center justify-center gap-3 mb-4 text-white bg-green-500 hover:bg-green-600 rounded-full px-4 py-3 transition-all transform hover:scale-105"
                            target="blank_">
                            <div class="bg-white p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-green-500" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                                </svg>
                            </div>
                            <span class="font-semibold text-lg">Contactar por WhatsApp</span>
                        </a>

                        <!-- Botón de cierre del modal -->
                        <button @click="open = false"
                            class="w-full px-4 py-2 text-white bg-gray-900 hover:bg-gray-500 rounded-xl font-semibold transition-all transform hover:scale-105">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
