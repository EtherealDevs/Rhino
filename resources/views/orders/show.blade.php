@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Detalle del Pedido #{{ $order->id }}</h1>
        
        <p><strong>Usuario:</strong> {{ $order->user->name }}</p>
        <p><strong>Estado:</strong> {{ $order->orderStatus->name }}</p>
        <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
        <p><strong>Fecha de Creación:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
        
        <h3>Detalles de Productos</h3>
        <ul>
            @foreach($order->details as $detail)
                <li>{{ $detail->productItem->name }} - Cantidad: {{ $detail->amount }} - Precio: ${{ number_format($detail->price, 2) }}</li>
            @endforeach
        </ul>
        
        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:underline">Volver a la lista de pedidos</a>
    </div>
@endsection
