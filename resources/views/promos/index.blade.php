@extends('layouts.app')
@section('content')
    <section class="bg-white">
        <div class="w-full">
            {{-- Navbar --}}
            <div class="w-full grid grid-cols-8 justify-between mb-4">
                <div
                    class="w-full col-span-8 relative bg-gradient-to-r from-blue-400 to-blue-600 p-8 py-14 shadow-lg text-center text-white">
                    <h3 class="text-3xl font-josefin font-bold">¡Ofertas Especiales en Promociones!</h3>
                    <p class="mt-2 text-lg">Aprovecha descuentos únicos en nuestros productos seleccionados.</p>
                </div>
            </div>

            {{-- Products --}}
            <div class="bg-white grid grid-cols-2 lg:grid-cols-6 justify-between mx-auto">

                {{-- Content (Productos) --}}
                <div class="col-span-5 ml-2 z-10 mb-8">
                    <div class="flex w-full justify-center lg:justify-end">
                        <div
                            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6 md:gap-8 lg:gap-8 w-full mx-4 sm:mx-8 md:mx-12 lg:mx-20">
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
