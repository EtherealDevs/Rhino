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
                    @isset($cartItems)
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-200">
                            @foreach ($cartItems as $item)
                                @livewire('cart-item', ['item' => $item])
                            @endforeach
                        </ul>
                    @else
                        <p class="text-2xl sm:text-3xl lg:text-4xl text-gray-300 mt-24 mb-24">No tienes productos en tu carrito
                        </p>
                    @endisset
                </div>
            </div>
        </div>

        <div
            class="col-span-12 lg:col-span-5 lg:h-screen flex lg:sticky left-0 top-16 lg:space-y-10 items-center lg:content-center">
            <div class="flex flex-col w-full lg:block justify-center place-content-center bg-transparent">
                <div class="place-content-center w-full lg:w-11/12 translate-x-0 translate-y-0 lg:translate-x-2 lg:translate-y-2 rounded-none lg:rounded-3xl bg-slate-900/30"
                    id="cart">
                    <div
                        class="rounded-none lg:rounded-3xl w-full bg-gradient-to-b via-[#2E3366] lg:-translate-x-2 lg:-translate-y-2 from-[#343678] to-[#273053]">
                        <div
                            class="flex flex-col w-full rounded-lg px-4 py-6 sm:px-6 sm:py-10 lg:px-8 lg:py-20 justify-between">
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine-ie11.js"
                                integrity="sha512-6m6AtgVSg7JzStQBuIpqoVuGPVSAK5Sp/ti6ySu6AjRDa1pX8mIl1TwP9QmKXU+4Mhq/73SzOk6mbNvyj9MPzQ=="
                                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

                            <div class="w-full max-w-sm flex flex-col mx-auto text-center" x-data="{ selected: 'domicilio' }">
                                <div class="w-full h-auto m-auto shadow flex flex-col p-8 pt-6 rounded-xl">
                                    <h2 class="text-white text-2xl font-bold">Selecciona tu método de envío</h2>

                                    <!-- Botones de selección de envío -->
                                    <div class="relative w-full mt-4 rounded-md border h-10 p-1 bg-gray-200">
                                        <div class="relative w-full h-full flex items-center">
                                            <div @click="selected = 'domicilio'"
                                                class="w-full flex justify-center cursor-pointer">
                                                <button
                                                    :class="{ 'bg-[#2957de] text-white': selected === 'domicilio', 'text-gray-400': selected !== 'domicilio' }"
                                                    class="w-full sm:w-auto rounded-lg py-2 px-4 font-bold">
                                                    ENVÍO A DOMICILIO
                                                </button>
                                            </div>
                                            <div @click="selected = 'sucursal'"
                                                class="w-full flex justify-center cursor-pointer">
                                                <button
                                                    :class="{ 'bg-[#2957de] text-white': selected === 'sucursal', 'text-gray-400': selected !== 'sucursal' }"
                                                    class="w-full sm:w-auto rounded-lg py-2 px-4 font-bold">
                                                    ENVÍO A SUCURSAL
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Indicador de selección -->
                                        <span
                                            :class="{ 'left-1/2 -ml-1 text-gray-800': selected === 'sucursal', 'left-1 text-indigo-600 font-semibold': selected === 'domicilio' }"
                                            x-text="selected === 'domicilio' ? 'Envío a Domicilio' : 'Envío a Sucursal'"
                                            class="bg-white shadow text-sm flex items-center justify-center w-1/2 rounded h-[1.88rem] transition-all duration-150 ease-linear top-[4px] absolute"></span>
                                    </div>

                                    <!-- Formulario de dirección para ENVÍO A DOMICILIO -->
                                    <div x-show="selected === 'domicilio'" class="mt-4">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label for="provincia"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provincia</label>
                                                <select id="provincia"
                                                    class="w-full rounded-full px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100">
                                                    <option>Corrientes</option>
                                                    <option>Chubut</option>
                                                    <option>Namek</option>
                                                    <option>Konoha</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="ciudad"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ciudad</label>
                                                <select id="ciudad"
                                                    class="w-full rounded-full px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100">
                                                    <option>Virasoro</option>
                                                    <option>Corrientes Capital</option>
                                                    <option>American Express</option>
                                                    <option>Mercado Pago</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                                            <div class="sm:col-span-2">
                                                <label
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
                                                <input
                                                    class="w-full rounded-full px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100"
                                                    type="text" name="direccion" placeholder="Escribe tu dirección" />
                                            </div>
                                            <div class="sm:col-span-1">
                                                <label
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código
                                                    Postal</label>
                                                <input
                                                    class="w-full rounded-full px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100"
                                                    type="number" name="codigo_postal" placeholder="C.P." />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Lista de opciones de sucursales para ENVÍO A SUCURSAL -->
                                    <div x-show="selected === 'sucursal'" class="mt-4">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código
                                                    Postal</label>
                                                <input
                                                    class="w-full rounded-full px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100"
                                                    type="number" name="codigo_postal" placeholder="C.P." />
                                            </div>
                                            <div>
                                                <label for="sucursal2"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sucursal</label>
                                                <select id="sucursal2"
                                                    class="w-full rounded-full px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100">
                                                    <option>Sucursal D</option>
                                                    <option>Sucursal E</option>
                                                    <option>Sucursal F</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div
                    class="mt-0 lg:mt-12 translate-x-0 translate-y-0 lg:translate-x-2 lg:translate-y-2 rounded-none lg:rounded-3xl bg-slate-900/30 w-full lg:w-11/12">
                    <div
                        class="rounded-none lg:rounded-3xl lg:-translate-x-2 lg:-translate-y-2 bg-gradient-to-b via-[#2E3366] from-[#273053] to-[#343678]">
                        <div class="grid lg:grid-cols-6 grid-cols-1 p-6">
                            <div class="col-span-2">
                                <ul class="items-center">
                                    <li class="font-josefin font-bold text-lg text-[#A3B7FF]">Productos: <span
                                            class="text-white text-lg">
                                            @isset($cartItems)
                                                {{ count(session('cart')) }}
                                            @endisset
                                        </span></li>
                                    <li class="font-josefin font-bold text-lg text-[#A3B7FF]">Envío: <span
                                            class="text-white text-lg">15.000</span></li>
                                </ul>
                            </div>
                            <div class="col-span-2 grid grid-rows-2 ml-2">
                                @isset($cartItems)
                                    @php
                                        $total = 0;
                                        foreach ($cartItems as $item) {
                                            $itemAmount = $item['amount'];
                                            $discount = $item['item']->product->sale->sale->discount ?? 0;
                                            $price = $item['item']->price();
                                            $priceDiscount = ($price * $discount) / 100;
                                            $total += ($price - $priceDiscount) * $itemAmount;
                                        }
                                    @endphp
                                @endisset
                                <p class="font-josefin font-bold text-2xl sm:text-3xl text-white">Total</p>
                                @isset($cartItems)
                                    <p class="font-josefin font-bold text-2xl sm:text-3xl text-[#6BE64C]">
                                        ${{ number_format($total, 2, ',', '.') }}</p>
                                @else
                                    <p class="font-josefin font-bold text-2xl sm:text-3xl text-[#6BE64C]">NO DATA</p>
                                @endisset
                            </div>
                            <div class="col-span-2 gap-2 lg:mt-0 mt-6 flex flex-col sm:flex-row">
                                <button class="w-full sm:w-auto bg-[#2957de] rounded-lg">
                                    <p class="text-white text-lg font-bold font-josefin py-1 px-4">Comprar</p>
                                </button>

                                <form method="POST" action="{{ route('cart.dropCart') }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="w-full sm:w-auto bg-[#f84e4e] rounded-lg mt-2 sm:mt-0">
                                        <p class="font-josefin text-lg text-white font-bold py-1 px-4">Eliminar Lista</p>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
