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
            <div class="col-span-5 ml-2 z-10 mb-8">
                <!-- component -->
                <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>

                <div x-data="slider"
                    class="relative w-full mb-12 flex flex-shrink-0 overflow-hidden shadow-2xl">
                    <div
                        class="rounded-full bg-gray-600 text-white absolute top-5 right-5 text-sm px-2 text-center z-10">
                        <span x-text="currentIndex"></span>/
                        <span x-text="images.length"></span>
                    </div>

                    <template x-for="(image, index) in images">
                        <figure class="h-96" x-show="currentIndex == index + 1"
                            x-transition:enter="transition transform duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition transform duration-300"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                            <img :src="image" alt="Image"
                                class="absolute inset-0 z-10 h-full w-full object-cover opacity-70" />
                            <figcaption
                                class="absolute inset-x-0 bottom-1 z-20 w-96 mx-auto p-4 font-light text-sm text-center tracking-widest leading-snug bg-gray-300 bg-opacity-25">
                                Any kind of content here!
                                Primum in nostrane potestate est, quid meminerimus? Nulla erit controversia.
                                Vestri haec verecundius, illi fortasse constantius.
                            </figcaption>
                        </figure>
                    </template>

                    <button @click="back()"
                        class="absolute left-14 top-1/2 -translate-y-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 bg-gray-100 hover:bg-gray-200">
                        <svg class=" w-8 h-8 font-bold transition duration-500 ease-in-out transform motion-reduce:transform-none text-gray-500 hover:text-gray-600 hover:-translate-x-0.5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>

                    <button @click="next()"
                        class="absolute right-14 top-1/2 translate-y-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 bg-gray-100 hover:bg-gray-200">
                        <svg class=" w-8 h-8 font-bold transition duration-500 ease-in-out transform motion-reduce:transform-none text-gray-500 hover:text-gray-600 hover:translate-x-0.5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>


                <div class="flex w-full">
                    <div class="grid grid-cols-2 mx-auto lg:grid-cols-4 gap-3 lg:gap-10">
                        @foreach ($products as $product)
                            @php
                                $item = $product->items()->first();
                            @endphp
                            @livewire('product-card', ['product' => $product, 'item' => $item])
                            @livewire('product-card', ['product' => $product, 'item' => $item])
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
