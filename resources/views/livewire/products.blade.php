<section class="bg-white relative ">
    <div class="w-full">
        {{-- Navbar --}}
        <div class="w-full grid grid-cols-8 justify-between p-14">
            <div class="mx-auto col-span-8 relative">
                <h2 class="w-12 border-b-2 text-2xl font-extrabold font-josefin italic border-gray-500">Colección</h2>
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

        {{-- Main content with sidebar and products --}}
        <div class="justify-between md:flex relative">
            <div class="xl:w-1/4">
                @livewire('sidebar', ['categories' => $categories, 'sizes' => $sizes])
            </div>

            {{-- Content (Productos) --}}
            <div class="col-span-5 ml-0 xl:ml-4 z-10 mb-8">
                <div class="bg-center bg-contain w-[1100px] bg-[url(/public/img/new.png)] lg:rounded-3xl">
                    <div class="backdrop-blur-2xl h-full w-full py-14 rounded-none lg:rounded-3xl">
                        <div class="flex flex-col lg:flex-row lg:items-center ">
                            <!-- Contenido de texto -->
                            <div class="flex-1 lg:mr-6 mt-12 lg:mt-0">
                                <h2
                                    class="text-blue-100 font-bold p-4 px-10 font-josefin text-2xl lg:text-4xl italic leading-tight">
                                    Estilo y Ahorro: <br>
                                    <span class="text-blue-200 font-light not-italic">
                                        Descubre Nuestros <span class="italic">Combos de Ropa</span>
                                    </span>
                                </h2>
                            </div>

                            <!-- Botón -->
                            <div class="mt-12 lg:mt-0 lg:w-1/2 flex justify-center">
                                <a href="/combos">
                                    <button
                                        class="rounded-full p-3 px-6 bg-black flex items-center space-x-2 hover:bg-white transition-colors text-white hover:text-blue-900">
                                        <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                                fill="#3E68FF" />
                                        </svg>
                                        <p>Ver todos</p>
                                    </button>
                                </a>
                            </div>
                        </div>

                        <!-- Carrusel -->
                        <div class="max-w-7xl mx-auto mt-6">
                            <div id="default-carousel" class="relative" data-carousel="static">
                                <!-- Carousel wrapper -->
                                <div
                                    class="overflow-hidden relative h-[900px] sm:h-56 md:h-64 lg:h-72 xl:h-[550px] 2xl:h-[590px] rounded-lg">
                                    <!-- Item 1 -->
                                    @foreach ($combos as $combo)
                                        <!-- Item -->
                                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                            <div
                                                class="absolute top-1/2 left-1/2 text-xl sm:text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2">
                                                <a href="{{ route('combos.show', $combo) }}">@livewire('combo', ['id' => $combo->id])</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Slider controls -->
                                <button type="button"
                                    class="flex absolute top-0 left-0 z-30 justify-center items-center px-0 md:px-4 h-full cursor-pointer group focus:outline-none"
                                    data-carousel-prev>
                                    <span
                                        class="inline-flex justify-center items-center w-10 h-10 rounded-full sm:w-10 sm:h-10 bg-white/100 text-black hover:bg-white/70 group-focus:ring-4 group-focus:ring-black">
                                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
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
                                        class="inline-flex justify-center items-center w-10 h-10 rounded-full sm:w-10 sm:h-10 bg-white/100 text-transparent font-bold  hover:bg-white/70 group-focus:ring-4 group-focus:ring-black">
                                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
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
                </div>

                <div class="xl:ml-[1px] xl:mt-4 2xl:ml-0 flex w-full justify-center lg:justify-end">
                    <div
                        class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6 md:gap-8 lg:gap-8 xl:gap-x-16 w-full mx-4 sm:mx-8 md:mx-12 lg:mx-20 xl:ml-0">
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
                min: 1, // Valor mínimo del rango
                max: 500000,
                minprice: 1,
                maxprice: 500000,
                minthumb: 0, // Inicialmente 0 pero será ajustado por mintrigger
                maxthumb: 100,
                mintrigger() {
                    if (this.minprice < this.min) { // Verifica que no sea menor al mínimo permitido
                        this.minprice = this.min;
                    }
                    this.minthumb = ((this.minprice - this.min) / (this.max - this.min)) * 100;
                },
                maxtrigger() {
                    if (this.maxprice < this.min) { // Verifica que no sea menor al mínimo permitido
                        this.maxprice = this.min;
                    }
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
