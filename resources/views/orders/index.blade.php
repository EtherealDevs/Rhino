@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="max-w-7xl h-screen justify-center mx-auto">
            <div class="p-4 w-full bg-white rounded-lg border m-2 xl:m-12 shadow-md sm:p-8">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-josefin font-bold leading-none text-gray-900">Mis Pedidos</h1>
                </div>
                <div class="flow-root">

                    <ul role="list" class="divide-y divide-gray-200">

                        @if ($orders->isEmpty())
                            <div class="py-12">
                                <h2 class="text-xl font-josefin font-light">Parece que aun no has hecho pedidos</h2>
                            </div>
                            <div x-data="{ isShopModalOpen: true }">

                                <div id="myModal" x-show="isShopModalOpen" @click.away="isShopModalOpen = false"
                                    class="fixed modal inset-x-0 bottom-5 lg:bottom-10 flex justify-center z-50">
                                    <div
                                        class="max-w-screen-lg mx-auto bg-white rounded-lg drop-shadow-2xl p-5 flex flex-wrap text-center md:text-left items-center justify-center md:justify-between">
                                        <h2 class="text-xl font-bold mb-2 w-full">🛍️ ¡Es hora de hacer compras! 🛍️</h2>
                                        <p class="text-gray-700 mb-4 w-full">Descubre nuestros últimos productos y ofertas
                                            especiales. ¡Te encantarán! 🎉</p>

                                        <div class="flex gap-4 items-center flex-shrink-0 w-full">
                                            <button @click="isShopModalOpen = false"
                                                class="font-bold px-4 rounded-xl py-1.5 bg-gray-300 text-gray-700 hover:bg-gray-400 transition duration-300 ease-in-out">
                                                Cerrar
                                            </button>
                                            <a href="/products">
                                                <button
                                                    class="bg-blue-500 text-white hover:bg-blue-600 font-bold rounded-xl py-2 px-4">
                                                    <p>Empezar a Comprar <span>AHORA!!</span></p>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Incluye Alpine.js -->
                            <script src="//unpkg.com/alpinejs" defer></script>
                        @else
                            <ul>
                                @foreach ($orders as $order)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <td class="py-3 px-6 text-center">
                                                    <div class="flex items-center justify-center">
                                                        @foreach ($order->details as $detail)
                                                            <img class="lg:w-12 h-8 lg:h-12 w-8 rounded-full border-gray-200 border transform hover:scale-125"
                                                                src="{{ url(Storage::url('images/product/' . $detail->productItem()->images->first()->url )) }}" />
                                                        @endforeach
                                                    </div>
                                                    <time
                                                        class="right-10 inline-flex items-center justify-center text-xs font-semibold uppercase w-20 h-6 mb-3 sm:mb-0 text-emerald-600 bg-emerald-100 rounded-full">{{ $order->created_at->format('d-m-Y') }}</time>
                                                </td>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">
                                                    @foreach ($order->details as $detail)
                                                        <p>{{ $detail->productItem()->product->name }}</p>
                                                    @endforeach
                                                </p>
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">
                                                <div
                                                    class="right-10 inline-flex items-center justify-center text-xs font-semibold uppercase w-24 xl:w-40 h-6 mb-3 sm:mb-0
                                                        @if ($order->orderStatus->id == 5) text-red-500 bg-red-100
                                                        @elseif ($order->orderStatus->id == 1)
                                                            text-yellow-600 bg-yellow-300
                                                        @else
                                                            text-emerald-600 bg-emerald-100 @endif
                                                        rounded-full">
                                                    {{ $order->orderStatus->name }} -
                                                    ${{ $order->delivery_price }}
                                                </div>
                                                </p>
                                            </div>

                                            <div class="block items-center text-base font-semibold text-gray-900">
                                                ${{ $order->total }}
                                                <br>

                                                <p class="text-sm text-gray-500 truncate">
                                                    <a href="{{ route('orders.show', $order->id) }}"
                                                        class="text-blue-600 hover:underline">Ver
                                                        detalles</a>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </ul>
                </div>
            </div>
        </div>


    </div>
@endsection
