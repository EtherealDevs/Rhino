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
                <p class="text-2xl sm:text-3xl lg:text-4xl text-gray-300 mt-24 mb-24">No tienes productos en tu carrito</p>
                @endisset
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-5 lg:h-screen flex lg:sticky left-0 top-16 lg:space-y-10 items-center lg:content-center">
        <div class="flex flex-col w-full lg:block justify-center place-content-center bg-transparent">
            <div class="place-content-center w-full lg:w-11/12 translate-x-0 translate-y-0 lg:translate-x-2 lg:translate-y-2 rounded-none lg:rounded-3xl bg-slate-900/30" id="cart">
                <div class="rounded-none lg:rounded-3xl w-full bg-gradient-to-b via-[#2E3366] lg:-translate-x-2 lg:-translate-y-2 from-[#343678] to-[#273053]" >
                    <div class="flex flex-col w-full rounded-lg px-4 py-6 sm:px-6 sm:py-10 lg:px-8 lg:py-20 justify-between">
                        <h2 class="font-bold font-josefin text-white text-2xl sm:text-3xl my-4">Envío</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="provincia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provincia</label>
                                <select id="provincia" class="w-full rounded-full px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100">
                                    <option>Corrientes</option>
                                    <option>Chubut</option>
                                    <option>Namek</option>
                                    <option>Konoha</option>
                                </select>
                            </div>
                            <div>
                                <label for="ciudad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ciudad</label>
                                <select id="ciudad" class="w-full rounded-full px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100">
                                    <option>Virasoro</option>
                                    <option>Corrientes Capital</option>
                                    <option>American Express</option>
                                    <option>Mercado Pago</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                            <div class="sm:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
                                <input class="w-full rounded-full px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100" type="text" name="direccion" placeholder="Escribe tu dirección" />
                            </div>
                            <div class="sm:col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código Postal</label>
                                <input class="w-full rounded-full px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100" type="number" name="codigo_postal" placeholder="C.P." />
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
</div>
@endsection
