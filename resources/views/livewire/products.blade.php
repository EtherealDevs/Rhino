<section class="">
    <div class="w-full">
        {{-- Nabvar --}}
        <div class="w-full grid grid-cols-8 justify-between p-14">
            {{-- Collection --}}
            <div class="mx-auto col-span-8">
                <h2 class="w-12 border-b-2 text-2xl font-extrabold italic border-gray-500"> Coleccion</h2>
                <div class="grid grid-cols-4 gap-6 mt-3">
                    <div class="border-r-2 border-gray-300 italic font-semibold">
                        <p>Verano</p>
                    </div>
                    <div class="border-r-2 italic font-semibold border-gray-300">
                        <p>Invierno</p>
                    </div>
                    <div class="border-r-2 italic font-semibold border-gray-300">
                        <p>Street</p>
                    </div>
                    <div class="italic font-semibold border-gray-300">
                        <p>Elegance</p>
                    </div>
                </div>
                 
            </div>
        </div>

        

        {{-- Products --}}
        <div class="h-full w-full bg-white grid grid-cols-4 lg:grid-cols-6 justify-between mx-auto">
            {{-- Sidebar --}}
            <div class="flex sticky left-0 top-16 content-center space-y-10 py-10 md:space-y-4 z-30"
                x-data="{ open: window.innerWidth >= 768 }" x-init="() => {
                    window.addEventListener('resize', () => {
                        open = window.innerWidth >= 768;
                    });
                }">
                <button x-on:click="open = !open" class="p-2 mb-6 ml-6 rounded-full bg-white shadow-xl" type="button"
                    class="flex items-center">
                    <svg x-show="!open" class="block h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="1em"
                        height="1em" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M472 168H40a24 24 0 0 1 0-48h432a24 24 0 0 1 0 48m-80 112H120a24 24 0 0 1 0-48h272a24 24 0 0 1 0 48m-96 112h-80a24 24 0 0 1 0-48h80a24 24 0 0 1 0 48" />
                    </svg>

                    <svg x-show="open" class="block h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div x-show="open" x-on:click.away="open = false" class="absolute mt-2">
                    <div class="absolute font-poppins antialiased">
                        <div id="view" class="flex flex-row">
                            <div id="sidebar"
                                class="bg-white shadow-2xl px-3 pb-5 w-30 md:w-60 lg:w-60 transition-transform duration-300 ease-in-out h-full">
                                <div class="space-y-10 py-10 md:space-y-4 sticky left-0 top-10 overflow-scroll">
                                    <h2 class="hidden md:block font-bold text-sm md:text-xl text-center">
                                        Categorias
                                    </h2>
                                    <div class="flex flex-col pl-10 ">
                                        @foreach ($categories as $category)
                                            <div>
                                                <a href=""
                                                    class="text-base text-gray-700 py-2 px-1 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                                    <span class="">{{ $category->name }} ()</span>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>

                                    <h2 class="hidden md:block font-bold text-sm md:text-xl text-center">
                                        Tallas
                                    </h2>

                                    <div class="flex flex-col pl-10">
                                        @foreach ($sizes as $size)
                                            <div>
                                                <a href=""
                                                    class="text-base text-gray-700 py-2 px-2 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                                    <span class="">{{ $size->name }}</span>
                                                </a>
                                            </div>
                                        @endforeach
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
                                                    <label for="price-range-input" class="sr-only">Default
                                                        range</label>
                                                    <input id="price-range-input" type="range" value="500"
                                                        min="100" max="1500"
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
                                                    <label for="price-range-input" class="sr-only">Default
                                                        range</label>
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
                </div>
            </div>
            {{-- Content (Productos) --}}
            <div class="col-span-5 ml-2 mt-3 z-10">
                <div class="flex w-full">
                    <div class="grid grid-cols-2 mx-auto lg:grid-cols-4 gap-3 lg:gap-10">

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
