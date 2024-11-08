@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-gray-800 mb-4">Detalle del Pedido #{{ $order->id }}</h1>
        <div
        class="inline-flex items-center justify-center text-xs font-semibold uppercase w-24 xl:w-40 h-6 rounded-full
            @if ($order->orderStatus->id == 5) text-red-500 bg-red-100
            @elseif ($order->orderStatus->id == 1) text-yellow-600 bg-yellow-300
            @else text-emerald-600 bg-emerald-100 @endif">
        {{ $order->orderStatus->name }}
    </div>
    </p>

        <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Información del usuario y estado del pedido -->
            <div class="space-y-3">
                <p class="text-lg text-gray-600"><strong class="font-medium">Usuario:</strong> {{ $order->user->name }}</p>

                <p class="text-sm font-medium text-gray-900">


                <p class="text-lg text-gray-600"><strong class="font-medium">Fecha de Creación:</strong>
                    {{ $order->created_at->format('d-m-Y H:i') }}</p>
            </div>

            <!-- Sección de Comprobante y Método de Pago -->
            @if ($order->paymentMethod->id)
                <div class="flex justify-center">
                    @if ($order->comprobante)
                        <!-- Comprobante Existente -->
                        <div class="mt-4 bg-gray-200 p-4 rounded w-full sm:w-auto flex flex-col items-center">
                            <img src="{{ asset('storage/' . $order->comprobante->url) }}"
                                alt="Comprobante de pago del pedido #{{ $order->id }}"
                                class="w-full sm:w-64 h-auto object-cover rounded mb-4">

                            @if ($order->orderStatus->id == 1 || $order->orderStatus->id == 2)
                                <p class="text-sm text-gray-700 font-semibold">Pago: {{ $order->orderStatus->name }}</p>
                            @else
                                <button
                                    class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    Ver mi pedido
                                </button>
                            @endif
                        </div>
                    @else
                        <!-- Información para Transferencia y Subir Comprobante -->
                        <div class="mt-4 bg-gray-200 p-4 rounded w-full sm:w-auto flex flex-col items-start space-y-2">
                            <h3 class="text-gray-700 font-bold">Información para Transferencia</h3>
                            <p><strong>Alias:</strong> </p>
                            <p><strong>CBU:</strong> </p>
                            <p><strong>Nombre:</strong> </p>

                            <form action="{{ route('comprobante.store') }}" method="post" enctype="multipart/form-data"
                                class="w-full">
                                @csrf
                                <input type="file" id="file" name="file" accept="image/*,*.pdf"
                                    class="mt-2 block w-full" />
                                <input type="hidden" id="order_id" name="order_id" value="{{ $order->id }}">
                                <input type="number" id="dni" name="dni" placeholder="DNI en el comprobante"
                                    class="mt-2 w-full border border-gray-300 rounded px-2 py-1">

                                <!-- Botón para subir el comprobante -->
                                <button type="submit"
                                    class="mt-4 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded transition duration-200 w-full">
                                    Subir Comprobante
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Detalles de Productos</h3>
        <ul class="space-y-4">
            @foreach ($order->details as $detail)
                <li class="flex items-center justify-between bg-gray-100 p-4 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <img class="lg:w-12 h-8 lg:h-12 w-8 rounded-full border-gray-200 border transform hover:scale-125"
                            src="{{ url(Storage::url($detail->productItem()->images->first()->url)) }}"
                            alt="">
                        <div>
                            <p class="text-lg font-medium text-gray-700">{{ $detail->productItem()->product->name }}</p>
                            <p class="text-sm text-gray-500">Cantidad: {{ $detail->amount }}</p>
                        </div>
                    </div>
                    <p class="text-lg font-semibold text-gray-700">
                        ${{ number_format($detail->price / 100, 2, '.', ',') }}
                    </p>
                </li>
            @endforeach
        </ul>

        <div class="justify-between mt-6 gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5">
            <!-- Contenedor de los botones -->
            <div class="lg:col-span-4 w-full flex flex-col sm:flex-row sm:justify-start sm:gap-4 items-center">
                <!-- Botón 'Ver lista de pedidos' -->
                <div class="w-full sm:w-3/12 mb-4 sm:mb-0">
                    <a href="{{ route('orders.index') }}"
                        class="w-full flex justify-center px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold text-center">
                        Ver lista de pedidos
                    </a>
                </div>

                <!-- Botón 'Contactanos por algún problema' -->
                <div class="w-full sm:w-3/12">
                    <a href="https://wa.me/c/5493794316606"
                        class="w-full flex justify-center px-6 py-2 text-white bg-green-400 hover:bg-green-600 rounded-lg font-semibold text-center">
                        Contactanos por algún problema
                    </a>
                </div>
            </div>

            <!-- Total -->
            <div class="col-span-1 flex justify-center items-center sm:mt-0 mt-4">
                <p class="text-2xl font-bold text-gray-800 text-center">
                    <span class="font-semibold uppercase">Total:</span>
                    <span class="text-green-600">${{ number_format($order->total / 100, 2, ',', '.') }}</span>
                </p>
            </div>
        </div>

    </div>
@endsection
