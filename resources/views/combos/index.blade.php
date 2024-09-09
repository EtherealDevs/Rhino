@extends('layouts.app')
@section('content')
    <section class="bg-white">
        <div class="w-full">
            {{-- Navbar --}}
            <div class="w-full grid grid-cols-8 justify-between mb-4">
                <div class="mx-auto col-span-8 relative">
                    <!-- Banner o elemento llamativo -->
                    <div class="w-screen bg-gradient-to-r from-green-400 to-blue-500 p-8 py-14 rounded-lg shadow-lg text-center text-white">
                        <h3 class="text-3xl font-josefin font-bold">¡Ofertas Especiales en Combos!</h3>
                        <p class="mt-2 text-lg">Aprovecha descuentos únicos en nuestros combos seleccionados.</p>
                    </div>
                </div>
            </div>

            {{-- comboss --}}
            <div class="grid grid-cols-4 lg:grid-cols-6 justify-between mx-auto">
                {{-- Content (Productos) --}}
                <div class="col-span-5 ml-2 z-10 mb-8">
                    <div class="flex w-full">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2 justify-items-center mx-auto lg:gap-10">
                            @foreach ($combos as $combo)
                                <!-- Item -->
                                <div class="relative overflow-hidden transition-transform duration-500 ease-in-out hover:scale-105 w-full max-w-xl"> <!-- max-w-lg o max-w-xl para aumentar el tamaño -->
                                    <!-- Contenido del combo -->
                                    <div class="p-1"> <!-- Aumentar padding a 10 -->
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
