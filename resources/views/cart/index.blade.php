@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 w-full bg-gradient-to-br from-white via-white to-gray-100 top-0">
        <div class="col-span-7 bg-transparent py-20 px-12 items-center">
            <div class="p-4 bg-transparent rounded-lg items-center mr-2 sm:p-8">
                <div class="flex justify-between items-center ml-5 mb-4">
                    <h3 class="font-bold font-josefin text-3xl lg:text-5xl">Mi Carrito</h3>
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
                    <p class="text-4xl text-gray-300 mt-24 mb-24">No tenes Productos en tu carrito</p>
                    @endisset
                </div>
            </div>
        </div>
        <div class="col-span-5 h-screen flex sticky left-0 top-16 space-y-10 items-center content-center">
            <div class="flex lg:block justify-center place-content-center bg-trasparent">
                <div class="grid place-content-center w-11/12 translate-x-2 translate-y-2 rounded-3xl bg-slate-900/30"
                    id="cart">
                    <div
                        class="rounded-3xl bg-gradient-to-b via-[#2E3366] -translate-x-2 -translate-y-2 from-[#343678] to-[#273053]">
                        <div
                            class="flex flex-col h-3/4 w-full rounded-lg lg:px-8 md:px-7 px-4 lg:py-20 md:py-10 py-6 justify-between ">
                            <h2 class="font-bold font-josefin text-white text-3xl text-start my-4">Envio
                            </h2>
                            <div class="grid grid-cols-2">
                                <div class="">
                                    <form class="max-w-sm">
                                        <label for="countries"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provincia</label>
                                        <select id="pago"
                                            class="rounded-full peer px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100">
                                            <option>Corrientes</option>
                                            <option>Chubut</option>
                                            <option>Namek</option>
                                            <option>Konoha</option>
                                        </select>
                                    </form>
                                </div>
                                <div>
                                    <form class="max-w-sm">
                                        <label for="countries"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ciudad</label>
                                        <select id="pago"
                                            class="rounded-full peer px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100">
                                            <option>Virasoro</option>
                                            <option>Corrientes Capital</option>
                                            <option>American Express</option>
                                            <option>Mercado Pago</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="col-span-2 ">
                                    <label class="relative w-full flex flex-col mb-3">
                                        <span class="font-josefin text-white mb-3">Card number</span>
                                        <input
                                            class="rounded-full peer pr-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100"
                                            type="text" name="direction" placeholder="Escribe tu direccion" />
                                    </label>
                                </div>
                                <div class=" col-span-1">
                                    <label class="relative w-full flex flex-col mb-3">
                                        <span class="font-josefin text-white mb-3">Codigo Postal</span>
                                        <input
                                            class="rounded-full peer pr-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100"
                                            type="number" name="postal" placeholder="C.P" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 translate-x-2 translate-y-2 rounded-3xl bg-slate-900/30 w-11/12">
                    <div class="rounded-3xl -translate-x-2 -translate-y-2 bg-gradient-to-b via-[#2E3366] from-[#343678] to-[#273053]">
                        <div class="grid lg:grid-cols-4 grid-cols-1 p-6">
                            <div class="col-span-1">
                                <ul class="items-center">
                                    <li class="font-josefin font-bold text-lg  text-[#d1d9fb]">Descuentos: <span
                                            class="text-white text-lg ">30%</span></li>
                                    <li class="font-josefin font-bold text-lg  text-[#A3B7FF]">Productos: <span
                                            class="text-white text-lg ">@isset($cartItems){{ count(session('cart')) }}@endisset</span></li>
                                    <li class="font-josefin font-bold text-lg  text-[#A3B7FF]">Envio: <span
                                            class="text-white text-lg ">15.000</span></li>
                                </ul>
                            </div>
                            <div class="col-span-1 grid grid-rows-2 ml-2">
                                @isset($cartItems)
                                @php
                                $total = 0;
                                    foreach ($cartItems as $item) {
                                        $itemPrice = $item['item']->price();
                                        $itemAmount = $item['amount'];
                                        $total += $itemPrice * $itemAmount;
                                    }
                                @endphp
                                @endisset
                                <p class="font-josefin font-bold text-3xl text-white ">Total</p>
                                @isset($cartItems)    
                                <p class="font-josefin font-bold text-3xl text-[#6BE64C]"> ${{number_format($total, 2, ',', '.')}}</p>
                                @else
                                <p class="font-josefin font-bold text-3xl text-[#6BE64C]">NO DATA</p>
                                @endisset
                            </div>
                            <div class="col-span-2 gap-2 lg:mt-0 mt-6">
                                <a href="{{route('checkout.delivery')}}" class="col-span-3 bg-[#11C818] rounded-lg">
                                    <p class="text-white text-lg font-bold font-josefin py-2 px-5">Comprar</p>
                                </a>
                                
                                <form method="POST" action="{{route('cart.dropCart')}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-[#FF6565] rounded-lg col-span-2">
                                        <p class="font-josefin text-xl text-white font-bold py-1 px-2">Eliminar Lista</p>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
