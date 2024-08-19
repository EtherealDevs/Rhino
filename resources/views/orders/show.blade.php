@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-gray-800 mb-4">Detalle del Pedido #{{ $order->id }}</h1>
        
        <div class="mb-6">
            <p class="text-lg text-gray-600"><strong class="font-medium">Usuario:</strong> {{ $order->user->name }}</p>
            <p class="text-lg text-gray-600"><strong class="font-medium">Estado:</strong> 
                <span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-emerald-500 rounded-full">
                    {{ $order->orderStatus->name }}
                </span>
            </p>
            <p class="text-lg text-gray-600"><strong class="font-medium">Total:</strong> ${{ number_format($order->total, 2) }}</p>
            <p class="text-lg text-gray-600"><strong class="font-medium">Fecha de Creación:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
        </div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Detalles de Productos</h3>
        <ul class="space-y-4">
            @foreach($order->details as $detail)
                <li class="flex items-center justify-between bg-gray-100 p-4 rounded-lg">
                    <div>
                        <p class="text-lg font-medium text-gray-700">{{ $detail->productItem->product->name }}</p>
                        <p class="text-sm text-gray-500">Cantidad: {{ $detail->amount }}</p>
                    </div>
                    <p class="text-lg font-semibold text-gray-700">${{ number_format($detail->price, 2) }}</p>
                </li>
            @endforeach
        </ul>
        
        <div class="mt-6">
            <a href="{{ route('orders.index') }}" class="inline-block px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold">
                Volver a la lista de pedidos
            </a>
        </div>
    </div>
@endsection
