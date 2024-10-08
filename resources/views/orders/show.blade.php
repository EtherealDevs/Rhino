@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-gray-800 mb-4">Detalle del Pedido #{{ $order->id }}</h1>

        <div class="mb-6 grid grid-cols-2">
            <div>
                <p class="text-lg text-gray-600"><strong class="font-medium">Usuario:</strong> {{ $order->user->name }}</p>
                <p class="text-sm font-medium text-gray-900 truncate">
                    <div class="inline-flex items-center justify-center text-xs font-semibold uppercase w-24 xl:w-40 h-6 mb-3 sm:mb-0 rounded-full
                        @if ($order->orderStatus->id == 5)
                            text-red-500 bg-red-100
                        @elseif ($order->orderStatus->id == 1)
                            text-yellow-600 bg-yellow-300
                        @else
                            text-emerald-600 bg-emerald-100
                        @endif
                    ">
                        {{ $order->orderStatus->name }}
                    </div>
                </p>
                <p class="text-lg text-gray-600"><strong class="font-medium">Total:</strong> ${{ number_format($order->total / 100, 2, ',', '.') }}</p>
                <p class="text-lg text-gray-600"><strong class="font-medium">Fecha de Creación:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
            </div>

            @if($order->paymentMethod->id)
            <div class="flex justify-center">
                @if ($order->comprobante)
                    <div  class="mt-4 bg-gray-200 p-4 rounded">
                        <img src="{{ asset('storage/'.$order->comprobante->url) }}" alt="
                        Comprobante de pago del pedido #{{ $order->id }}" class="w-64 h
                        -48 object-cover rounded">
                         @if ($order->orderStatus->id == 1 || $order->orderStatus->id ==2)
                         <p>Pago: {{$order->orderStatus->name}}</p>
                        @else
                            <button>ver mi pedido</button>
                        @endif
                    </div>
                @else
                    <div  class="mt-4 bg-gray-200 p-4 rounded">
                        <h3 class="text-gray-700 font-bold">Información para Transferencia</h3>
                        <p><strong>Alias:</strong> </p>
                        <p><strong>CBU:</strong> </p>
                        <p><strong>Nombre:</strong> </p>

                        <div >
                            <form action="{{route('comprobante.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- Input de archivo oculto -->
                                <input type="file" id="file" name="file" accept="image/*,*.pdf" />
                                <input type="number" id="order_id" name="order_id" value="{{$order->id}}" class="hidden">
                                <input type="number" id="dni" name="dni" placeholder="dni que figura en le comprobante">



                                <!-- Botón para subir el comprobante -->
                                <button type="submit" class="mt-4 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded transition duration-200">
                                    Subir Comprobante
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
            @endif
        </div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Detalles de Productos</h3>
        <ul class="space-y-4">
            @foreach($order->details as $detail)
                <li class="flex items-center justify-between bg-gray-100 p-4 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <img class="lg:w-12 h-8 lg:h-12 w-8 rounded-full border-gray-200 border transform hover:scale-125" src="{{url(Storage::url('images/product/'.$detail->productItem()->images->first()->url))}}" alt="">
                        <div>
                            <p class="text-lg font-medium text-gray-700">{{ $detail->productItem()->product->name }}</p>
                            <p class="text-sm text-gray-500">Cantidad: {{ $detail->amount }}</p>
                        </div>
                    </div>
                    <p class="text-lg font-semibold text-gray-700">${{ number_format($detail->price, 2) }}</p>
                </li>
            @endforeach
        </ul>

        <div class="flex mt-6 gap-6">
            <div class="">
                <a href="{{ route('orders.index') }}" class="inline-block px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold">
                    Ver lista de pedidos
                </a>
            </div>

            <div class="">
                <a href="https://wa.me/c/5493794316606" class="inline-block px-6 py-2 text-white bg-green-400 hover:bg-green-600 rounded-lg font-semibold">
                    Contactanos por algun problema
                </a>
            </div>
        </div>
    </div>
@endsection
