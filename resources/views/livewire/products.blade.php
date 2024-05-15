<div class="w-full mt-12">
    {{-- Nabvar --}}
    <div class="w-screen grid grid-cols-6 justify-between mb-8">

        {{-- Search --}}
        <div class="justify-start col-span-1">
            <div class="mt-6">
                <button class="ml-12 p-2 px-4 rounded-full uppercase bg-gray-200">

                    <p class="text-black text-xl font-bold">
                        Buscar
                    </p>
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
        <div class="col-span-1  justify-end w-full">
            <div
                class="grid grid-cols-4 bg-gradient-to-r from-gray-50 to-blue-100 via-gray-100 rounded-full p-2 px-4 mr-12">
                <div class="hidden md:flex items-center space-x-6">
                    @auth
                        <div class="ml-4 flex items-center md:ml-6">
                            <div>
                                Like
                            </div>
                            <div>
                                Search
                            </div>
                            <div>
                                <a href="/cart">
                                    Cart
                                </a>

                            </div>
                            <div class="relative" x-data="{ open: false }">
                                <div class=" border-4 border-stone-950 rounded-full p-1">
                                    <button x-on:click="open = !open" type="button"
                                        class="flex items-center text-sm font-medium  text-white ">
                                        <img class="h-6 w-6 rounded-full" src="{{ auth()->user()->profile_photo_url }}"
                                            alt="">
                                    </button>
                                </div>

                                <div x-show="open" x-on:click.away="open = false"
                                    class="absolute mt-6  -right-6 2xl:-right-14 w-48 bg-blue-800 divide-y divide-blue-600 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
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
                        <a href="{{ route('login') }}"
                            class="text-gray-300 hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Iniciar
                            Sesión</a>
                        <a href="{{ route('register') }}"
                            class="text-gray-300 hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Registrarme</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>


    {{-- Products --}}
    <div class="h-screen w-screen bg-blue-200 grid grid-cols-6 justify-between mx-auto">

        {{-- Sidebar --}}
        <div class="font-poppins flex antialiased col-span-1">
            <div id="view" class="h-full w-screen flex flex-row">
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
                    <div class="space-y-6 md:space-y-10 mt-10">
                        <h2 class="hidden md:block font-bold text-sm md:text-xl text-center">
                            Categorias<span class="text-teal-600">.</span>
                        </h2>

                        <div class="flex flex-col space-y-2 space-x-10">
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out">
                                    <span class="">Remeras</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">Chombas</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">Camisas</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">Pantalones</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">Buzos</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">Zapatillas</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">Combos</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">Users</span>
                                </a>
                            </div>
                        </div>

                        <h2 class="hidden md:block font-bold text-sm md:text-xl text-center">
                            Colecciones<span class="text-teal-600">.</span>
                        </h2>

                        <div class="flex flex-col space-y-2 space-x-10">
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out">
                                    <span class="">Street</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">Verano</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">Elegance</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">Invierno</span>
                                </a>
                            </div>
                        </div>

                        <h2 class="hidden md:block font-bold text-sm md:text-xl text-center">
                            Tallas<span class="text-teal-600">.</span>
                        </h2>

                        <div class="flex flex-col space-y-2 space-x-10">
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out">
                                    <span class="">S</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">M</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">L</span>
                                </a>
                            </div>
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                                    <span class="">XL</span>
                                </a>
                            </div>
                        </div>


                        <h2 class="hidden md:block font-bold text-sm md:text-xl text-center">
                            Precio<span class="text-teal-600">.</span>
                        </h2>

                        <div class="flex flex-col space-y-2 space-x-10">
                            <div>
                                <a href=""
                                    class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-blue-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out">
                                    <span class="">Precio</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content (Productos) --}}
        <div class="col-span-5 mx-auto mt-3">
            <div class="flex">
                <div class="grid grid-cols-4 gap-10">
                    <!-- component -->
                    <div class="w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div
                            class="relative mx-3 mt-3 h-32 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                            <img src="https://images.unsplash.com/photo-1629367494173-c78a56567877?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=927&amp;q=80"
                                class="h-full w-full object-cover" />
                        </div>
                        <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-6">
                            <div class=" flex items-center justify-between">
                                <p
                                    class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                    Apple AirPods
                                </p>
                                <p
                                    class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                    $95.00
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- component -->
                    <div class="w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div
                            class="relative mx-3 mt-3 h-32 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                            <img src="https://images.unsplash.com/photo-1629367494173-c78a56567877?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=927&amp;q=80"
                                class="h-full w-full object-cover" />
                        </div>
                        <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-6">
                            <div class=" flex items-center justify-between">
                                <p
                                    class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                    Apple AirPods
                                </p>
                                <p
                                    class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                    $95.00
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- component -->
                    <div class="w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div
                            class="relative mx-3 mt-3 h-32 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                            <img src="https://images.unsplash.com/photo-1629367494173-c78a56567877?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=927&amp;q=80"
                                class="h-full w-full object-cover" />
                        </div>
                        <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-6">
                            <div class=" flex items-center justify-between">
                                <p
                                    class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                    Apple AirPods
                                </p>
                                <p
                                    class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                    $95.00
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- component -->
                    <div class="w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div
                            class="relative mx-3 mt-3 h-32 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                            <img src="https://images.unsplash.com/photo-1629367494173-c78a56567877?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=927&amp;q=80"
                                class="h-full w-full object-cover" />
                        </div>
                        <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-6">
                            <div class=" flex items-center justify-between">
                                <p
                                    class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                    Apple AirPods
                                </p>
                                <p
                                    class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                    $95.00
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
