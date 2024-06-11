<section class="">
    <div class="w-full mt-12">
        {{-- Nabvar --}}
        <div class="w-full grid grid-cols-1 justify-between mb-8">

            {{-- Search --}}
            <div class="justify-start col-span-1">
                <div class="mt-6">
                    <button class="ml-12 flex p-2 px-4 rounded-full uppercase bg-gray-200">
                        <p class="text-black text-xl font-bold">
                            Buscar
                        </p>
                        <i class="ml-2 ri-search-eye-line text-2xl font-bold"></i>
                    </button>
                </div>
            </div>

            {{-- Collection --}}
            <div class="mx-auto col-span-4">
                <h2 class="w-12 border-b-2 text-2xl font-extrabold italic border-gray-400"> Coleccion</h2>
                <div class="grid grid-cols-4 gap-6 mt-3">
                    <div class="broder border-r-2 italic font-semibold">Verano</div>
                    <div class="broder border-r-2 italic font-semibold border-gray-300">Invierno</div>
                    <div class="broder border-r-2 italic font-semibold border-gray-300">Street</div>
                    <div class="broder italic font-semibold border-gray-300">Elegance</div>
                </div>
            </div>


            {{-- User Information --}}
            {{-- <div class="col-span-1 justify-end w-full">
            <div
                class="grid grid-cols-4 bg-gradient-to-r from-gray-50 to-blue-100 via-gray-100 rounded-full p-2 px-4 mr-12">
                <div class="hidden md:flex items-center space-x-6">
                    @auth
                        <div class="ml-4 flex items-center md:ml-6">
                            <button>
                                <a href="">
                                    <svg width="18" height="16" viewBox="0 0 17 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.5 16L7.2675 14.849C2.89 10.7771 0 8.08283 0 4.79564C0 2.10136 2.057 0 4.675 0C6.154 0 7.5735 0.706267 8.5 1.81362C9.4265 0.706267 10.846 0 12.325 0C14.943 0 17 2.10136 17 4.79564C17 8.08283 14.11 10.7771 9.7325 14.849L8.5 16Z"
                                            fill="red" />
                                    </svg>
                                </a>
                            </button>
                            <button>
                                <a href="/cart">
                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.2 14.4C14.1455 14.4 13.3 15.201 13.3 16.2C13.3 16.6774 13.5002 17.1352 13.8565 17.4728C14.2128 17.8104 14.6961 18 15.2 18C15.7039 18 16.1872 17.8104 16.5435 17.4728C16.8998 17.1352 17.1 16.6774 17.1 16.2C17.1 15.7226 16.8998 15.2648 16.5435 14.9272C16.1872 14.5896 15.7039 14.4 15.2 14.4ZM0 0V1.8H1.9L5.32 8.631L4.028 10.836C3.8855 11.088 3.8 11.385 3.8 11.7C3.8 12.1774 4.00018 12.6352 4.3565 12.9728C4.71282 13.3104 5.19609 13.5 5.7 13.5H17.1V11.7H6.099C6.03601 11.7 5.9756 11.6763 5.93106 11.6341C5.88652 11.5919 5.8615 11.5347 5.8615 11.475C5.8615 11.43 5.871 11.394 5.89 11.367L6.745 9.9H13.8225C14.535 9.9 15.162 9.522 15.485 8.973L18.886 3.15C18.9525 3.006 19 2.853 19 2.7C19 2.4613 18.8999 2.23239 18.7218 2.0636C18.5436 1.89482 18.302 1.8 18.05 1.8H3.9995L3.1065 0M5.7 14.4C4.6455 14.4 3.8 15.201 3.8 16.2C3.8 16.6774 4.00018 17.1352 4.3565 17.4728C4.71282 17.8104 5.19609 18 5.7 18C6.20391 18 6.68718 17.8104 7.0435 17.4728C7.39982 17.1352 7.6 16.6774 7.6 16.2C7.6 15.7226 7.39982 15.2648 7.0435 14.9272C6.68718 14.5896 6.20391 14.4 5.7 14.4Z"
                                            fill="black" />
                                    </svg>
                                </a>
                            </button>
                            <div class="relative" x-data="{ open: false }">
                                <div class=" border-4 border-stone-950 rounded-full p-1">
                                    <button x-on:click="open = !open" type="button"
                                        class="flex items-center text-sm font-medium  text-white ">
                                        <img class="h-6 w-6 rounded-full" src="{{ auth()->user()->profile_photo_url }}"
                                            alt="">
                                    </button>
                                </div>

                                <div x-show="open" x-on:click.away="open = false"
                                    class="absolute mt-6 -right-6 2xl:-right-14 w-48 bg-blue-800 divide-y divide-blue-600 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1">
                                    <a href="{{ route('profile.show') }}"
                                        class="flex justify-end px-4 py-2 text-sm text-white font-extralight"
                                        role="menuitem" tabindex="-1" id="user-menu-item-0">Tu Perfil</a>

                                    @csrf
                                    @auth
                                        @can('admin')
                                            <a href="{{ route('index') }}"
                                                class="flex justify-end px-4 py-2 text-sm text-white font-extralight"
                                                role="menuitem" tabindex="-1" id="user-menu-item-1">Panel de Administracion</a>
                                        @endcan
                                    @endauth
                                    @csrf
                                    @auth
                                        @can('client')
                                            <a href="/client" class="flex justify-end px-4 py-2 text-sm text-white font-extralight"
                                                role="menuitem" tabindex="-1" id="user-menu-item-1">Panel de Cliente</a>
                                        @endcan
                                    @endauth

                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            class="flex justify-end px-4 py-2 text-sm text-white font-extralight"
                                            role="menuitem" tabindex="-1" id="user-menu-item-2"
                                            @click.prevent="$root.submit();">Cerrar Sesion</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-end items-center space-x-2">
                            <a href="{{ route('login') }}"
                                class="text-black  hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Iniciar
                                Sesión</a>
                            <a href="{{ route('register') }}"
                                class="text-black hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Registrarme</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div> --}}

        </div>


        {{-- Products --}}
        <div class="h-full w-full bg-white grid grid-cols-4 lg:grid-cols-6 justify-between mx-auto">
            {{-- Sidebar --}}
            <div class="lg:visible font-poppins lg:flex antialiased col-span-1">
                <div id="view" class="h-full w-full flex flex-row">
                    <button
                        class="p-2 border-2 bg-white rounded-md border-gray-200 shadow-lg text-gray-500 focus:bg-teal-500 focus:outline-none focus:text-white absolute top-0 left-0 sm:hidden">
                        <svg class="w-5 h-5 fill-current" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div id="sidebar"
                        class="bg-white h-screen md:block shadow-xl px-3 w-30 md:w-60 lg:w-60 overflow-x-hidden transition-transform duration-300 ease-in-out">
                        <div class="space-y-1 md:space-y-4 mt-10">
                            <h2 class="hidden md:block font-bold text-sm md:text-xl text-center">
                                Categorias
                            </h2>

                            <div class="flex flex-col pl-10 ">
                                <div>
                                    <a href=""
                                        class="text-base text-gray-700 py-2 px-1 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                        <span class="">Remeras (15)</span>
                                    </a>
                                </div>
                                <div>
                                    <a href=""
                                        class="text-base text-gray-700 py-2 px-1 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                        <span class="">Chombas (9)</span>
                                    </a>
                                </div>
                                <div>
                                    <a href=""
                                        class="text-base text-gray-700 py-2 px-1 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                        <span class="">Camisas (8)</span>
                                    </a>
                                </div>
                                <div>
                                    <a href=""
                                        class="text-base text-gray-700 py-2 px-1 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                        <span class="">Pantalones (7)</span>
                                    </a>
                                </div>
                                <div>
                                    <a href=""
                                        class="text-base text-gray-700 py-2 px-1 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                        <span class="">Buzos (3)</span>
                                    </a>
                                </div>
                                <div>
                                    <a href=""
                                        class="text-base text-gray-700 py-2 px-1 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                        <span class="">Zapatillas (2)</span>
                                    </a>
                                </div>
                                <div class="border-b-black ">
                                    <a href=""
                                        class="text-base text-gray-700 py-2 px-1 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                        <span class="">Combos (0)</span>
                                    </a>
                                </div>
                            </div>

                            <h2 class="hidden md:block font-bold text-sm md:text-xl text-center">
                                Tallas
                            </h2>

                            <div class="flex flex-col pl-10">
                                <div>
                                    <a href=""
                                        class="text-base text-gray-700 py-2 px-2 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                        <span class="">S</span>
                                    </a>
                                </div>
                                <div>
                                    <a href=""
                                        class="text-base text-gray-700 py-2 px-2 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                        <span class="">M</span>
                                    </a>
                                </div>
                                <div>
                                    <a href=""
                                        class="ttext-base text-gray-700 py-2 px-2 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                        <span class="">L</span>
                                    </a>
                                </div>
                                <div>
                                    <a href=""
                                        class="text-base text-gray-700 py-2 px-2 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                        <span class="">XL</span>
                                    </a>
                                </div>
                            </div>

                            <h2 class="hidden md:block font-bold text-sm md:text-xl text-center">
                                Precio
                            </h2>

                            <div class="flex flex-col space-y-2 space-x-10">
                                <div>
                                    <p class="text-base text-dark">Minimo</p>
                                    <form class="max-w-[24rem] mx-auto">
                                        <div class="flex mb-2">
                                            <label for="currency-input"
                                                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your
                                                Email</label>
                                            <div class="relative w-full">
                                                <input type="number" id="currency-input"
                                                    class="block p-2.5 w-full z-20 text-sm  bg-white border-gray-300 rounded-lg dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-600"
                                                    placeholder="Enter amount" value="500" required />
                                            </div>
                                        </div>
                                        <div class="relative">
                                            <label for="price-range-input" class="sr-only">Default range</label>
                                            <input id="price-range-input" type="range" value="500" min="100"
                                                max="1500"
                                                class="w-full h-2 bg-gray-500 rounded-lg appearance-none cursor-pointer">
                                        </div>
                                    </form>
                                    <p class="mt-5 text-base text-dark">Maximo
                                    </p>
                                    <form class="max-w-[24rem] mx-auto">
                                        <div class="flex mb-2">
                                            <label for="currency-input"
                                                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your
                                                Email</label>
                                            <div class="relative w-full">
                                                <input type="number" id="currency-input"
                                                    class="block p-2.5 w-full z-20 text-sm  bg-white border-gray-300 rounded-lg  dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-600""
                                                    placeholder="Enter amount" value="500000" required />
                                            </div>
                                        </div>
                                        <div class="relative">
                                            <label for="price-range-input" class="sr-only">Default range</label>
                                            <input id="price-range-input" type="range" value="1000"
                                                min="100" max="1500"
                                                class="w-full h-2 bg-gray-500 rounded-lg appearance-none cursor-pointer">
                                        </div>
                                    </form>
                                    <a href=""
                                        class="mt-5 text-base text-center  border font-medium text-white py-2 px-2 bg-blue-800  border-blue-800  hover:text-base rounded-md transition duration-150 ease-in-out">
                                        <span class="">Filtrar</span>
                                        <i class="ri-filter-fill"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content (Productos) --}}
            <div class="col-span-5 mx-auto ml-2 mt-3">
                <div class="flex mx-auto w-full">
                    <div class="grid grid-cols-2 mx-auto lg:grid-cols-4 gap-1 lg:gap-10">
                        @foreach ($products as $product)
                        @php
                            $item = $product->items()->first();
                        @endphp
                            @livewire('product-card', ['product' => $product, 'item' => $item])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
