@extends('layouts.app')
@section('content')
    <!-- component -->
    <div class="w-full h-full bg-gradient-to-r from-gray-50 to-blue-100 via-gray-100 top-0 overflow-y-auto overflow-x-hidden fixed sticky-0"
        id="chec-div">
        <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
        <div class="w-full absolute z-10 right-0 h-full overflow-x-hidden transform translate-x-0 transition ease-in-out duration-700"
            id="checkout">
            <div class="flex items-end lg:flex-row flex-col justify-end" id="cart">
                <div class="lg:w-96 md:w-8/12 w-full bg-gradient-to-b via-[#2E3366] from-[#343678] to-[#273053] h-full">
                    <div
                        class="flex flex-col lg:h-3/4 rounded-lg h-auto lg:px-8 md:px-7 px-4 lg:py-20 md:py-10 py-6 justify-between overflow-y-auto">
                        <div>
                            <p class="lg:text-4xl text-3xl font-black leading-9 text-gray-800 dark:text-white">Informacion
                                de Pago</p>
                            <div class="flex items-center justify-between pt-16">
                                <p class="text-base leading-none text-gray-800 dark:text-white">Subtotal</p>
                                <p class="text-base leading-none text-gray-800 dark:text-white">,000</p>
                            </div>
                            <div class="flex items-center justify-between pt-5">
                                <p class="text-base leading-none text-gray-800 dark:text-white">Shipping</p>
                                <p class="text-base leading-none text-gray-800 dark:text-white"></p>
                            </div>
                            <div class="flex items-center justify-between pt-5">
                                <p class="text-base leading-none text-gray-800 dark:text-white">Tax</p>
                                <p class="text-base leading-none text-gray-800 dark:text-white"></p>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center pb-6 justify-between lg:pt-5 pt-20">
                                <p class="text-2xl leading-normal text-gray-800 dark:text-white">Total</p>
                                <p class="text-2xl font-bold leading-normal text-right text-gray-800 dark:text-white">,240
                                </p>
                            </div>
                            <button onclick="checkoutHandler1(true)"
                                class="text-base leading-none w-full py-5 bg-gray-800 border-gray-800 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 text-white dark:hover:bg-gray-700">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            /* width */
            #scroll::-webkit-scrollbar {
                width: 1px;
            }

            /* Track */
            #scroll::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            /* Handle */
            #scroll::-webkit-scrollbar-thumb {
                background: rgb(133, 132, 132);
            }
        </style>
    </div>
    <script>
        let checkout = document.getElementById("checkout");
        let checdiv = document.getElementById("chec-div");
        let flag3 = false;
        const checkoutHandler = () => {
            if (!flag3) {
                checkout.classList.add("translate-x-full");
                checkout.classList.remove("translate-x-0");
                setTimeout(function() {
                    checdiv.classList.add("hidden");
                }, 1000);
                flag3 = true;
            } else {
                setTimeout(function() {
                    checkout.classList.remove("translate-x-full");
                    checkout.classList.add("translate-x-0");
                }, 1000);
                checdiv.classList.remove("hidden");
                flag3 = false;
            }
        };
    </script>
@endsection
