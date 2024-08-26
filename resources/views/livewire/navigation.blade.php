<div class="sticky top-0 min-h-full z-50">
    <nav class="bg-white z-10 h-18 drop-shadow-xl">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-12 lg:h-16 justify-start lg:justify-between relative">
                <!-- Barra de subrayado -->
                <div class="underline-navbar absolute bottom-0 left-0 h-1 w-1/2 bg-black transition-all duration-300">
                </div>

                <div class="flex items-center">
                    <div class="hidden md:block">
                        <div class="flex items-baseline space-x-4">
                            <a href="/" class="nav-item text-gray-800 font-black px-3 py-2 text-sm"
                                aria-current="page">Inicio</a>
                            <a href="/products"
                                class="nav-item text-gray-800 font-black px-3 py-2 text-sm">Productos</a>
                            <a href="/about" class="nav-item text-gray-800 font-black px-3 py-2 text-sm">Nosotros</a>
                            <a href="/contact" class="nav-item text-gray-800 font-black px-3 py-2 text-sm">Contacto</a>
                        </div>
                    </div>
                    <div class="flex-shrink-0 flex bg-white lg:py-6 lg:rounded-full lg:ml-36">
                        <img class="justify-center xl:ml-2 lg:ml-2 lg:px-8 xl:w-48 2xl:w-48 lg:w-48 w-24 mt-12"
                            src="/img/rino-black.png" alt="Your Company">
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    @auth
                        <div
                            class="grid grid-cols-3 bg-gradient-to-r from-gray-50 to-blue-100 via-gray-100 rounded-full px-4 mr-12">
                            <div class="flex content-center" x-data="{ open: false }">
                                <button x-on:click="open = !open" type="button" class="flex items-center">
                                    <svg width="18" height="16" viewBox="0 0 17 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.5 16L7.2675 14.849C2.89 10.7771 0 8.08283 0 4.79564C0 2.10136 2.057 0 4.675 0C6.154 0 7.5735 0.706267 8.5 1.81362C9.4265 0.706267 10.846 0 12.325 0C14.943 0 17 2.10136 17 4.79564C17 8.08283 14.11 10.7771 9.7325 14.849L8.5 16Z"
                                            fill="red" />
                                    </svg>
                                </button>
                                <div x-show="open" x-on:click.away="open = false"
                                    class="absolute top-16 right-8 w-80 bg-white shadow-lg rounded-lg p-4">
                                    <div class="flex justify-between items-center border-b pb-2 mb-2">
                                        <h2 class="text-xl font-bold">Mis Intereses</h2>
                                        <button x-on:click="open = false" class="text-gray-500 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="space-y-4">
                                        @forelse ($favorites as $favorite)
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-4 p-4 border-b border-gray-200">
                                                    @php
                                                        $images = $favorite->product
                                                            ? $favorite->product->images
                                                            : collect([]);
                                                    @endphp

                                                    @if ($images->isNotEmpty())
                                                        @php
                                                            // Construir la URL de la imagen
                                                            $imageUrl = asset(
                                                                'storage/images/product/' . $images[0]->url,
                                                            );
                                                        @endphp
                                                        <img src="{{ $imageUrl }}"
                                                            class="w-12 h-12 object-cover rounded-lg"
                                                            alt="{{ $favorite->product->name }}">
                                                    @else
                                                        <img src="{{ asset('storage/images/product/default.png') }}"
                                                            class="w-12 h-12 object-cover rounded-lg"
                                                            alt="Imagen no disponible">
                                                    @endif


                                                    <div>
                                                        @if ($favorite->product)
                                                            <p class="font-semibold text-xl text-gray-800">
                                                                {{ $favorite->product->name }}</p>
                                                            <div class="text-sm font-semibold text-gray-500">
                                                                <p>Color: <span
                                                                        class="text-gray-700">{{ $favorite->color }}</span>
                                                                </p>
                                                                <p>Talle: <span
                                                                        class="text-gray-700">{{ $favorite->size }}</span>
                                                                </p>
                                                            </div>
                                                        @else
                                                            <p class="text-gray-500">Agregar Productos a la lista</p>
                                                        @endif
                                                    </div>
                                                </div>


                                                <button wire:click="removeFromFavorites({{ $favorite->id }})"
                                                    class="text-red-500 hover:text-red-700">
                                                    <i class="ri-delete-bin-fill text-xl"></i>
                                                </button>
                                            </div>
                                        @empty
                                            <p class="text-gray-500 text-center">No tienes productos en tu lista de
                                                favoritos.</p>
                                        @endforelse
                                    </div>
                                </div>

                            </div>


                            {{-- Carrito --}}
                            <div class="flex content-center" x-data="{ open: false }">
                                <button x-on:click="open = !open" type="button" class="flex items-center">
                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.2 14.4C14.1455 14.4 13.3 15.201 13.3 16.2C13.3 16.6774 13.5002 17.1352 13.8565 17.4728C14.2128 17.8104 14.6961 18 15.2 18C15.7039 18 16.1872 17.8104 16.5435 17.4728C16.8998 17.1352 17.1 16.6774 17.1 16.2C17.1 15.7226 16.8998 15.2648 16.5435 14.9272C16.1872 14.5896 15.7039 14.4 15.2 14.4ZM0 0V1.8H1.9L5.32 8.631L4.028 10.836C3.8855 11.088 3.8 11.385 3.8 11.7C3.8 12.1774 4.00018 12.6352 4.3565 12.9728C4.71282 13.3104 5.19609 13.5 5.7 13.5H17.1V11.7H6.099C6.03601 11.7 5.9756 11.6763 5.93106 11.6341C5.88652 11.5919 5.8615 11.5347 5.8615 11.475C5.8615 11.43 5.871 11.394 5.89 11.367L6.745 9.9H13.8225C14.535 9.9 15.162 9.522 15.485 8.973L18.886 3.15C18.9525 3.006 19 2.853 19 2.7C19 2.4613 18.8999 2.23239 18.7218 2.0636C18.5436 1.89482 18.302 1.8 18.05 1.8H3.9995L3.1065 0M5.7 14.4C4.6455 14.4 3.8 15.201 3.8 16.2C3.8 16.6774 4.00018 17.1352 4.3565 17.4728C4.71282 17.8104 5.19609 18 5.7 18C6.20391 18 6.68718 17.8104 7.0435 17.4728C7.39982 17.1352 7.6 16.6774 7.6 16.2C7.6 15.7226 7.39982 15.2648 7.0435 14.9272C6.68718 14.5896 6.20391 14.4 5.7 14.4Z"
                                            fill="black" />
                                    </svg>
                                </button>
                                <div x-show="open" x-on:click.away="open = false"
                                    class="absolute top-16 right-8 w-96 bg-white shadow-lg rounded-lg p-4">
                                    <div class="flex justify-between items-center border-b pb-2 mb-2">
                                        <h2 class="text-xl font-bold">Carrito</h2>
                                        <button x-on:click="open = false" class="text-gray-500 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="space-y-4">
                                        @forelse ($cartContents ?? [] as $cartItem)
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex items-center space-x-4">
                                                        @if ($cartItem['item']->images->isNotEmpty())
                                                            <img src="{{ asset('storage/images/product/' . $cartItem['item']->images[0]->url) }}"
                                                                class="w-12 h-12 object-cover rounded-full"
                                                                alt="{{ $cartItem['item']->product->name }}">
                                                        @else
                                                            <img src="{{ asset('storage/images/product/default.png') }}"
                                                                class="w-12 h-12 object-cover rounded-lg"
                                                                alt="Imagen no disponible">
                                                        @endif
                                                        <div>
                                                            <p class="font-semibold text-xl">
                                                                {{ $cartItem['item']->product->name }}</p>
                                                            <p class="text-sm font-semibold text-gray-500">Color:
                                                                <span>{{ $cartItem['item']->product->color }}</span>
                                                            </p>
                                                            <p class="text-sm font-semibold text-gray-500">Talle:
                                                                <span>{{ $cartItem['size'] }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        <button class="text-blue-500"
                                                            wire:click="decrementQuantity({{ $cartItem['item']->id }}, '{{ $cartItem['size'] }}')">-</button>
                                                        <span class="text-lg">{{ $cartItem['amount'] }}</span>
                                                        <button class="text-blue-500"
                                                            wire:click="incrementQuantity({{ $cartItem['item']->id }}, '{{ $cartItem['size'] }}')">+</button>
                                                    </div>
                                                    <div>
                                                        <button class="">
                                                            <a href=""
                                                                wire:click.prevent="removeItem({{ $cartItem['item']->id }}, '{{ $cartItem['size'] }}')">
                                                                <i
                                                                    class="ri-delete-bin-fill text-xl text-black hover:text-red-500"></i>
                                                            </a>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-center text-gray-500">El carrito está vacío.</p>
                                        @endforelse

                                        <div class="mt-4 flex justify-between">
                                            <button
                                                class="bg-black text-white px-4 py-2 font-bold rounded-lg flex items-center"
                                                onclick="location.href='/cart'" type="button">
                                                <span>Ir al carrito</span>
                                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                                </svg>
                                            </button>
                                            <button class="bg-red-500 text-white px-4 py-2 font-bold rounded-lg"
                                                wire:click="clearCart">Eliminar Lista</button>
                                        </div>
                                    </div>

                                </div>

                                {{-- Perfil --}}
                                <div class="relative" x-data="{ open: false }">
                                    <div class=" border-4 rounded-full p-1">
                                        <button x-on:click="open = !open" type="button"
                                            class="flex items-center text-sm font-medium text-white ">
                                            <img class="h-6 w-6 rounded-full"
                                                src="{{ auth()->user()->profile_photo_url }}" alt="">
                                        </button>
                                    </div>

                                    <div x-show="open" x-on:click.away="open = false"
                                        class="z-50 absolute mt-6 -right-6 2xl:-right-14 w-48 bg-white backdrop-blur-2xl divide-y divide-gray-300 rounded-md shadow-sm "
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <a href="{{ route('profile.show') }}"
                                            class="flex justify-end px-4 py-2 text-sm text-back font-extralight"
                                            role="menuitem" tabindex="-1" id="user-menu-item-0">Tu Perfil</a>
                                        <a href="/orders"
                                            class="flex justify-end px-4 py-2 text-sm text-back font-extralight"
                                            role="menuitem" tabindex="-1" id="user-menu-item-1">Mis Pedidos</a>
                                        @can('admin.home')
                                            <a href="{{ route('admin.home') }}"
                                                class="flex justify-end px-4 py-2 text-sm text-back font-extralight"
                                                role="menuitem" tabindex="-1" id="user-menu-item-1">Panel de
                                                Administracion</a>
                                        @endcan
                                        <form method="POST" class="flex justify-end" action="{{ route('logout') }}"
                                            x-data>
                                            @csrf
                                            <button type="submit" href="{{ route('logout') }}"
                                                class="px-4 py-2 text-sm text-backfont-extralight" role="menuitem"
                                                tabindex="-1" id="user-menu-item-2">Cerrar Sesion</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Iniciar
                                Sesión</a>
                            <a href="{{ route('register') }}"
                                class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Registrarme</a>
                        @endauth
                    </div>
                </div>
            </div>

            {{-- Modal Menu --}}
            <div class="relative" x-data="{ open: false }">
                <div class="flex top-0 md:hidden justify-end">
                    <button x-on:click="open = !open" type="button"
                        class="inline-flex items-center justify-center p-2 text-gray-400">
                        <span class="sr-only">Open menu</span>
                        <svg class="block h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>

                {{-- Mobile links --}}
                <div class="md:hidden" x-show="open" x-on:click.away="open = false">
                    <div class="grid grid-cols-2 transition-opacity transform gap-4 p-4">
                        <!-- Enlaces principales en la primera columna a la derecha -->
                        <div class="text-left">
                            <a href="/"
                                class="text-gray-800 font-black hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base"
                                x-on:click="open = !open">Inicio</a>
                            <a href="/about"
                                class="text-gray-800 font-black hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base"
                                x-on:click="open = !open">Nosotros</a>
                            <a href="/contact"
                                class="text-gray-800 font-black hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base"
                                x-on:click="open = !open">Contactanos</a>
                        </div>
                        <!-- Botones de inicio de sesión y registro en la segunda columna a la izquierda -->
                        <div class="text-right">
                            <div class="flex flex-col space-y-1">
                                @auth
                                    <!-- Bloque de autenticación para usuarios autenticados -->
                                    <div class="ml-4 items-end">
                                        <div class="flex relative justify-end" x-data="{ open: false }">
                                            <div class="border-4 w-10 rounded-full p-1">
                                                <button x-on:click="open = !open" type="button"
                                                    class="flex items-end text-sm font-medium text-white ">
                                                    <img class="h-6 rounded-full"
                                                        src="{{ auth()->user()->profile_photo_url }}" alt="">
                                                </button>
                                            </div>

                                            <div x-show="open" x-on:click.away="open = false"
                                                class="z-50 absolute mt-6 -right-6 2xl:-right-14 w-48 bg-white backdrop-blur-2xl divide-y divide-gray-300"
                                                role="menu" aria-orientation="vertical"
                                                aria-labelledby="user-menu-button" tabindex="-1">
                                                <a href="{{ route('profile.show') }}"
                                                    class="flex justify-end px-4 py-2 text-sm text-back font-extralight"
                                                    role="menuitem" tabindex="-1" id="user-menu-item-0">Tu Perfil</a>
                                                <a href="/orders"
                                                    class="flex justify-end px-4 py-2 text-sm text-back font-extralight"
                                                    role="menuitem" tabindex="-1" id="user-menu-item-1">Mis Pedidos</a>
                                                @can('admin.home')
                                                    <a href="{{ route('admin.home') }}"
                                                        class="flex justify-end px-4 py-2 text-sm text-back font-extralight"
                                                        role="menuitem" tabindex="-1" id="user-menu-item-1">Panel de
                                                        Administracion</a>
                                                @endcan
                                                <form method="POST" class="flex justify-end"
                                                    action="{{ route('logout') }}" x-data>
                                                    @csrf
                                                    <button type="submit" href="{{ route('logout') }}"
                                                        class="px-4 py-2 text-sm text-backfont-extralight" role="menuitem"
                                                        tabindex="-1" id="user-menu-item-2">Cerrar Sesion</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Bloque de inicio de sesión y registro para usuarios no autenticados -->
                                    <div class="ml-4 flex items-center">
                                        <a href="{{ route('login') }}"
                                            class="text-gray-600 hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Iniciar
                                            Sesión</a>
                                        <a href="{{ route('register') }}"
                                            class="text-gray-600 hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Registrarme</a>
                                    </div>
                                @endauth
                            </div>
                            <a href="/products"
                                class="text-gray-800 font-black hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base"
                                x-on:click="open = !open">Productos</a>
                            <a href="{{ route('cart') }}"
                                class="text-gray-800 hover:bg-black hover:text-white px-3 py-2 rounded-md text-base font-bold flex justify-end"
                                role="menuitem" tabindex="-1" id="user-menu-item-0">Carrito de Compras</a>
                        </div>
                    </div>
                </div>
            </div>

    </nav>
    <style>
        .underline-navbar {
            width: 0;
            transition: width 0.3s, transform 0.3s;
        }

        .nav-item {
            position: relative;
        }

        .nav-item:hover {
            color: blue;
            /* Cambiar el color del texto al hacer hover si se desea */
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navItems = document.querySelectorAll('.nav-item');
            const underlineBar = document.querySelector('.underline-navbar');

            navItems.forEach((item) => {
                item.addEventListener('mouseover', (e) => {
                    const {
                        offsetLeft,
                        offsetWidth
                    } = e.target;
                    underlineBar.style.width = `${offsetWidth}px`;
                    underlineBar.style.transform = `translateX(${offsetLeft}px)`;
                });
            });

            document.querySelector('.flex.justify-start').addEventListener('mouseleave', () => {
                underlineBar.style.width = `0`;
            });
        });
    </script>

</div>
