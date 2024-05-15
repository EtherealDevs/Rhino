<div class="min-h-full z-50">
    <nav class="bg-white z-50 h-18 drop-shadow-xl">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="/home" class="text-gray-800 font-black px-3 py-2 text-sm" aria-current="page">Inicio</a>
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
                                class="flex justify-end px-4 py-2 text-sm text-white font-extralight" role="menuitem"
                                tabindex="-1" id="user-menu-item-0">Tu Perfil</a>

                            @csrf
                            @auth
                                @can('admin')
                                    <a href="{{ route('index') }}"
                                        class="flex justify-end px-4 py-2 text-sm text-white font-extralight" role="menuitem"
                                        tabindex="-1" id="user-menu-item-1">Panel de Administracion</a>
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
  
      <!-- Mobile menu, show/hide based on menu state. -->
      <div class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
          <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
          <a href="#" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Dashboard</a>
          <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Team</a>
          <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Projects</a>
          <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Calendar</a>
          <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Reports</a>
        </div>
        <div class="border-t border-gray-700 pb-3 pt-4">
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            </div>
            <div class="ml-3">
              <div class="text-base font-medium leading-none text-white">Tom Cook</div>
              <div class="text-sm font-medium leading-none text-gray-400">tom@example.com</div>
            </div>
            <button type="button" class="relative ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">View notifications</span>
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
              </svg>
            </button>
          </div>
          <div class="mt-3 space-y-1 px-2">
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
          </div>
        </div>
      </div>
    </nav>
  </div>
  