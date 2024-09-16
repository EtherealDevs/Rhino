@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="max-w-7xl h-screen justify-center mx-auto">
            <div class="p-4 w-full bg-white rounded-lg border m-2 xl:m-12 shadow-md sm:p-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold leading-none text-gray-900">Mis Pedidos</h3>
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
                                                        @foreach($order->details as $item)
                                                        <img class="lg:w-12 h-8 lg:h-12 w-8 rounded-full border-gray-200 border transform hover:scale-125"
                                                        src="{{url(Storage::url('images/product/'.$item->productItem->images->first()->url))}}" />
                                                        @endforeach
                                                    </div>
                                                    <time
                                                    class="right-10 inline-flex items-center justify-center text-xs font-semibold uppercase w-20 h-6 mb-3 sm:mb-0 text-emerald-600 bg-emerald-100 rounded-full">{{ $order->created_at->format('d-m-Y') }}</time>
                                                </td>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">
                                                    @foreach ($order->details as $detail)
                                                        <p>{{ $detail->productItem->product->name }}</p>
                                                    @endforeach
                                                </p>
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">
                                                    <div
                                                        class="right-10 inline-flex items-center justify-center text-xs font-semibold uppercase w-24 xl:w-40 h-6 mb-3 sm:mb-0
                                                        @if ($order->orderStatus->id == 5)
                                                            text-red-500 bg-red-100
                                                        @elseif ($order->orderStatus->id == 1)
                                                            text-yellow-600 bg-yellow-300
                                                        @else
                                                            text-emerald-600 bg-emerald-100
                                                        @endif
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
