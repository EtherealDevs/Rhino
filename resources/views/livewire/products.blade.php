<section class="">
    <div class="w-full">
        {{-- Nabvar --}}
        <div class="w-full grid grid-cols-8 justify-between p-14">
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
            <div class="mx-auto col-span-7">
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
        <div class="h-full w-full bg-white grid grid-cols-4 lg:grid-cols-6 justify-between mx-auto sticky">
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
                        class="bg-white h-full md:block shadow-2xl px-3 pb-5 w-30 md:w-60 lg:w-60 transition-transform duration-300 ease-in-out">
                        <div class="space-y-10  md:space-y-4 mt-10 sticky left-0 top-10">
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
                                            <input id="price-range-input" type="range" value="1000" min="100"
                                                max="1500"
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
            <div class="col-span-5 ml-2 mt-3">
                <div class="flex w-full">
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
