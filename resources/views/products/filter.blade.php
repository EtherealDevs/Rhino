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
            <div class="justify-between md:flex relative">
                @livewire('sidebar', ['categories' => $categories,'sizes'=>$sizes])

                {{-- Content (Productos) --}}
                <div class="col-span-5 ml-0 lg:ml-2 z-10 mb-8">
                    <div class="xl:ml-[18px] 2xl:ml-0 flex w-full justify-center lg:justify-end">
                        <div
                            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6 md:gap-8 lg:gap-8 xl:gap-x-16 w-full mx-4 sm:mx-8 md:mx-12 lg:mx-24 xl:ml-0">
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
