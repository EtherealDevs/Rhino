@extends('layouts.app')
@section('content')
    <section class="bg-white relative ">
        <div class="w-full">
            {{-- Navbar --}}
            <div class="w-full grid grid-cols-8 justify-between p-14">
                <div class="mx-auto col-span-8 relative">
                    <h2 class="w-12 border-b-2 text-2xl font-extrabold italic border-gray-500">Colección</h2>
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
            <div class="flex justify-between ">
                {{-- Sidebar --}}
                <div class="w-full md:w-1/4 mt-10 xl:mb-4 xl:mt-6 lg:w-1/6 ml-4" x-data="{ open: window.innerWidth >= 768 }"
                    x-init="$watch('open', value => { if (window.innerWidth >= 768) open = true })">

                    <!-- Botón de cerrar solo visible en pantallas móviles -->
                    <button x-on:click="open = !open" class="block md:hidden p-2 mb-6 ml-6 rounded-full bg-white shadow-xl"
                        type="button">
                        <!-- Icono cuando está cerrado -->
                        <svg x-show="!open" class="block h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="1em"
                            height="1em" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M472 168H40a24 24 0 0 1 0-48h432a24 24 0 0 1 0-48m-80 112H120a24 24 0 0 1 0-48h272a24 24 0 0 1 0 48m-96 112h-80a24 24 0 0 1 0-48h80a24 24 0 0 1 0 48" />
                        </svg>
                        <!-- Icono cuando está abierto -->
                        <svg x-show="open" class="block h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Contenido del sidebar -->
                    <div x-show="open" x-on:click.away="if(window.innerWidth < 768) open = false"
                        class="sticky top-16 xl:top-[80px] h-screen bg-white/50 rounded-lg shadow-xl p-4 space-y-10">
                        <form action="{{ route('products.filter') }}" method="GET">
                            <!-- Contenido del formulario de categorías -->
                            <h2 class="font-bold text-xl text-center">Categorías</h2>
                            <div class="flex flex-col">
                                @foreach ($categories as $category)
                                    <div>
                                        <label class="flex items-center space-x-2">
                                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
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
                                                            {{ $child->name }} ({{ $child->products_count }})
                                                        </span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Resto del contenido del formulario -->
                            <h2 class="font-bold text-xl text-center mt-10">Talles</h2>
                            <div class="flex flex-col">
                                @foreach ($sizes as $size)
                                    <div>
                                        <label class="flex items-center space-x-2">
                                            <input type="checkbox" name="sizes[]" value="{{ $size->id }}"
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

                            <!-- Rango de precio -->
                            <h2 class="font-bold text-xl text-center mt-10">Precio</h2>
                            <div class="flex flex-col space-y-4">
                                <div x-data="range()" x-init="mintrigger();
                                maxtrigger()" class="relative max-w-xl w-full">
                                    <!-- Slider de rango -->
                                    <div>
                                        <input type="range" step="100" x-bind:min="min"
                                            x-bind:max="max" x-on:input="mintrigger" x-model="minprice"
                                            class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">
                                        <input type="range" step="100" x-bind:min="min"
                                            x-bind:max="max" x-on:input="maxtrigger" x-model="maxprice"
                                            class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">
                                        <div class="relative z-10 h-2">
                                            <div class="absolute z-10 left-0 right-0 bottom-0 top-0 rounded-md bg-gray-200">
                                            </div>
                                            <div class="absolute z-20 top-0 bottom-0 rounded-md bg-blue-500"
                                                x-bind:style="'right:' + maxthumb + '%; left:' + minthumb + '%'"></div>
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center py-5">
                                        <input name="minprice" type="text" maxlength="5" x-on:input="mintrigger"
                                            x-model="minprice"
                                            class="px-3 py-2 border border-gray-200 rounded w-24 text-center">
                                        <input name="maxprice" type="text" maxlength="5" x-on:input="maxtrigger"
                                            x-model="maxprice"
                                            class="px-3 py-2 border border-gray-200 rounded w-24 text-center">
                                    </div>
                                </div>

                                <!-- Botón de filtrar -->
                                <button type="submit"
                                    class="mt-5 text-base text-center border font-medium text-white py-2 px-2 bg-blue-800 border-blue-800 hover:text-base rounded-md transition duration-150 ease-in-out">
                                    <span>Filtrar</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


                {{-- Content (Productos) --}}
                <div class="col-span-5 ml-0 lg:ml-2 z-10 mb-8">
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
