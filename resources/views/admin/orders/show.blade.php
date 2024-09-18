@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="container mx-auto mt-14 p-12 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Detalle del Pedido #{{ $order->id }}</h1>

        <!-- Usuario -->
        <div class="mb-6">
            <p class="text-lg text-gray-600">
                <strong class="font-medium">Usuario:</strong> {{ $order->user->name }}
            </p>
            <p class="text-lg text-gray-600">
                <strong class="font-medium">Email:</strong> {{ $order->user->email }}
            </p>
        </div>

        <!-- Estado del Pedido -->
        <div class="mb-6">
            <p class="text-lg text-gray-600">
                <strong class="font-medium">Estado del Pedido:</strong>
                <span class="inline-flex items-center justify-center text-xs font-semibold uppercase px-2 py-1 rounded-full
                    @if ($order->orderStatus->id == 5)
                        text-red-500 bg-red-100
                    @elseif ($order->orderStatus->id == 1)
                        text-yellow-600 bg-yellow-300
                    @else
                        text-emerald-600 bg-emerald-100
                    @endif
                ">
                    {{ $order->orderStatus->name }}
                </span>
            </p>
        </div>

        <!-- Método de Pago -->
        <div class="mb-6">
            <p class="text-lg text-gray-600">
                <strong class="font-medium">Método de Pago:</strong> {{ $order->paymentMethod->name }}
            </p>
        </div>

        <p class="text-lg mb-6 text-gray-600"><strong class="font-medium">Fecha de Creación:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>

        <!-- Servicio de Entrega (Opcional) -->
        @if($order->deliveryService)
            <div class="mb-6">
                <p class="text-lg text-gray-600">
                    <strong class="font-medium">Servicio de Entrega:</strong> {{ $order->deliveryService->name }} 
                </p>
                <p class="text-lg text-gray-600">
                    <strong class="font-medium">Costo de Entrega:</strong> ${{ number_format($order->delivery_price, 2) }}
                </p>
            </div>
        @endif

        <!-- Dirección de Entrega (Opcional) -->
        @if($order->address)
            <div class="mb-6">
                <p class="text-lg text-gray-600">
                    <strong class="font-medium">Dirección de Entrega:</strong> {{ $order->address->address_line }}
                </p>
            </div>
        @endif

        <!-- Total del Pedido -->
        <div class="mb-6">
            <p class="text-xl text-gray-800 font-semibold">
                <strong>Total del Pedido:</strong> ${{ number_format($order->total, 2) }}
            </p>
        </div>

        <!-- Detalles del Pedido -->
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Detalles del Pedido</h3>
        <ul class="space-y-4">
            @foreach($order->details as $detail)
                <li class="flex items-center justify-between bg-gray-100 p-4 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <img class="lg:w-12 h-8 lg:h-12 w-8 rounded-full border-gray-200 border transform hover:scale-110"
                             src="{{ url(Storage::url('images/product/'.$detail->productItem->images->first()->url)) }}"
                             alt="{{ $detail->productItem->name }}">
                        <div>
                            <p class="text-lg font-medium text-gray-700">{{ $detail->productItem->product->name }}</p>
                            <p class="text-sm text-gray-500">Cantidad: {{ $detail->amount }}</p>
                        </div>
                    </div>
                    <p class="text-lg font-semibold text-gray-700">${{ number_format($detail->price, 2) }}</p>
                </li>
            @endforeach
        </ul>

        <!-- Acciones -->
        <div class="flex mt-6 gap-6">
            <a href="{{ route('admin.orders.index') }}"
               class="inline-block px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold">
                Volver a la lista de pedidos
            </a>
            <a href="mailto:{{ $order->user->email }}?subject=Contacto sobre el Pedido #{{ $order->id }}&body=Hola {{ $order->user->name }},"
               class="inline-block px-6 py-2 text-white bg-green-500 hover:bg-green-600 rounded-lg font-semibold">
                Contactar al Cliente
            </a>
        </div>
    </div>
</div>
@endsection
