@extends('layouts.app')
@section('content')
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
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content (Productos) --}}
                <div class="col-span-5 ml-2 z-10 mb-8">
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
@endsection
