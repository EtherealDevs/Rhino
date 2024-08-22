<!-- component -->
<div class="bg-black z-40 absolute" x-data="{ open: true }">
    <div x-show="open" x-on:click.away="open = true"
        class="fixed flex justify-center bottom-0 left-0 w-full h-18 bg-black border-t border-gray-600 shadow">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <p class="text-base text-white">Inicia Sesion hoy y obten 50% de descuento en todos nuestros productos y
                acceso a todas nuestras promociones
                Ver Promociones <a href="" class="text-blue-500">here</a>.</p>
            <div class="flex space-x-2 ">
                @auth
                    <a href="/products">
                        <button
                            class="font-bold px-4 rounded-xl py-1.5 bg-blue-500 text-white hover:bg-blue-600 transition duration-300 ease-in-out">Ver
                            Productos</button>
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <button
                            class="font-bold px-4 rounded-xl py-1.5 bg-blue-500 text-white hover:bg-blue-600 transition duration-300 ease-in-out">Iniciar
                            Sesion</button>
                    </a>
                @endauth
                <button x-on:click="open = !open"
                    class="font-bold px-4 rounded-xl py-1.5 bg-gray-300 text-gray-700 hover:bg-gray-400 transition duration-300 ease-in-out">Cerrar</button>
            </div>
        </div>
    </div>
</div>
