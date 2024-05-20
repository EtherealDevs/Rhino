@extends('layouts.app')
@section('content')
    <!-- component -->
    <div class="w-full h-full bg-gradient-to-r from-gray-50 to-blue-100 via-gray-100 top-0 overflow-y-auto overflow-x-hidden fixed sticky-0"
        id="chec-div">
        <div class="w-full absolute z-10 right-0 overflow-x-hidden transform translate-x-0 transition ease-in-out duration-700"
            id="checkout">
            <div class="flex items-end lg:flex-row flex-col justify-end mr-10 mt-10" id="cart">
                <div
                    class="lg:w-4/12 md:w-8/12 w-full rounded-lg shadow-2xl bg-gradient-to-b via-[#2E3366] from-[#343678] to-[#273053] ">
                    <div
                        class="flex flex-col h-3/4 rounded-lg lg:px-8 md:px-7 px-4 lg:py-20 md:py-10 py-6 justify-between overflow-y-auto">
                        <form class="flex flex-wrap gap-3 w-full p-5">
                            <p class="text-center font-bold font-josefin text-white text-3xl">Informacion de
                                pago
                            </p>
                            <div class="grid col-span-2">
                                <div class="mb-5 col">
                                    <label for="name"
                                        class="block mb-2 text-sm font-josefin text-gray-900 dark:text-white">Nombre
                                        y apellido</label>
                                    <input type="name" id="name"
                                        class="rounded-md peer px-2 py-2 border-2 border-gray-200 placeholder-gray-300"
                                        placeholder="Zanabria Reyes Joaquin" required />
                                </div>
                                <div class="col">
                                    <label class="relative w-full flex flex-col">
                                        <span class="font-josefin text-white mb-3">Card number</span>
                                        <input
                                            class="rounded-md peer pl-12 pr-2 py-2 border-2 border-gray-200 placeholder-gray-300"
                                            type="text" name="card_number" placeholder="0000 0000 0000" />
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-black peer-placeholder-shown:text-gray-300 h-6 w-6"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                    </label>
                                </div>
                            </div>
                            <label class="relative flex-1 flex flex-col">
                                <span class="font-josefin text-white mb-3">Expire date</span>
                                <input class="rounded-md peer pl-12 pr-2 py-2 border-2 border-gray-200 placeholder-gray-300"
                                    type="text" name="expire_date" placeholder="MM/YY" />
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-black peer-placeholder-shown:text-gray-300 h-6 w-6"
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
                                <input class="rounded-md peer pl-12 pr-2 py-2 border-2 border-gray-200 placeholder-gray-300"
                                    type="text" name="card_cvc" placeholder="&bull;&bull;&bull;" />
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-black peer-placeholder-shown:text-gray-300 h-6 w-6"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </label>
                        </form>
                        <button onclick="checkoutHandler1(true)"
                            class="text-base leading-none w-full py-5 bg-gray-800 border-gray-800 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 text-white dark:hover:bg-gray-700">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
