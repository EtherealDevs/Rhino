@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 w-full bg-gradient-to-br from-white via-white to-gray-100 top-0">
        <div class="col-span-12 lg:col-span-7 bg-transparent py-10 px-6 sm:px-8 lg:px-12 items-center">
            <div class="p-4 bg-transparent rounded-lg items-center sm:p-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold font-josefin text-4xl sm:text-xl lg:text-5xl">Mi Carrito</h3>
                </div>
                <div class="flow-root">
                    @session('failure')
                        <p>{{ session('failure') }}</p>
                    @endsession
                    @isset($groupedCartItems)
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-200">
                            @foreach ($groupedCartItems as $comboId => $items)
                                @if ($comboId)
                                @livewire('cart-combo',['items'=>$items,'combo'=>$comboId])
                                @else
                                    @foreach ($items as $item)
                                        @livewire('cart-item', ['item' => $item])
                                    @endforeach
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <p class="text-2xl sm:text-3xl lg:text-4xl text-gray-300 mt-24 mb-24">No tienes productos en tu carrito
                        </p>
                    @endisset
                </div>

                <div>
                    <!-- component -->
                    <script src="//unpkg.com/alpinejs" defer></script>
                    <div class="flex justify-center items-center">
                        <div
                            class="mb-3 flex w-full max-w-screen-xl transform cursor-pointer flex-col justify-between rounded-md bg-white bg-opacity-75 p-6 text-slate-800 transition shadow-md duration-500 ease-in-out hover:-translate-y-1 hover:shadow-lg lg:flex-row lg:p-4">
                            <div class="flex w-full flex-row lg:w-3/12">
                                <div class="relative flex space-x-2">
                                    <div x-data="{ tooltip: false }" class="relative inline-flex transition duration-300 ease-in-out" x-cloak>
                                        <img @mouseover="tooltip = true" @mouseleave="tooltip = false"
                                            class="z-10 h-14 w-14 rounded-full border-2 border-white object-cover shadow hover:shadow-xl dark:border-slate-800"
                                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&w=128&h=128&q=60&facepad=1.5"
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
                                                <div class="text-slate-700 dark:text-slate-200 text-center text-base font-extrabold">
                                                    Nombre Producto</div>
                                            </div>
                                            <svg class="absolute right-2 z-50 h-6 w-6 -translate-x-4 translate-y-0 transform fill-current stroke-current text-blue-200 dark:text-slate-900"
                                                width="8" height="8">
                                                <rect x="9" y="-8" width="8" height="8" transform="rotate(45)">
                                                </rect>
                                            </svg>
                                        </div>
                                    </div>

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
                                    </div>
                                </div>

                            </div>

                            <div class="w-full self-center pt-4 lg:w-1/6 lg:pt-0">
                                <div class="ml-1">
                                    <div class="text-xl line-through text-gray-500 font-extrabold leading-5 tracking-tight">$34.173,00s</div><span
                                    class="text-[12px] ml-2 rounded bg-green-600 px-2 py-1 align-middle font-bold uppercase text-white">50% OFF</span>
                                </div>
                            </div>

                            <div class="w-full self-center pt-4 lg:w-1/6 lg:pt-0">
                                <div class="ml-1">
                                    <div class="text-xl font-extrabold leading-5 tracking-tight">
                                        <span class="align-middle text-slate-900">$1,234.56</span>

                                    </div>
                                    <div class="text-[13px] text-slate-900">Total Con descuento</div>
                                </div>
                            </div>

                            <div class="w-3/4 self-center pt-4 text-black lg:w-1/6 lg:pt-0">
                                <button type="submit" class="text-3xl right-0 text-gray-400 font-encode font-extrabold hover:text-red-500">
                                    x
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="col-span-12 lg:col-span-5 lg:h-screen flex lg:sticky left-0 top-16 lg:space-y-10 items-center lg:content-center">
            @livewire('shipping-cost')
        </div>

        <script>
            document.getElementById('domicilioButton').addEventListener('click', function() {
                document.getElementById('domicilioForm').classList.remove('hidden');
                document.getElementById('sucursalOptions').classList.add('hidden');
            });

            document.getElementById('sucursalButton').addEventListener('click', function() {
                document.getElementById('sucursalOptions').classList.remove('hidden');
                document.getElementById('domicilioForm').classList.add('hidden');
            });
        </script>

    </div>
@endsection
