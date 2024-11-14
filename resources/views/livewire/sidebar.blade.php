{{-- Sidebar --}}
<div class="w-2/3 left-2 md:w-1/4 xl:w-[271px] md:mt-10 xl:mb-4 xl:mt-6 lg:w-1/6 z-40 md:z-0 sticky top-28"
    x-data="{ open: window.innerWidth >= 768 }" x-init="$watch('open', value => { if (window.innerWidth >= 768) open = false })">

    <!-- Botón de cerrar solo visible en pantallas móviles -->
    <button x-on:click="open = !open" class="block md:hidden p-2 mb-4 ml-6 rounded-full bg-white shadow-xl" type="button">
        <!-- Icono cuando está cerrado -->
        <svg x-show="!open" class="block h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
            viewBox="0 0 16 16">
            <path fill="currentColor"
                d="M.75 3h14.5a.75.75 0 0 1 0 1.5H.75a.75.75 0 0 1 0-1.5M3 7.75A.75.75 0 0 1 3.75 7h8.5a.75.75 0 0 1 0 1.5h-8.5A.75.75 0 0 1 3 7.75m3 4a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75" />
        </svg>
        <!-- Icono cuando está abierto -->
        <svg x-show="open" class="block h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Contenido del sidebar -->
    <div x-show="open" x-on:click.away="if(window.innerWidth < 768) open = false"
        class="sticky top-16 xl:top-[80px] h-[80vh] overflow-y-auto md:h-screen 2xl:h-[90vh] bg-white md:bg-white/50 rounded-lg shadow-xl p-4 space-y-10">
        <form action="{{ route('products.filter') }}" method="GET">
            <!-- Contenido del formulario de categorías -->
            <h2 class="font-bold text-xl font-josefin text-center">Categorías</h2>
            <div class="flex flex-col">
                @foreach ($categories as $category)
                    <div>
                        <h3
                            class="text-lg font-extrabold font-josefin leading-snug text-gray-300 py-2 px-1 hover:text-black transition duration-200 ease-in-out">
                            {{ $category->name }} ({{ count($category->products) }})
                        </h3>
                    </div>

                    @if ($category->children->isNotEmpty())
                        <div class="ml-4">
                            @foreach ($category->children as $child)
                                <div>
                                    <label class="flex items-center font-josefin space-x-3 cursor-pointer">
                                        <input type="checkbox" name="categories[]" value="{{ $child->id }}"
                                            class="form-checkbox h-5 w-5 rounded-full border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out shadow-md hover:ring-2 hover:ring-blue-300"
                                            @if (in_array($child->id, request('categories', []))) checked @endif>
                                        <span
                                            class="text-md leading-snug text-gray-500 py-2 px-1 hover:text-black transition duration-200 ease-in-out">
                                            {{ $child->name }} ({{ count($child->products) }})
                                        </span>
                                    </label>
                                </div>

                                @if ($child->children->isNotEmpty())
                                    <!-- Verifica si hay nietos -->
                                    <div class="ml-4">
                                        @foreach ($child->children as $grandchild)
                                            <div>
                                                <label class="flex items-center font-josefin space-x-3 cursor-pointer">
                                                    <input type="checkbox" name="categories[]"
                                                        value="{{ $grandchild->id }}"
                                                        class="form-checkbox h-5 w-5 rounded-full border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out shadow-md hover:ring-2 hover:ring-blue-300"
                                                        @if (in_array($grandchild->id, request('categories', []))) checked @endif>
                                                    <span
                                                        class="text-md leading-snug text-gray-500 py-2 px-1 hover:text-black transition duration-200 ease-in-out">
                                                        {{ $grandchild->name }} ({{ count($grandchild->products) }})
                                                    </span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach

            </div>

            <!-- Resto del contenido del formulario -->
            <h2 class="font-bold text-xl font-josefin text-center mt-10">Talles</h2>
            <div class="flex flex-col">
                @foreach ($sizes as $size)
                    <div>
                        <label class="flex items-center font-josefin space-x-3 cursor-pointer">
                            <input type="checkbox" name="sizes[]" value="{{ $size->id }}"
                                class="form-checkbox h-5 w-5 rounded-full border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out shadow-md hover:ring-2 hover:ring-blue-300"
                                @if (in_array($size->id, request('sizes', []))) checked @endif>
                            <span
                                class="text-lg leading-snug text-gray-500 py-2 px-1 hover:text-black transition duration-200 ease-in-out">
                                {{ $size->name }}
                            </span>
                        </label>
                    </div>
                @endforeach
            </div>

            <!-- Rango de precio -->
            <h2 class="font-bold text-xl font-josefin text-center mt-10">Precio</h2>
            <div class="flex flex-col space-y-4">
                <div x-data="range()" x-init="mintrigger();
                maxtrigger()" class="relative max-w-xl w-full">
                    <!-- Slider de rango -->
                    <div>
                        <input type="range" step="100" x-bind:min="min" x-bind:max="max"
                            x-on:input="mintrigger" x-model="minprice"
                            class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">
                        <input type="range" step="100" x-bind:min="min" x-bind:max="max"
                            x-on:input="maxtrigger" x-model="maxprice"
                            class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">
                        <div class="relative z-10 h-2">
                            <div class="absolute z-10 left-0 right-0 bottom-0 top-0 rounded-md bg-gray-200">
                            </div>
                            <div class="absolute z-20 top-0 bottom-0 rounded-md bg-blue-500"
                                x-bind:style="'right:' + maxthumb + '%; left:' + minthumb + '%'"></div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center py-5">
                        <input name="minprice" type="text" maxlength="5" x-on:input="mintrigger" x-model="minprice"
                            class="px-3 py-2 border border-gray-200 rounded w-24 text-center">
                        <input name="maxprice" type="text" maxlength="5" x-on:input="maxtrigger" x-model="maxprice"
                            class="px-3 py-2 border border-gray-200 rounded w-24 text-center">
                    </div>
                </div>

                <!-- Botón de filtrar -->
                <button type="submit"
                    class="mt-5 text-base text-center border font-josefin font-medium text-white py-2 px-2 bg-blue-800 border-blue-800 hover:text-base rounded-md transition duration-150 ease-in-out">
                    <span>Filtrar</span>
                </button>
            </div>
        </form>
    </div>
</div>
