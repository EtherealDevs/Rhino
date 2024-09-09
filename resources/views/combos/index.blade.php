@extends('layouts.app')
@section('content')
    <section class="bg-white">
        <div class="w-full">
            {{-- Navbar --}}
            <div class="w-full grid grid-cols-8 justify-between p-14">
                <div class="mx-auto col-span-8 relative">
                    <h2 class="w-12 border-b-2 text-2xl font-extrabold italic border-gray-500">Coleccion</h2>
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

            {{-- comboss --}}
            <div class="bg-white grid grid-cols-4 lg:grid-cols-6 justify-between mx-auto">
                {{-- Content (Productos) --}}
                <div class="col-span-5 ml-2 z-10 mb-8">
                    <div class="flex w-full">
                        <div
                            class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2 justify-items-center mx-auto lg:gap-10">
                            @foreach ($combos as $combo)
                                <!-- Item -->
                                <div
                                    class="relative bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-500 ease-in-out hover:scale-105 w-full max-w-xs">


                                    <!-- Contenido del combo -->
                                    <div class="p-6">
                                        <!-- Botones de descuento y precio -->
                                        <div class="absolute top-4 left-4 flex space-x-2">
                                            <button
                                                class="rounded-full p-2 bg-green-500 text-white text-sm font-bold hover:bg-white hover:text-green-700 transition-colors">
                                                {{ $combo->discount }}%
                                            </button>
                                            <button
                                                class="rounded-full p-2 bg-green-500 text-white text-sm font-bold hover:bg-white hover:text-green-700 transition-colors">
                                                @php
                                                    $total = 0;
                                                    // Calcular total de combo (puedes ajustar esta lógica según sea necesario)
                                                    $discount = ($combo->discount / 100) * $total;
                                                    $totalDiscount = $total - $discount;
                                                @endphp
                                                ${{ number_format($totalDiscount, 2, '.', ',') }}
                                            </button>
                                        </div>
                                        <span class="block text-center text-xl font-semibold text-gray-800">
                                            <a href="{{ route('combos.show', $combo) }}">@livewire('combo', ['id' => $combo->id])</a>
                                        </span>
                                    </div>
                                </div>
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
