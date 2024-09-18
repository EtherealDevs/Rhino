<!-- component -->
<script src="//unpkg.com/alpinejs" defer></script>

<div class="mx-auto w-full" x-data="{ isOpen: false }">
    <a @click.prevent="isOpen = !isOpen" class="flex justify-center items-center">
        <div
            class="mb-3 py-3 mt-6 w-full max-w-screen-xl transform cursor-pointer flex-col lg:flex-row justify-between rounded-xl bg-white bg-opacity-75 p-6 text-slate-800 transition-shadow duration-500 hover:-translate-y-1 hover:shadow-lg">
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-7 gap-4">
                <!-- Imagenes -->
                <div class="col-span-2 flex space-x-2">
                    @if (count($items)>1)

                        @for ($i = 0; $i < 2; $i++)
                            <div x-data="{ tooltip: false }" class="relative transition duration-300 ease-in-out">
                                <img @mouseover="tooltip = true" @mouseleave="tooltip = false"
                                    class="h-14 w-14 rounded-full border-2 border-white object-cover shadow hover:shadow-xl"
                                    src="{{ url(Storage::url('images/product/' . $items[$i]['item']->images->first()->url)) }}"
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
                                        {{ $items[$i]['item']->product->name }}
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @else
                        @for ($i = 0; $i < count($items); $i++)
                            <div x-data="{ tooltip: false }" class="relative transition duration-300 ease-in-out">
                                <img @mouseover="tooltip = true" @mouseleave="tooltip = false"
                                    class="h-14 w-14 rounded-full border-2 border-white object-cover shadow hover:shadow-xl"
                                    src="{{ url(Storage::url('images/product/' . $items[$i]['item']->images->first()->url)) }}"
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
                                        {{ $items[$i]['item']->product->name }}
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endif
                </div>

                <!-- Precio / Descuento -->
                <div class="col-span-1 flex flex-col items-center justify-center">
                    <div class="text-xl line-through text-gray-500 font-extrabold">
                        ${{ number_format($subtotal, 0, ',', '.') }}
                    </div>
                    <span class="text-xs rounded bg-green-600 px-2 py-1 font-bold text-white">
                        {{ number_format($discount, 0, ',', '.') }}% OFF
                    </span>
                </div>

                <!-- Total OFF -->
                <div class="col-span-1 lg:col-span-3 flex flex-col items-center justify-center">
                    <div class="text-sm text-slate-900">Total con Descuento</div>
                    <div class="text-xl font-extrabold text-green-500">
                        ${{ number_format($total, 0, ',', '.') }}
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
                @foreach ($items as $item)
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 mb-4">
                        <img class="w-14 h-14 rounded-full"
                            src="/storage/images/product/{{ $item['item']->images[0]->url }}" alt="Product image">

                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center w-full">
                            <!-- Nombre y Precio -->
                            <div class="text-center sm:text-left">
                                <p class="text-2xl font-bold">{{ $item['item']->product->name }}</p>
                                <p class="text-sm font-bold bg-[#26ca60] text-white rounded-xl px-2 py-1 mt-2">
                                    ${{ number_format($item['item']->price(), 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Talle -->
                            <div class="text-center">
                                <p class="font-bold">Talle</p>
                                <p>{{ $item['size'] }}</p>
                            </div>

                            <!-- Cantidad -->
                            <div class="text-center">
                                <p class="font-bold">Cantidad</p>
                                <p>{{ $item['amount'] }}</p>
                            </div>

                            <!-- Total -->
                            <div class="text-center">
                                <p class="font-bold">Total</p>
                                <p class="text-green-500 font-semibold">
                                    ${{ number_format($item['item']->price(), 0, ',', '.') * $item['amount'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="border-gray-200 my-4">
                @endforeach
            </div>
        </div>
    </a>
</div>
