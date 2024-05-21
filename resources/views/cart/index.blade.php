@extends('layouts.app')
@section('content')
    <!-- component -->
    <div
        class="w-full h-screen grid grid-col-3 bg-[url(/Users/mateodans/programacion/Ethereal-Devs/Rhino/public/img/FondoCart.svg)] top-0 overflow-x-hidden">
        <div>
            <div class="max-w-2xl mx-auto">
                <div class="p-4  bg-transparent rounded-lg border shadow-md sm:p-8 ">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold font-josefin text-5xl">Lista de Pedidos</h3>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                            View all
                        </a>
                    </div>
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4 bg-white rounded-xl">
                                <div class="flex items-center space-x-4">
                                    <div class="grid grid-cols-4 gap-2">
                                        <div class="flex-shrink-0">
                                            <img class="w-14 h-14 rounded-full ml-2"
                                                src="https://flowbite.com/docs/images/people/profile-picture-1.jpg"
                                                alt="Neil image">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-base font-josefin font-bold text-gray-900 truncate ">
                                                Negro
                                            </p>
                                            <div class="rounded-xl w-16 font-semibold bg-[#5FA878]">
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15.2 14.4C14.1455 14.4 13.3 15.201 13.3 16.2C13.3 16.6774 13.5002 17.1352 13.8565 17.4728C14.2128 17.8104 14.6961 18 15.2 18C15.7039 18 16.1872 17.8104 16.5435 17.4728C16.8998 17.1352 17.1 16.6774 17.1 16.2C17.1 15.7226 16.8998 15.2648 16.5435 14.9272C16.1872 14.5896 15.7039 14.4 15.2 14.4ZM0 0V1.8H1.9L5.32 8.631L4.028 10.836C3.8855 11.088 3.8 11.385 3.8 11.7C3.8 12.1774 4.00018 12.6352 4.3565 12.9728C4.71282 13.3104 5.19609 13.5 5.7 13.5H17.1V11.7H6.099C6.03601 11.7 5.9756 11.6763 5.93106 11.6341C5.88652 11.5919 5.8615 11.5347 5.8615 11.475C5.8615 11.43 5.871 11.394 5.89 11.367L6.745 9.9H13.8225C14.535 9.9 15.162 9.522 15.485 8.973L18.886 3.15C18.9525 3.006 19 2.853 19 2.7C19 2.4613 18.8999 2.23239 18.7218 2.0636C18.5436 1.89482 18.302 1.8 18.05 1.8H3.9995L3.1065 0M5.7 14.4C4.6455 14.4 3.8 15.201 3.8 16.2C3.8 16.6774 4.00018 17.1352 4.3565 17.4728C4.71282 17.8104 5.19609 18 5.7 18C6.20391 18 6.68718 17.8104 7.0435 17.4728C7.39982 17.1352 7.6 16.6774 7.6 16.2C7.6 15.7226 7.39982 15.2648 7.0435 14.9272C6.68718 14.5896 6.20391 14.4 5.7 14.4Z"
                                                        fill="white" />
                                                </svg>
                                                <p class="text-sm text-center text-white">
                                                    $5.00
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <p>Cantidad</p>
                                        </div>
                                        <div class=" items-center grid-rows-2">
                                            <div>
                                                <p class="text-base font-semibold">Total</p>
                                            </div>
                                            <div>
                                                <p class="text-base font-semibold text-green-500">$320</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-3.jpg"
                                            alt="Bonnie image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Bonnie Green
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $3467
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                            alt="Michael image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Michael Gough
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $67
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full absolute right-0 overflow-x-hidden transform translate-x-0 transition ease-in-out duration-700">
            <div class="flex items-end lg:flex-row flex-col bg-transparent justify-end mr-10 mt-10" id="cart">
                <div
                    class="lg:w-4/12 md:w-8/12 w-full rounded-3xl bg-gradient-to-b via-[#2E3366] from-[#343678] to-[#273053]">
                    <div
                        class="flex flex-col h-3/4 rounded-lg lg:px-8 md:px-7 px-4 lg:py-20 md:py-10 py-6 justify-between ">
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
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metodo de
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
    </div>
@endsection
