@extends('layouts.app')
@section('content')
    <div
        class="grid grid-cols-12 w-full h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-pink-200 top-0 overflow-x-hidden">
        {{-- Rompe la vista --}}
        <form method="POST">
            @csrf
            <input type="hidden" name="item" value="{{ $productItem }}">
            <button type="submit">Añadir al Carrito</button>
        </form>

        <div class="col-span-7 bg-transparent py-20 px-12 items-center">
            <div class="p-4 bg-transparent rounded-lg items-center mr-2 sm:p-8 ">
                <div class="flex justify-between items-center ml-5 mb-4">
                    <h3 class="font-bold font-josefin text-5xl">Lista de Pedidos</h3>
                </div>
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-200">
                        <li class="py-3 sm:py-4 bg-white rounded-xl shadow-xl">
                            <div class="flex items-center space-x-4">
                                <div class="grid grid-cols-6 gap-12">
                                    <div class="flex-shrink-0 ml-5">
                                        <img class="w-14 h-14 rounded-full ml-2"
                                            src="https://flowbite.com/docs/images/people/profile-picture-1.jpg"
                                            alt="Neil image">
                                    </div>
                                    <div class="flex-1 grid-rows-2 col-span-2">
                                        <p class="text-base font-josefin font-bold text-gray-900 truncate ">
                                            Negro
                                        </p>
                                        <div class="rounded-xl items-center w-3/4 font-semibold bg-[#5FA878]">
                                            <div class="absolute pt-1">
                                                <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M10.7581 2.75798L11.9781 3.82548C13.7707 5.39465 14.6667 6.17865 14.6667 7.15281C14.6667 8.12756 13.7707 8.91156 11.9781 10.4801C10.1847 12.0493 9.28874 12.8333 8.17474 12.8333C7.06141 12.8333 6.16474 12.0493 4.37207 10.4807L3.15207 9.41323C2.12207 8.5114 1.60674 8.06106 1.41541 7.47598C1.22341 6.8909 1.38741 6.26965 1.71541 5.02773L1.90407 4.3114C2.17941 3.26606 2.31741 2.7434 2.72607 2.38523C3.13541 2.02765 3.73274 1.9069 4.92741 1.66598L5.74607 1.50031C7.16607 1.2139 7.87541 1.0704 8.54407 1.23781C9.21274 1.40581 9.72807 1.85673 10.7581 2.75798ZM7.43074 8.35798C6.98207 7.96598 6.98541 7.40248 7.25407 6.95623C7.18756 6.87217 7.1568 6.77038 7.16712 6.66854C7.17745 6.56669 7.22821 6.47123 7.3106 6.39873C7.39298 6.32622 7.50179 6.28126 7.61812 6.27164C7.73445 6.26202 7.85096 6.28835 7.94741 6.34606C8.17407 6.24106 8.42274 6.18506 8.67074 6.1874C8.80335 6.18848 8.93003 6.23561 9.02293 6.31842C9.11582 6.40124 9.16731 6.51295 9.16607 6.62898C9.16484 6.74501 9.11097 6.85586 9.01633 6.93714C8.92168 7.01842 8.79402 7.06348 8.66141 7.0624C8.50704 7.06739 8.36115 7.12545 8.25541 7.22398C7.99741 7.44973 8.06474 7.67606 8.13741 7.73965C8.21074 7.80323 8.46874 7.86215 8.72674 7.6364C9.24941 7.17906 10.1521 7.0274 10.7301 7.53315C11.1787 7.92573 11.1754 8.48923 10.9067 8.93548C10.9728 9.01956 11.0033 9.12121 10.9927 9.22284C10.9822 9.32448 10.9314 9.4197 10.8492 9.49203C10.7669 9.56436 10.6583 9.60925 10.5422 9.61894C10.4261 9.62862 10.3098 9.60249 10.2134 9.54506C9.91423 9.68864 9.56722 9.7365 9.23207 9.6804C9.10212 9.65703 8.98809 9.58946 8.91508 9.49253C8.84206 9.39561 8.81604 9.27728 8.84274 9.16356C8.86944 9.04985 8.94667 8.95008 9.05744 8.88619C9.16821 8.8223 9.30345 8.79954 9.43341 8.8229C9.55141 8.84448 9.74207 8.81065 9.90541 8.66773C10.1634 8.4414 10.0961 8.21565 10.0234 8.15206C9.95007 8.08848 9.69207 8.02956 9.43407 8.25531C8.91141 8.71265 8.00874 8.86431 7.43074 8.35798ZM6.68007 6.00423C6.80387 5.89587 6.90206 5.76724 6.96904 5.62568C7.03601 5.48412 7.07047 5.3324 7.07044 5.17919C7.07041 5.02598 7.03589 4.87427 6.96885 4.73273C6.90182 4.59119 6.80358 4.46259 6.67974 4.35427C6.5559 4.24595 6.4089 4.16004 6.24711 4.10143C6.08533 4.04282 5.91194 4.01267 5.73684 4.0127C5.56174 4.01273 5.38836 4.04293 5.2266 4.10159C5.06484 4.16025 4.91787 4.24621 4.79407 4.35456C4.54406 4.5734 4.40364 4.87018 4.40371 5.1796C4.40377 5.48903 4.54431 5.78576 4.79441 6.00452C5.04451 6.22328 5.38368 6.34615 5.73731 6.34609C6.09094 6.34604 6.43006 6.22307 6.68007 6.00423Z"
                                                        fill="white" />
                                                </svg>
                                            </div>
                                            <p class="text-sm text-center ml-3 text-white">
                                                $5.00
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-rows-2">
                                        <p>Cantidad</p>
                                        <p>asdklaskdjl</p>
                                    </div>
                                    <div class="items-center grid-rows-2">
                                        <div>
                                            <p class="text-base font-semibold">Total</p>
                                        </div>
                                        <div>
                                            <p class="text-base font-semibold text-green-500">$0.00</p>
                                        </div>
                                    </div>
                                    <button class="cursor-pointer">
                                        <a
                                            class="text-3xl row-span-2 text-gray-400 font-encode font-extrabold hover:text-red-500">x</a>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="translate-x-2 translate-y-2 rounded-3xl bg-slate-900/30">
                <div class="rounded-3xl -translate-x-2 -translate-y-2 bg-gradient-to-r  from-[#253E99] to-[#2B4DC6]">
                    <div class="grid grid-cols-4 p-6">
                        <div class="col-span-1">
                            <ul class="items-center">
                                <li class="font-josefin font-bold text-lg  text-[#A3B7FF]">Descuentos: <span
                                        class="text-white text-lg ">30%</span></li>
                                <li class="font-josefin font-bold text-lg  text-[#A3B7FF]">Productos: <span
                                        class="text-white text-lg ">7</span></li>
                                <li class="font-josefin font-bold text-lg  text-[#A3B7FF]">Envio: <span
                                        class="text-white text-lg ">15.000</span></li>
                            </ul>
                        </div>
                        <div class="col-span-1 grid grid-rows-2 ml-2">
                            <p class="font-josefin font-bold text-3xl text-white ">Total</p>
                            <p class="font-josefin font-bold text-3xl text-[#6BE64C]"> 500.000</p>
                        </div>
                        <div class="col-span-2 gap-2 grid grid-rows-2 grid-cols-3">
                            <button class="col-span-3 bg-[#11C818] rounded-lg">
                                <p class="text-white text-2xl  font-bold font-josefin py-2 px-5">Comprar</p>
                            </button>
                            <button class="flex items-center bg-black rounded-lg col-span-1">
                                <svg class="" width="33" height="23" viewBox="0 0 33 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_542_1296)">
                                        <path d="M19.1797 17.0518L12.8335 11.1035L19.1797 5.15521M13.7149 11.1035H26.5835"
                                            stroke="white" stroke-width="3" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_542_1296">
                                            <rect width="23" height="33" fill="white"
                                                transform="matrix(0 -1 1 0 0 23)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <p class="font-josefin text-lg text-white font-bold py-2 mr-2">Volver</p>
                            </button>
                            <button class="bg-[#FF6565] rounded-lg col-span-2">
                                <p class="font-josefin text-xl text-white font-bold py-1 px-2">Eliminar Lista</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-5 place-content-center bg-trasparent">
            <div class="grid place-content-center w-11/12 translate-x-2 translate-y-2 rounded-3xl bg-slate-900/30"
                id="cart">
                <div
                    class="rounded-3xl bg-gradient-to-b via-[#2E3366] -translate-x-2 -translate-y-2 from-[#343678] to-[#273053]">
                    <div
                        class="flex flex-col h-3/4 w-full rounded-lg lg:px-8 md:px-7 px-4 lg:py-20 md:py-10 py-6 justify-between ">
                        <form class="flex flex-wrap gap-3 w-full">
                            <p class="text-center font-bold font-josefin text-white text-3xl">Informacion de
                                pago
                            </p>
                            <div class="grid grid-cols-2 gap-10 mb-3">
                                <div class="">
                                    <label for="name"
                                        class="block mb-2 text-sm font-josefin text-gray-900 dark:text-white">Nombre
                                        y apellido</label>
                                    <input type="name" id="name"
                                        class="rounded-full peer px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100"
                                        placeholder="Zanabria Reyes Joaquin" required />
                                </div>
                                <div>
                                    <form class="max-w-sm mx-auto">
                                        <label for="countries"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metodo
                                            de
                                            Pago</label>
                                        <select id="pago"
                                            class="rounded-full peer px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100">
                                            <option>Visa</option>
                                            <option>Master Card</option>
                                            <option>American Express</option>
                                            <option>Mercado Pago</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <label class="relative w-full flex flex-col mb-3">
                                <span class="font-josefin text-white mb-3">Card number</span>
                                <input
                                    class="rounded-full peer pl-12 pr-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100"
                                    type="number" name="card_number" placeholder="0000 0000 0000" />
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-gray-300 h-6 w-6"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </label>
                            <div class="grid grid-cols-3 gap-3">
                                <label class="relative flex-1 flex flex-col col-span-2">
                                    <span class="font-josefin text-white mb-3">Expire date</span>
                                    <input
                                        class="rounded-full peer pl-12 pr-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100"
                                        type="date" name="expire_date" placeholder="MM/YY" />
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-gray-300 h-6 w-6"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </label>
                                <label class="relative flex-1 flex flex-col">
                                    <span class="font-josefin text-white flex items-center gap-3 mb-3">
                                        CVC/CVV
                                        <span class="relative group">
                                            <span
                                                class="hidden group-hover:flex justify-center items-center px-2 py-1 text-xs absolute -right-2 transform translate-x-full -translate-y-1/2 w-max top-1/2 bg-black text-white">
                                                Son los 3 numeros en la parte de atras de la tarjeta!</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </span>
                                    </span>
                                    <input
                                        class="rounded-full peer pl-12 pr-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100"
                                        type="text" name="card_cvc" placeholder="&bull;&bull;&bull;" />
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-gray-300 h-6 w-6"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </label>
                            </div>
                        </form>
                        <p class="font-bold font-josefin text-white text-3xl text-start my-4">Envio
                        </p>
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
        </div>
    </div>
@endsection
