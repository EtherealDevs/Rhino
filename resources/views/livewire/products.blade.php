<section class="bg-white">
    <div class="w-full">
        {{-- Navbar --}}
        <div class="w-full grid grid-cols-8 justify-between p-14">
            <div class="mx-auto col-span-8 relative">
                <h2 class="w-12 border-b-2 text-2xl font-extrabold italic border-gray-500"> Coleccion</h2>
                <div class="grid grid-cols-4 mt-3 relative">
                    <div class="collection-item px-6 border-r-2 border-gray-300 italic font-semibold">
                        <p>Verano</p>
                    </div>
                    <div class="collection-item px-6 border-r-2 italic font-semibold border-gray-300">
                        <p>Invierno</p>
                    </div>
                    <div class="collection-item px-6 border-r-2 italic font-semibold border-gray-300">
                        <p>Street</p>
                    </div>
                    <div class="collection-item px-6 italic font-semibold border-gray-300">
                        <p>Elegance</p>
                    </div>
                </div>
                <div class="underline-bar absolute"></div>
            </div>
        </div>

        {{-- Products --}}
        <div class="bg-white grid grid-cols-4 lg:grid-cols-6 justify-between mx-auto">
            {{-- Sidebar --}}
            <div class="flex sticky left-0 top-16 content-center space-y-10 md:space-y-4 z-30" x-data="{ open: window.innerWidth >= 768 }"
                x-init="() => {
                    window.addEventListener('resize', () => {
                        open = window.innerWidth >= 768;
                    });
                }">
                <button x-on:click="open = !open" class="block md:hidden p-2 mb-6 ml-6 rounded-full bg-white shadow-xl"
                    type="button" class="flex items-center">
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
                <div x-show="open" x-on:click.away="open = false" class="absolute">
                    <div class="absolute font-poppins antialiased">
                        <div id="view" class="flex flex-row">
                            <div id="sidebar"
                                class="bg-white shadow-2xl px-3 pb-5 w-30 md:w-60 lg:w-72 transition-transform duration-300 ease-in-out h-screen">
                                <div class="space-y-10 py-10 p-6 md:space-y-4 sticky left-0 top-10 overflow-scroll">
                                    <h2 class="font-bold text-sm md:text-xl text-center">
                                        Categorías
                                    </h2>
                                    <div class="flex flex-col pl-10">
                                        <!-- Formulario de filtrado -->
                                        <form action="{{ route('products.index') }}" method="GET">
                                            @foreach ($categories as $category)
                                                <div>
                                                    <label class="flex items-center space-x-2">
                                                        <input type="checkbox" name="categories[]"
                                                            value="{{ $category->id }}"
                                                            class="form-checkbox text-blue-600 transition duration-150 ease-in-out"
                                                            @if (in_array($category->id, request('categories', []))) checked @endif>
                                                        <span
                                                            class="text-base text-gray-700 py-2 px-1 hover:text-gray-900 hover:text-lg transition duration-150 ease-in-out">
                                                            {{ $category->name }} ({{ $category->products_count }})
                                                        </span>
                                                    </label>
                                                </div>
                                            @endforeach

                                            <!-- Botón para aplicar el filtro -->
                                            <div class="mt-4">
                                                <button type="submit"
                                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-150 ease-in-out">
                                                    Aplicar filtros
                                                </button>
                                            </div>
                                        </form>
                                    </div>


                                    {{-- <h2 class="hidden md:block font-bold text-sm md:text-xl text-center">
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
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content (Productos) --}}
            <div class="col-span-5 ml-2 z-10 mb-8">

                <div class="bg-blue-600 rounded-2xl m-6">
                    <div class="flex">
                        <!-- component -->
                        <div class="flex w-full justify-start p-12">
                            <h2 class="text-blue-100 font-bold font-josefin text-4xl italic leading-tight">
                                Estilo y Ahorro: <br>
                                <span class="text-blue-200 font-light not-italic">
                                    Descubre Nuestros <span class="italic">Combos de Ropa</span>
                                </span>
                            </h2>
                        </div>


                        <div class="mt-4 mb-12 justify-end w-1/2">
                            <a href="/combos">
                                <button
                                    class="rounded-full p-3 px-6 mt-6 bg-black flex items-center space-x-2 hover:bg-white transition-colors text-white hover:text-blue-900">
                                    <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                            fill="#3E68FF" />
                                    </svg>
                                    <p class="">
                                        Ver todos
                                    </p>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="max-w-7xl mx-auto">

                        <div id="default-carousel" class="relative" data-carousel="static">
                            <!-- Carousel wrapper -->
                            <div class="overflow-hidden relative h-56 rounded-lg sm:h-72 xl:h-96 2xl:h-[590px]">
                                <!-- Item 1 -->
                                @foreach ($combos as $combo)
                                    <!-- Item  -->
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <div class="flex absolute top-5 left-32 z-30 space-x-3 -translate-x-1/2">
                                            <button
                                                class="items-end rounded-full p-3 px-5 mt-6 bg-green-500 flex space-x-2 hover:bg-white transition-colors text-green-100 hover:text-green-700">
                                                <p class="text-xl font-bold">
                                                    {{ $combo->discount }}%
                                                </p>
                                            </button>
                                        </div>
                                        <span
                                            class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">
                                            @livewire('combo', ['id' => $combo->id])</span>
                                    </div>
                                    <div class="flex absolute bottom-5 right-12 z-30 space-x-3 -translate-x-1/2">
                                        <a href="{{ route('combos.show', $combo) }}">
                                            <button
                                                class="items-end rounded-full p-3 px-4 mt-6 bg-white flex space-x-2 hover:bg-black transition-colors text-blue-800 hover:text-blue-200">
                                                <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                                        fill="#3E68FF" />
                                                </svg>
                                                <p class="">
                                                    Ver Combo
                                                </p>
                                            </button>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Slider controls -->
                            <button type="button"
                                class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                                data-carousel-prev>
                                <span
                                    class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                    <span class="hidden">Previous</span>
                                </span>
                            </button>
                            <button type="button"
                                class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                                data-carousel-next>
                                <span
                                    class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    <span class="hidden">Next</span>
                                </span>
                            </button>
                        </div>
                        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                    </div>

                </div>

                <div class="flex w-full justify-end">
                    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 lg:gap-8 mx-20">
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

    <style>
        .collection-item {
            position: relative;
            cursor: pointer;
            width: 50%;
            border-right: 2px;
            padding-bottom: 4px;
            /* Espacio */
        }

        .underline-bar {
            position: absolute;
            bottom: 10;
            left: 0;
            height: 4px;
            background-color: #000;
            transition: all 0.3s ease;
            will-change: transform, width;
        }
    </style>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('slider', () => ({
                currentIndex: 1,
                images: [
                    'https://source.unsplash.com/1600x900/?beach',
                    'https://source.unsplash.com/1600x900/?cat',
                    'https://source.unsplash.com/1600x900/?dog',
                    'https://source.unsplash.com/1600x900/?lego',
                    'https://source.unsplash.com/1600x900/?textures&patterns'
                ],
                back() {
                    if (this.currentIndex > 1) {
                        this.currentIndex = this.currentIndex - 1;
                    }
                },
                next() {
                    if (this.currentIndex < this.images.length) {
                        this.currentIndex = this.currentIndex + 1;
                    } else if (this.currentIndex <= this.images.length) {
                        this.currentIndex = this.images.length - this.currentIndex + 1
                    }
                },
            }))
        })
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const items = document.querySelectorAll('.collection-item');
            const underlineBar = document.querySelector('.underline-bar');

            items.forEach(item => {
                item.addEventListener('mouseover', (e) => {
                    const {
                        offsetLeft,
                        offsetWidth
                    } = e.target.closest('.collection-item');
                    underlineBar.style.width = `${offsetWidth}px`;
                    underlineBar.style.transform = `translateX(${offsetLeft}px)`;
                });
            });

            document.querySelector('.grid').addEventListener('mouseleave', () => {
                underlineBar.style.width = `0`;
            });
        });
    </script>
</section>
