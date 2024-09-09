@extends('layouts.app')
@section('content')
    <section class="bg-white">
        <div class="w-full">
            {{-- Navbar --}}
            <div class="w-full grid grid-cols-8 justify-between p-14">
                <div class="mx-auto col-span-8 relative">
                    <h2 class="w-12 border-b-2 text-2xl font-extrabold italic border-gray-500"> Coleccion</h2>
                    <div class="grid grid-cols-4 mt-3 relative">
                        @foreach ($categories as $category)
                            @if (is_null($category->parent_id))
                                <div class="collection-item px-6 border-r-2 border-gray-300 italic font-semibold">
                                    <p>{{ $category->name }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="underline-bar absolute"></div>
                </div>
            </div>

            {{-- Products --}}
            <div class="bg-white grid grid-cols-4 lg:grid-cols-6 justify-between mx-auto">
                {{-- Sidebar --}}
                <div class="flex sticky left-0 top-32 content-center space-y-10 md:space-y-4 z-30" x-data="{ open: window.innerWidth >= 768 }"
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
                                    <form action="{{ route('products.filter') }}" method="GET">
                                        <div class="space-y-10 py-10 p-6 md:space-y-4 sticky left-0 top-10 overflow-scroll">
                                            <h2 class="font-bold text-sm md:text-xl text-center">
                                                Categorías
                                            </h2>
                                            <div class="flex flex-col pl-10">
                                                <!-- Formulario de filtrado -->

                                                @foreach ($categories as $category)
                                                    <div>
                                                        <label class="flex items-center space-x-2">
                                                            <input type="checkbox" name="categories[]"
                                                                value="{{ $category->id }}"
                                                                class="form-checkbox text-blue-600 transition duration-150 ease-in-out"
                                                                @if (in_array($category->id, request('categories', []))) checked @endif>
                                                            <span
                                                                class="text-lg leading-snug text-gray-500 py-2 px-1 hover:text-black transition duration-150 ease-in-out">
                                                                {{ $category->name }} ({{ $category->products_count }})
                                                            </span>
                                                        </label>
                                                    </div>

                                                    @if ($category->children->isNotEmpty())
                                                        <div class="ml-4">
                                                            @foreach ($category->children as $child)
                                                                <div>
                                                                    <label class="flex items-center space-x-2">
                                                                        <input type="checkbox" name="categories[]"
                                                                            value="{{ $child->id }}"
                                                                            class="form-checkbox text-blue-600 transition duration-150 ease-in-out"
                                                                            @if (in_array($child->id, request('categories', []))) checked @endif>
                                                                        <span
                                                                            class="text-lg leading-snug text-gray-500 py-2 px-1 hover:text-black transition duration-150 ease-in-out">
                                                                            {{ $child->name }}
                                                                            ({{ $child->products_count }})
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>


                                            <h2 class="font-bold text-sm md:text-xl text-center">Talles</h2>
                                            <div class="flex flex-col pl-10">
                                                @foreach ($sizes as $size)
                                                    <div>
                                                        <label class="flex items-center space-x-2">
                                                            <input type="checkbox" name="sizes[]"
                                                                value="{{ $size->id }}"
                                                                class="form-checkbox text-blue-600 transition duration-150 ease-in-out"
                                                                @if (in_array($size->id, request('sizes', []))) checked @endif>
                                                            <span
                                                                class="text-lg leading-snug text-gray-500 py-2 px-1 hover:text-black transition duration-150 ease-in-out">
                                                                {{ $size->name }}
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <h2 class="hidden md:block font-bold text-sm md:text-xl text-center">
                                                Precio
                                            </h2>

                                            <div class="flex flex-col space-y-2 space-x-10">
                                                <div>
                                                    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

                                                    <div class="flex justify-center items-center">
                                                        <div x-data="range()" x-init="mintrigger();
                                                        maxtrigger()"
                                                            class="relative max-w-xl w-full">
                                                            <div>
                                                                <input type="range" step="100"
                                                                    x-bind:min="min"
                                                                    x-bind:max="max" x-on:input="mintrigger"
                                                                    x-model="minprice"
                                                                    class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">

                                                                <input type="range" step="100"
                                                                    x-bind:min="min"
                                                                    x-bind:max="max" x-on:input="maxtrigger"
                                                                    x-model="maxprice"
                                                                    class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">

                                                                <div class="relative z-10 h-2">

                                                                    <div
                                                                        class="absolute z-10 left-0 right-0 bottom-0 top-0 rounded-md bg-gray-200">
                                                                    </div>

                                                                    <div class="absolute z-20 top-0 bottom-0 rounded-md bg-blue-500"
                                                                        x-bind:style="'right:' + maxthumb + '%; left:' + minthumb +
                                                                            '%'">
                                                                    </div>

                                                                    <div class="absolute z-30 w-6 h-6 top-0 left-0 bg-blue-500 rounded-full -mt-2 -ml-1"
                                                                        x-bind:style="'left: ' + minthumb + '%'"></div>

                                                                    <div class="absolute z-30 w-6 h-6 top-0 right-0 bg-blue-500 rounded-full -mt-2 -mr-3"
                                                                        x-bind:style="'right: ' + maxthumb + '%'"></div>

                                                                </div>

                                                            </div>

                                                            <div class="flex justify-between items-center py-5">
                                                                <input name="minprice" type="text" maxlength="5"
                                                                    x-on:input="mintrigger" x-model="minprice"
                                                                    class="px-3 py-2 border border-gray-200 rounded w-24 text-center">
                                                                <input name="maxprice" type="text" maxlength="5"
                                                                    x-on:input="maxtrigger" x-model="maxprice"
                                                                    class="px-3 py-2 border border-gray-200 rounded w-24 text-center">
                                                            </div>

                                                        </div>


                                                    </div>
                                                    <button type="submit"
                                                        class="mt-5 text-base text-center  border font-medium text-white py-2 px-2 bg-blue-800  border-blue-800  hover:text-base rounded-md transition duration-150 ease-in-out">
                                                        <span class="">Filtrar</span>
                                                        <i class="ri-filter-fill"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content (Productos) --}}
                <div class="col-span-5 ml-0 lg:ml-2 z-10 mb-8">

                    <div class="bg-blue-800 rounded-none lg:rounded-2xl m-0 lg:m-6">
                        <div class="flex">
                            <!-- component -->
                            <div class="flex w-full justify-start p-12">
                                <h2 class="text-blue-100 font-bold font-josefin xl:text-4xl text-2xl italic leading-tight">
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
                                <div
                                    class="overflow-hidden relative h-[50vh] sm:h-56 md:h-64 lg:h-72 xl:h-[550px] 2xl:h-[590px] rounded-lg">
                                    <!-- Item 1 -->
                                    @foreach ($combos as $combo)
                                        <!-- Item  -->
                                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                            <div
                                                class="flex absolute top-5 sm:top-5 right-16 xl:left-[27rem] z-30 xl:gap-[53rem] space-x-2 sm:space-x-3 -translate-x-1/2">
                                                <button
                                                    class="items-end rounded-full p-2 sm:p-3 sm:px-5 mt-4 bg-green-500 flex space-x-2 hover:bg-white transition-colors text-green-100 hover:text-green-700">
                                                    <p class="text-lg sm:text-xl font-bold">
                                                        {{ $combo->discount }}%
                                                    </p>
                                                </button>
                                                <button
                                                    class="items-end rounded-full p-2 sm:p-3 px-3 sm:px-5 mt-4 bg-green-500 flex space-x-2 hover:bg-white transition-colors text-green-100 hover:text-green-700">
                                                    @php
                                                        $total = 0;
                                                    @endphp
                                                    {{-- @php
                                                    $item = $combo->items;
                                                    $product = $item->product;
                                                    $total += $product->items->first()->price();
                                                @endphp
                                                @dd($combo->items) --}}
                                                    @php
                                                        $discount = ($combo->discount / 100) * $total;
                                                        $totalDiscount = $total - $discount;
                                                    @endphp
                                                    <p class="text-lg sm:text-xl font-bold">
                                                        ${{ number_format($totalDiscount, 2, '.', ',') }}</p>
                                                </button>
                                            </div>
                                            <span
                                                class="absolute top-1/2 left-1/2 text-xl sm:text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 dark:text-gray-800">
                                                <a href="{{ route('combos.show', $combo) }}">@livewire('combo', ['id' => $combo->id])</a>
                                            </span>
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

                    <div class="flex w-full justify-center lg:justify-end">
                        <div
                            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 xl:mx-12 sm:gap-6 md:gap-8 lg:gap-8 w-full mx-4 sm:mx-8 md:mx-12 lg:mx-20">
                            @foreach ($products as $product)
                                @if ($product->items->first())
                                    @php
                                        $item = $product->items()->first();
                                    @endphp
                                    @livewire('product-card', ['product' => $product, 'item' => $item])
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <style>
            input[type=range]::-webkit-slider-thumb {
                pointer-events: all;
                width: 24px;
                height: 24px;
                -webkit-appearance: none;
                /* @apply w-6 h-6 appearance-none pointer-events-auto; */
            }

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
            function range() {
                return {
                    min: 0,
                    max: 500000,
                    minprice: 0,
                    maxprice: 500000,
                    minthumb: 0,
                    maxthumb: 100,
                    mintrigger() {
                        this.minthumb = ((this.minprice - this.min) / (this.max - this.min)) * 100;
                    },
                    maxtrigger() {
                        this.maxthumb = 100 - (((this.maxprice - this.min) / (this.max - this.min)) * 100);
                    }
                }
            }
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
@endsection
