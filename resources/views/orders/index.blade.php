@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="max-w-7xl h-screen justify-center mx-auto">
            <div class="p-4 w-full bg-white rounded-lg border m-12 shadow-md sm:p-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold leading-none text-gray-900">Mis Pedidos</h3>
                    <a href="#" class="text-sm font-medium text-blue-600 hover:underline">
                        Ver Todos
                    </a>
                </div>
                <div class="flow-root">

                    <ul role="list" class="divide-y divide-gray-200">

                        @if ($orders->isEmpty())
                            <p>No hay pedidos disponibles.</p>
                        @else
                            <ul>
                                @foreach ($orders as $order)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <td class="py-3 px-6 text-center">
                                                    <div class="flex items-center justify-center">
                                                        <img class="w-12 h-12 rounded-full border-gray-200 border transform hover:scale-125"
                                                            src="https://randomuser.me/api/portraits/men/1.jpg" />
                                                        <img class="w-12 h-12 rounded-full border-gray-200 border -m-1 transform hover:scale-125"
                                                            src="https://randomuser.me/api/portraits/women/2.jpg" />
                                                        <img class="w-12 h-12 rounded-full border-gray-200 border -m-1 transform hover:scale-125"
                                                            src="https://randomuser.me/api/portraits/men/3.jpg" />
                                                    </div>
                                                </td>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">
                                                    @foreach ($order->details as $detail)
                                                        <p>{{ $detail->productItem->product->name }}</p>
                                                    @endforeach
                                                </p>
                                                <p class="text-sm text-gray-500 truncate">
                                                    <a href="{{ route('orders.show', $order->id) }}"
                                                        class="text-blue-600 hover:underline">Ver
                                                        detalles</a>
                                                </p>
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">
                                                <div
                                                    class="right-10 inline-flex items-center justify-center text-xs font-semibold uppercase w-40 h-6 mb-3 sm:mb-0 text-emerald-600 bg-emerald-100 rounded-full">
                                                    {{ $order->orderStatus->name }} -
                                                    ${{ $order->delivery_price }}
                                                </div>
                                                </p>
                                            </div>

                                            <div
                                                class="block items-center text-base font-semibold text-gray-900">
                                                ${{ $order->total }}
                                                <br>
                                                <time
                                                    class="right-10 inline-flex items-center justify-center text-xs font-semibold uppercase w-20 h-6 mb-3 sm:mb-0 text-emerald-600 bg-emerald-100 rounded-full">{{ $order->created_at->format('d-m-Y') }}</time>
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