@extends('layouts.admin')

@section('content')
    <div class="p-6 col-span-2 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-white w-full shadow-lg rounded-xl mt-6">
        <div class="max-w-2xl mx-auto">
            <h2 class="font-encode font-bold text-xl mb-3">Detalle del Pedido #{{ $order->id }}</h2>

            <div class="mb-4">
                <h3 class="font-bold text-lg">Usuario</h3>
                <p>Nombre: {{ $order->user->name }}</p>
                <p>Email: {{ $order->user->email }}</p>
            </div>

            <div class="mb-4">
                <h3 class="font-bold text-lg">Estado del Pedido</h3>
                <p>{{ $order->orderStatus->name }}</p>
            </div>

            <div class="mb-4">
                <h3 class="font-bold text-lg">Método de Pago</h3>
                <p>{{ $order->paymentMethod->name }}</p>
            </div>

            @if($order->deliveryService)
            <div class="mb-4">
                <h3 class="font-bold text-lg">Servicio de Entrega</h3>
                <p>{{ $order->deliveryService->name }} - Precio: {{ $order->delivery_price }}</p>
            </div>
            @endif

            @if($order->address)
            <div class="mb-4">
                <h3 class="font-bold text-lg">Dirección de Entrega</h3>
                <p>{{ $order->address->address_line }}</p>
            </div>
            @endif

            <div class="mb-4">
                <h3 class="font-bold text-lg">Total</h3>
                <p>${{ $order->total }}</p>
            </div>

            <div class="mb-4">
                <h3 class="font-bold text-lg">Detalles del Pedido</h3>
                <ul>
                    @foreach($order->details as $detail)
                        <li>
                            Producto: {{ $detail->productItem->name }} - Cantidad: {{ $detail->amount }} - Precio: ${{ $detail->price }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:underline">Volver a la lista de pedidos</a>
        </div>
    </div>
@endsection
