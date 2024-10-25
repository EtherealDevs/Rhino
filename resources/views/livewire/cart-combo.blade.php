{{-- <li class="py-3 mb-2 mt-6 sm:py-4 bg-white rounded-lg shadow-md">
    @foreach ($comboItems as $comboItem)
    <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
        <div class="flex-shrink-0 mx-auto sm:mx-0 sm:flex sm:justify-center">
            <img class="w-14 h-14 rounded-full" src="/storage/images/product/{{ $comboItem['comboItem']->images[0]->url }}"
                alt="Product image">
        </div>
        <div class="flex-1 sm:flex sm:justify-between sm:items-center w-full sm:text-center">
            <div class="sm:w-1/3 flex flex-col sm:items-center">
                <p
                    class="text-3xl flex left-1/2 justify-center sm:text-2xl font-josefin font-bold text-gray-900 truncate">
                    {{$comboItem['comboItem']->product->name}}
                </p>
                <div class="flex gap-2 mt-2 justify-center">
                    <div class="flex justify-center bg-[#26ca60] text-white text-sm font-bold rounded-xl px-2 py-1">
                        <p>${{number_format($comboItem['comboItem']->price(),0, ',', '.')}}</p>
                    </div>
                </div>
            </div>
            <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                <p class="font-josefin font-bold text-gray-900">Talle</p>
                <p class="font-josefin font-bold">{{$comboItem['size']}}</p>
            </div>
            <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                <p class="font-josefin font-bold text-gray-900">Cantidad</p>
                <p class="font-josefin font-bold">{{$comboItem['amount']}}</p>
            </div>
            <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                <p class="font-josefin font-bold text-gray-900">Total</p>
                <p class="text-base font-semibold text-green-500">
                    ${{number_format($comboItem['comboItem']->price(),0, ',', '.') * $comboItem['amount']}}</p>
            </div>
            <form method="POST" action="{{ route('cart.removeItem', ['comboItem' => $comboItem['id']]) }}"
                class="mt-4 sm:mt-0 sm:w-auto text-center">
                @csrf
                @method('delete')
                <input value="{{ $comboItem['size'] }}" type="hidden" name="size">
                <button type="submit" class="text-3xl text-gray-400 font-encode font-extrabold hover:text-red-500">
                    x
                </button>
            </form>
        </div>
    </div>
    @endforeach
    <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
        <div class="flex-shrink-0 mx-auto sm:mx-0 sm:flex sm:justify-center">
            <img class="w-14 h-14 rounded-full" src="/storage/images/product/{{ $comboItem['comboItem']->images[0]->url }}"
                alt="Product image">
        </div>
        <div class="flex-1 sm:flex sm:justify-between sm:items-center w-full sm:text-center">
            <div class="sm:w-1/3 flex flex-col sm:items-center">
                <div class="flex gap-2 mt-2 justify-center">
                        <div class="flex justify-center bg-[#df2929] text-white text-sm font-bold rounded-xl px-2 py-1">
                            <p>{{ number_format($discount, 0, ',', '.') }}%</p>
                        </div>
                </div>
            </div>
            <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                <p class="font-josefin font-bold text-gray-900">Talle</p>
                <p class="font-josefin font-bold">2</p>
            </div>
            <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                <p class="font-josefin font-bold text-gray-900">Cantidad</p>
                <p class="font-josefin font-bold">2</p>
            </div>
            <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                <p class="font-josefin font-bold text-gray-900">Total</p>
                <p class="text-base font-semibold text-green-500">
                    ${{ number_format($total, 0, ',', '.')}}</p>
            </div>
            <form method="POST" action="{{ route('cart.removeItem', ['comboItem' => $comboItem['id']]) }}"
                class="mt-4 sm:mt-0 sm:w-auto text-center">
                @csrf
                @method('delete')
                <input value="{{ $comboItem['size'] }}" type="hidden" name="size">
                <button type="submit" class="text-3xl text-gray-400 font-encode font-extrabold hover:text-red-500">
                    x
                </button>
            </form>
        </div>
    </div>
</li> --}}
<!-- component -->
<div class="mx-auto w-full" x-data="{ isOpen: false }">
    <a @click.prevent="isOpen = !isOpen" class="flex justify-center items-center">
        <div
            class="mb-3 py-3 mt-6 w-full max-w-screen-xl transform cursor-pointer flex-col lg:flex-row justify-between rounded-xl bg-white bg-opacity-75 p-6 text-slate-800 transition-shadow duration-500 hover:-translate-y-1 hover:shadow-lg">
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-7 gap-4">
                <!-- Imagenes -->
                <div class="col-span-2 flex space-x-2">
                    @if (count($comboItems)>1)

                        @for ($i = 0; $i < 2; $i++)
                            <div x-data="{ tooltip: false }" class="relative transition duration-300 ease-in-out">
                                <img @mouseover="tooltip = true" @mouseleave="tooltip = false"
                                    class="h-14 w-14 rounded-full border-2 border-white object-cover shadow hover:shadow-xl"
                                    src="{{ url(Storage::url('images/product/' . $comboItems[$i]->item->images->first()->url)) }}"
                                    alt="Imagen Producto" />

                                <!-- Tooltip -->
                                <div class="absolute z-50 left-14 -top-2" x-show="tooltip"
                                    x-transition:enter="transition ease-out duration-150"
                                    x-transition:enter-start="opacity-0 transform translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 transform translate-y-0"
                                    x-transition:leave-end="opacity-0 transform translate-y-2">
                                    <div class="rounded-lg bg-blue-200 p-2 text-sm font-bold text-slate-700">
                                        {{ $comboItems[$i]->item->product->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                @else
                    @for ($i = 0; $i < count($comboItems); $i++)
                        <div x-data="{ tooltip: false }" class="relative transition duration-300 ease-in-out">
                            <img @mouseover="tooltip = true" @mouseleave="tooltip = false"
                                class="h-14 w-14 rounded-full border-2 border-white object-cover shadow hover:shadow-xl"
                                src="{{ url(Storage::url('images/product/' . $comboItems[$i]->item->images->first()->url)) }}"
                                alt="Imagen Producto" />

                            <!-- Tooltip -->
                            <div class="absolute z-50 left-14 -top-2" x-show="tooltip"
                                x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 transform translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform translate-y-2">
                                <div class="rounded-lg bg-blue-200 p-2 text-sm font-bold text-slate-700">
                                    {{ $comboItems[$i]->item->product->name }}
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>

            <div class="col-span-2 w-full flex justify-start">
                <a @click.prevent="isOpen = !isOpen" class="flex py-2 text-sm text-blue-500 justify-center items-center">
                    Ver detalle <span class="font-bold">→</span>
                </a>
            </div>

            <!-- Precio / Descuento -->
            <div class="col-span-1 flex flex-col items-center justify-center">
                <div class="text-xl line-through text-gray-500 font-extrabold">
                    ${{ number_format($subtotal / 1, 2, ',', '.') }}
                </div>
                <span class="text-xs rounded bg-green-600 px-2 py-1 font-bold text-white">
                    {{ number_format($discount, 0, ',', '.') }}% OFF
                </span>
            </div>

            <!-- Cantidad -->
            <div class="col-span-1 flex flex-col items-center justify-center">
                <div class="font-semibold text-gray-600">Cantidad</div>
                <div class="w-1/2 gap-4 flex">
                    <form method="POST" action="{{ route('cart.updateItem', ['cartItemId' => $cartItemId]) }}"
                        class="inline">
                        @csrf
                        @method('post')
                        <input value="subtract" type="hidden" name="mode">
                        <button type="submit">
                            -
                        </button>
                    </form>
                    <div class="text-xl font-extrabold text-green-500">

                        {{ $quantity }}

                    </div>
                    <form method="POST" action="{{ route('cart.updateItem', ['cartItemId' => $cartItemId]) }}"
                        class="inline">
                        @csrf
                        @method('post')
                        <input value="add" type="hidden" name="mode">
                        <button type="submit">
                            +
                        </button>
                    </form>
                </div>

            </div>

            <!-- Total OFF -->
            <div class="col-span-1 flex flex-col items-center justify-center">
                <div class="font-semibold text-gray-600">Total</div>
                <div class="text-xl font-extrabold text-green-500">
                    ${{ number_format($total / 1, 2, ',', '.') }}
                </div>
            </div>

            <!-- Eliminar -->
            <div class="col-span-1 flex items-center justify-end">
                <button type="submit" class="text-gray-400 hover:text-red-500 text-xl font-bold">
                    &times;
                </button>
            </div>
        </div>

        <!-- Dropdown -->
        <div x-show="isOpen" @click.away="isOpen = false" class="transition p-6 mt-0">
            @foreach ($comboItems as $comboItem)
                <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 mb-4">
                    <img class="w-14 h-14 rounded-full"
                        src="/storage/images/product/{{ $comboItem->item->images[0]->url }}" alt="Product image">

                    <div class="grid grid-cols-3 sm:grid-cols-3 sm:justify-between sm:items-center w-full">
                        <!-- Nombre y Precio -->
                        <div class="text-center sm:text-left">
                            <p class="text-2xl font-bold">{{ $comboItem->item->product->name }}</p>
                            <span class="text-sm font-bold w-auto bg-[#26ca60] text-white rounded-xl px-2 py-1 mt-2">
                                ${{ number_format($comboItem->item->price() / 1, 2, ',', '.') }}
                            </span>
                        </div>

                        <!-- Talle -->
                        <div class="text-center">
                            <p class="font-bold">Talle</p>
                            <p>{{ $itemSizes[$comboItem->item->id] }}</p>
                        </div>

                        <!-- Total -->
                        <div class="text-center">
                            <p class="font-bold">Total</p>
                            <p class="text-green-500 font-semibold">
                                ${{ number_format(($comboItem->item->price() * $quantity) / 1, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <hr class="border-gray-200 my-4">
            @endforeach
        </div>
    </div>
</div>
