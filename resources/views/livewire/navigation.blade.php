<div class="sticky top-0 min-h-full z-50">
    <nav class=" bg-white z-50 h-18 drop-shadow-xl">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">

                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="/home" class="text-gray-800 font-black px-3 py-2 text-sm"
                                aria-current="page">Inicio</a>
                            <a href="/products" class="text-gray-800 font-black px-3 py-2 text-sm">Productos</a>
                            <a href="/about" class="text-gray-800 font-black px-3 py-2 text-sm">Nosotros</a>
                            <a href="/contact" class="text-gray-800 font-black px-3 py-2 text-sm">Contacto</a>
                        </div>
                    </div>
                    <div class="flex-shrink-0 flex justify-center bg-white py-6 rounded-full ml-48">
                        <img class="px-8 w-48 mt-8" src="/img/rino-blue.png" alt="Your Company">
                    </div>
                </div>
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
        <div class="md:hidden" x-show="open" x-on:click.away="open = false">
            <div class="grid grid-cols-2 gap-4 p-4">
                <!-- Enlaces principales en la primera columna a la derecha -->
                <div class="text-left">
                    <a href="/home"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                        x-on:click="open = !open">Inicio</a>
                    <a href="/about"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                        x-on:click="open = !open">Nosotros</a>
                    <a href="/posts"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                        x-on:click="open = !open">Blog</a>
                    <a href="/contact"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                        x-on:click="open = !open">Contactanos</a>
                </div>
                <!-- Botones de inicio de sesión y registro en la segunda columna a la izquierda -->
                <div class="text-right">
                    <div class="flex flex-col space-y-2">
                        @auth
                            <!-- Bloque de autenticación para usuarios autenticados -->
                            <div class="ml-4 items-center">
                                <div class="relative" x-data="{ open: false }">
                                    <a href="{{ route('profile.show') }}"
                                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                                        role="menuitem" tabindex="-1" id="user-menu-item-0">Tu Perfil</a>
                                   
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                                            role="menuitem" tabindex="-1" id="user-menu-item-2"
                                            @click.prevent="$root.submit();">Cerrar Sesion</a>
                                    </form>
                                </div>
                            </div>
                        @else
                            <!-- Bloque de inicio de sesión y registro para usuarios no autenticados -->
                            <div class="ml-4 flex items-center">
                                <a href="{{ route('login') }}"
                                    class="text-gray-300 hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Iniciar
                                    Sesión</a>
                                <a href="{{ route('register') }}"
                                    class="text-gray-300 hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Registrarme</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
