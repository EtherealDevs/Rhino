<section class="bg-white relative">
    <div class="w-full">
        {{-- Navbar --}}
        <div class="w-full grid grid-cols-8 justify-between p-14 overflow-x-hidden">
            <div class="mx-auto col-span-8 relative">
                <h2 class="w-12 border-b-2 text-2xl font-extrabold font-josefin italic border-gray-500">Colección</h2>
                <div class="grid grid-cols-2 lg:grid-cols-6 mt-3 relative">
                    @foreach ($categories as $category)
                        @if (is_null($category->parent_id))
                            <a href="{{ route('collection.index', ['category' => $category->id]) }}"
                                class="collection-item px-6 border-r-2 border-gray-300 italic font-semibold">
                                <p>{{ $category->name }}</p>
                            </a>
                        @endif
                    @endforeach
                </div>
                <div class="underline-bar absolute"></div>
            </div>
        </div>

        {{-- Main content with sidebar and products --}}
        <div class="justify-between md:flex relative">
            <div class="xl:w-1/4 2xl:w-[310px] left-2 md:mt-10 xl:mb-4 xl:mt-6 z-40 md:z-0 sticky top-28">
                @livewire('sidebar', ['categories' => $categories, 'sizes' => $sizes])
            </div>

            {{-- Content (Productos) --}}
            <div class="col-span-5 ml-0 xl:ml-1 z-10 mb-8 overflow-hidden">
                @if ($combos->isNotEmpty())
                    <div class="bg-center bg-contain w-full lg:h-[900px] xl:w-[calc(100%-12px)] 2xl:w-[calc(100%-12px)] h-[700px] bg-gradient-to-r from-black  via-gray-900 to-neutral-800 lg:rounded-3xl">
                        <div class="backdrop-blur-2xl h-full w-full py-14 rounded-none lg:rounded-3xl">
                            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 lg:gap-0 items-center p-8">
                                <div class="lg:col-span-4 text-center lg:text-left mt-6 lg:mt-0">
                                    <h2 class="text-neutral-200 font-bold px-4 font-josefin text-2xl lg:text-4xl italic leading-tight">
                                        Estilo y Ahorro: <br>
                                        <span class="text-slate-200 font-light not-italic">
                                            Descubre Nuestros <span class="italic">Combos de Ropa</span>
                                        </span>
                                    </h2>
                                </div>

                                <div class="lg:col-span-1 flex justify-center lg:justify-start">
                                    <a href="/combos">
                                        <button class="rounded-full py-3 px-6 bg-black flex items-center space-x-2 hover:bg-white transition-colors text-white hover:text-blue-900">
                                            <svg width="25" height="20" viewBox="0 0 25 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z" fill="#3E68FF"/>
                                            </svg>
                                            <p>Ver todos</p>
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <div x-data="{
                                activeSlide: 0,
                                slides: {{ count($combos) }},
                                autoplay: null,
                                init() {
                                    this.autoplay = setInterval(() => {
                                        this.nextSlide();
                                    }, 5000);
                                },
                                nextSlide() {
                                    this.activeSlide = this.activeSlide === this.slides - 1 ? 0 : this.activeSlide + 1;
                                },
                                prevSlide() {
                                    this.activeSlide = this.activeSlide === 0 ? this.slides - 1 : this.activeSlide - 1;
                                },
                                goToSlide(index) {
                                    this.activeSlide = index;
                                    clearInterval(this.autoplay);
                                    this.autoplay = setInterval(() => {
                                        this.nextSlide();
                                    }, 5000);
                                }
                            }" @keydown.arrow-right.window="nextSlide()" @keydown.arrow-left.window="prevSlide()"
                            class="max-w-7xl mx-auto mt-6 relative">
                                <div class="relative overflow-hidden h-[400px] sm:h-56 md:h-64 lg:h-72 xl:h-[550px] 2xl:h-[590px] rounded-lg">
                                    @foreach ($combos as $index => $combo)
                                        <div x-show="activeSlide === {{ $index }}"
                                            x-transition:enter="transition ease-out duration-500"
                                            x-transition:enter-start="opacity-0 transform translate-x-full"
                                            x-transition:enter-end="opacity-100 transform translate-x-0"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 transform translate-x-0"
                                            x-transition:leave-end="opacity-0 transform -translate-x-full"
                                            class="absolute inset-0 flex items-center justify-center">
                                            <div class="w-full max-w-4xl mx-auto px-0 lg:px-8">
                                                <a href="{{ route('combos.show', $combo) }}" class="block w-full flex justify-center">
                                                    @livewire('combo', ['id' => $combo->id], key($combo->id))
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button @click="prevSlide(); clearInterval(autoplay)"
                                    class="absolute top-1/2 left-4 -translate-y-1/2 z-30 hover:scale-110 transition-transform">
                                    <span class="inline-flex justify-center items-center w-10 h-10 rounded-full bg-white/100 text-black hover:bg-white/70">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </span>
                                </button>

                                <button @click="nextSlide(); clearInterval(autoplay)"
                                    class="absolute top-1/2 right-4 -translate-y-1/2 z-30 hover:scale-110 transition-transform">
                                    <span class="inline-flex justify-center items-center w-10 h-10 rounded-full bg-white/100 text-black hover:bg-white/70">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                </button>

                                <div class="absolute bottom-5 hidden mt-12 left-1/2 transform -translate-x-1/2 z-30 flex space-x-3">
                                    @foreach ($combos as $index => $combo)
                                        <button @click="goToSlide({{ $index }})"
                                            :class="{ 'bg-white': activeSlide === {{ $index }}, 'bg-white/50': activeSlide !== {{ $index }} }"
                                            class="w-3 h-3 rounded-full transition-colors duration-300 hover:scale-125">
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="xl:ml-[1px] xl:mt-4 2xl:ml-0 flex w-full justify-center lg:justify-end">
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 2xl:grid-cols-5 lg:grid-cols-4 xl:grid-cols-4 gap-4 sm:gap-6 md:gap-8 lg:gap-8 xl:gap-x-16 w-full mx-4 sm:mx-8 md:mx-12 lg:mx-20 xl:ml-0">
                        @foreach ($products as $product)
                            @livewire('product-card', ['product' => $product, 'item' => $product->items->first()])
                        @endforeach
                    </div>
                </div>
                <div class="p-5 py-42">
                    {{ $products->links() }}
                </div>
            </div>
        </div>

        <style>
            input[type=range]::-webkit-slider-thumb {
                pointer-events: all;
                width: 24px;
                height: 24px;
                -webkit-appearance: none;
            }

            .collection-item {
                position: relative;
                cursor: pointer;
                width: 50%;
                border-right: 2px;
                padding-bottom: 4px;
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
                    min: 1,
                    max: 300000,
                    minprice: 1,
                    maxprice: 300000,
                    minthumb: 0,
                    maxthumb: 100,
                    mintrigger() {
                        if (this.minprice < this.min) {
                            this.minprice = this.min;
                        }
                        this.minthumb = ((this.minprice - this.min) / (this.max - this.min)) * 100;
                    },
                    maxtrigger() {
                        if (this.maxprice < this.min) {
                            this.maxprice = this.min;
                        }
                        this.maxthumb = 100 - (((this.maxprice - this.min) / (this.max - this.min)) * 100);
                    }
                }
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const items = document.querySelectorAll('.collection-item');
                const underlineBar = document.querySelector('.underline-bar');

                items.forEach(item => {
                    item.addEventListener('mouseover', (e) => {
                        const {offsetLeft, offsetWidth} = e.target.closest('.collection-item');
                        underlineBar.style.width = `${offsetWidth}px`;
                        underlineBar.style.transform = `translateX(${offsetLeft}px)`;
                    });
                });

                document.querySelector('.grid').addEventListener('mouseleave', () => {
                    underlineBar.style.width = `0`;
                });
            });
        </script>
        <script src="lazysizes.min.js" async=""></script>
</section>
