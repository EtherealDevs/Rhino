
<!-- component -->
<script src="//unpkg.com/alpinejs" defer></script>
<div class="mx-auto w-full" x-data="{ isOpen: false }">
    <a @click.prevent="isOpen = true" class="flex justify-center items-center ">
        <div
            class="mb-3 flex w-full max-w-screen-xl transform cursor-pointer flex-col justify-between rounded-md bg-white bg-opacity-75 p-6 text-slate-800 transition shadow-md duration-500 ease-in-out hover:-translate-y-1 hover:shadow-lg lg:flex-row lg:p-4">
            <div class="flex w-full flex-row lg:w-3/12">
                <div class="relative flex space-x-2">
                    @for ($i = 0; $i < 2; $i++)
                        <div x-data="{ tooltip: false }" class="relative inline-flex transition duration-300 ease-in-out"
                            x-cloak>
                            <img @mouseover="tooltip = true" @mouseleave="tooltip = false"
                                class="z-10 h-14 w-14 rounded-full border-2 border-white object-cover shadow hover:shadow-xl dark:border-slate-800"
                                src="{{ url(Storage::url('images/product/' . $items[$i]['item']->images->first()->url)) }}"
                                alt="Marilyn Monroe" />
                            <div class="relative z-50 overflow-visible pt-2" x-cloak x-show="tooltip"
                                x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="transform opacity-0 translate-y-full"
                                x-transition:enter-end="transform opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="transform opacity-100 translate-y-0"
                                x-transition:leave-end="transform opacity-0 translate-y-full">
                                <div
                                    class="absolute -right-1 z-50 mt-1 w-40 -translate-x-10 -translate-y-5 transform overflow-x-hidden rounded-lg bg-blue-200 p-2 text-center leading-tight text-white shadow-md dark:bg-slate-900">
                                    <div
                                        class="text-slate-700 dark:text-slate-200 text-center text-base font-extrabold">
                                        Nombre Producto</div>
                                </div>
                                <svg class="absolute right-2 z-50 h-6 w-6 -translate-x-4 translate-y-0 transform fill-current stroke-current text-blue-200 dark:text-slate-900"
                                    width="8" height="8">
                                    <rect x="9" y="-8" width="8" height="8" transform="rotate(45)">
                                    </rect>
                                </svg>
                            </div>
                        </div>
                    @endfor
                    {{--
                    <div x-data="{ tooltip: false }" class="relative inline-flex transition duration-300 ease-in-out" x-cloak>
                        <img @mouseover="tooltip = true" @mouseleave="tooltip = false"
                            class="z-10 h-14 w-14 rounded-full border-2 border-white object-cover shadow hover:shadow-xl dark:border-slate-800"
                            src="https://images.unsplash.com/photo-1554151228-14d9def656e4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&w=128&h=128&q=60&facepad=1.5"
                            alt="Salesperson" />
                        <div class="relative z-50 overflow-visible pt-2" x-cloak x-show="tooltip"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="transform opacity-0 translate-y-full"
                            x-transition:enter-end="transform opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="transform opacity-100 translate-y-0"
                            x-transition:leave-end="transform opacity-0 translate-y-full">
                            <div
                                class="absolute -right-1 z-50 mt-1 w-40 -translate-x-10 -translate-y-5 transform overflow-x-hidden rounded-lg bg-blue-200 p-2 text-center leading-tight text-white shadow-md dark:bg-slate-900">
                                <div class="text-slate-700 dark:text-slate-200 text-center text-base font-extrabold">
                                    Nombre producto</div>
                            </div>
                            <svg class="absolute right-2 z-50 h-6 w-6 -translate-x-4 translate-y-0 transform fill-current stroke-current text-blue-200 dark:text-slate-900"
                                width="8" height="8">
                                <rect x="9" y="-8" width="8" height="8" transform="rotate(45)">
                                </rect>
                            </svg>
                        </div>
                    </div> --}}
                </div>

            </div>

            <div class="w-full self-center pt-4 lg:w-1/6 lg:pt-0">
                <div class="ml-1">
                    <div class="text-xl line-through text-gray-500 font-extrabold leading-5 tracking-tight">
                        ${{ number_format($subtotal, 0, ',', '.') }}</div><span
                        class="text-[12px] ml-2 rounded bg-green-600 px-2 py-1 align-middle font-bold uppercase text-white">{{ number_format($discount, 0, ',', '.') }}%OFF</span>
                </div>
            </div>

            <div class="w-full self-center pt-4 lg:w-1/6 lg:pt-0">
                <div class="ml-1">
                    <div class="text-xl font-extrabold leading-5 tracking-tight">
                        <span class="align-middle text-slate-900">${{ number_format($total, 0, ',', '.') }}</span>

                    </div>
                    <div class="text-[13px] text-slate-900">Total Con descuento</div>
                </div>
            </div>

            <div class="w-3/4 self-center pt-4 text-black lg:w-1/6 lg:pt-0">
                <button type="submit"
                    class="text-3xl right-0 text-gray-400 font-encode font-extrabold hover:text-red-500">
                    x
                </button>
            </div>
        </div>
    </a>
    <div x-show="isOpen" @click.away="isOpen = false">
        @foreach ($items as $item)
            <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <div class="flex-shrink-0 mx-auto sm:mx-0 sm:flex sm:justify-center">
                    <img class="w-14 h-14 rounded-full"
                        src="/storage/images/product/{{ $item['item']->images[0]->url }}" alt="Product image">
                </div>
                <div class="flex-1 sm:flex sm:justify-between sm:items-center w-full sm:text-center">
                    <div class="sm:w-1/3 flex flex-col sm:items-center">
                        <p
                            class="text-3xl flex left-1/2 justify-center sm:text-2xl font-josefin font-bold text-gray-900 truncate">
                            {{ $item['item']->product->name }}
                        </p>
                        <div class="flex gap-2 mt-2 justify-center">
                            <div
                                class="flex justify-center bg-[#26ca60] text-white text-sm font-bold rounded-xl px-2 py-1">
                                <p>${{ number_format($item['item']->price(), 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                        <p class="font-josefin font-bold text-gray-900">Talle</p>
                        <p class="font-josefin font-bold">{{ $item['size'] }}</p>
                    </div>
                    <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                        <p class="font-josefin font-bold text-gray-900">Cantidad</p>
                        <p class="font-josefin font-bold">{{ $item['amount'] }}</p>
                    </div>
                    <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                        <p class="font-josefin font-bold text-gray-900">Total</p>
                        <p class="text-base font-semibold text-green-500">
                            ${{ number_format($item['item']->price(), 0, ',', '.') * $item['amount'] }}</p>
                    </div>
                    <form method="POST" action="{{ route('cart.removeItem', ['item' => $item['id']]) }}"
                        class="mt-4 sm:mt-0 sm:w-auto text-center">
                        @csrf
                        @method('delete')
                        <input value="{{ $item['size'] }}" type="hidden" name="size">
                        <button type="submit"
                            class="text-3xl text-gray-400 font-encode font-extrabold hover:text-red-500">
                            x
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
