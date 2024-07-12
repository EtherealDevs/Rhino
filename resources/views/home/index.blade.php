@extends('layouts.app')
@section('content')
    <div class="static justify-center bg-white w-full">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 grid-row-2">
            <div class="col-span-3 mx-6 bg-blue-600 h-full rounded-b-3xl">
                <div class="grid grid-cols-1 lg:grid-cols-3 justify-between gap-6">
                    <div class="justify-start p-20 mt-6 ml-2">
                        <div>
                            <h1 class="text-5xl font-extrabold font-sans text-white">
                                Bienvenidos a <br>
                                <span class="bold">
                                    Rino
                                </span>
                            </h1>
                        </div>
                        <div class="mt-6">
                            <p class="text-lg text-white">
                                Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                                laboriosam,
                                nisi ut al Ut enim ad minima veniam.
                            </p>
                        </div>
                    </div>
                    <div class="justify-items-end z-20 lg:block hidden">
                        <svg class="h-[454px] w-[65.7vw]" viewBox="0 0 954 387" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M477 387L-8.27764e-06 -1.49012e-05H954L477 387Z" fill="url(#paint0_linear_241_3678)" />
                            <defs>
                                <linearGradient id="paint0_linear_241_3678" x1="-0.00012207" y1="193.5" x2="954"
                                    y2="193.5" gradientUnits="userSpaceOnUse">
                                    <stop offset="0.577943" />
                                    <stop offset="1" stop-color="#434343" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                        </svg>

                    </div>
                    <div class="lg:bg-[url('/public/img/modelo1.jpg')] flex bg-cover rounded-br-3xl justify-center">
                        <div class="place-self-end p-12 lg:flex gap-4 z-20 grid grid-cols-1">
                            <button class="p-2 px-4 bg-black text-white rounded-2xl flex items-center space-x-2">
                                <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                        fill="#3E68FF" />
                                </svg>
                                <p class="font-bold">Ver Promociones</p>
                            </button>
                            <button class="p-3 px-4 bg-white rounded-2xl flex items-center space-x-2">
                                <a href="{{ route('login') }}">
                                    <p class="text-black font-bold">Iniciar Sesion</p>
                                </a>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="col-span-1 mx-6 mr-6 bg-center bg-cover bg-[url(https://images.unsplash.com/photo-1543322748-33df6d3db806?q=80&w=3542&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D)] drop-shadow-lg w-full h-full rounded-3xl text-white font-extrabold">
                <div class="bg-black/30 w-full h-full rounded-3xl">
                    <div class="flex justify-center">
                        <p class="text-4xl p-6 mr-6 mt-6">
                            Tendencias
                        </p>
                    </div>
                    <div class="flex justify-start p-4 mb-12">
                        <p class="">
                            kjssnalknsl
                        </p>
                    </div>
                    <div class="flex items-end justify-center">
                        <button class="mr-6 rounded-full bg-black p-3 px-4 flex items-center space-x-2">
                            <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                    fill="#3E68FF" />
                            </svg>
                            <p class="">
                                Ver Tendencias
                            </p>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mx-auto lg:col-span-2 lg:mx-6 bg-blue-600 h-full rounded-3xl text-white font-extrabold">
                <div class="grid grid-cols-2 mt-6">
                    <div class="flex ml-6 lg:ml-16 justify-start">
                        <p class="text-4xl p-6 mr-6">
                            Nuevos Ingresos
                        </p>
                    </div>

                    <div>
                        <button class="rounded-full p-3 px-4 mt-6 bg-black flex items-center space-x-2">
                            <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                    fill="#3E68FF" />
                            </svg>
                            <p class="">
                                Ver Ingresos
                            </p>
                        </button>
                    </div>
                </div>

                <div class="w-full flex justify-center">
                    <!-- component -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        @livewire('product-card', ['product' => $productItem->product, 'item' => $productItem])
                        @livewire('product-card', ['product' => $productItem->product, 'item' => $productItem])
                        @livewire('product-card', ['product' => $productItem->product, 'item' => $productItem])
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <section class="mt-6">
        <div class="col-span-3 mx-6">
            <!-- component -->

            <div class="w-full mx-auto">
                @if ($sales->first() != null)
                    <div id="default-carousel" class="relative" data-carousel="static">
                        <!-- Carousel wrapper -->
                        <div class="overflow-hidden relative rounded-t-[25px] h-[80vh]">
                            <!-- Item 1 -->
                            @foreach ($sales as $sale)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <div class="h-full bg-cover bg-center block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                        style="background-image: url('{{ url(Storage::url($sale->images->first()->url)) }}')">
                                        <p class="flex justify-center text-2xl font-semibold">{{ $sale->title }}</p>
                                        <p class="flex justify-center text-lg">{{ $sale->description }}</p>
                                        <div class="bg-gradient-to-b z-40 h-full from-transparent from-10% to-70% to-white">
                                            <div
                                                class="grid justify-center w-full space-x-4 grid-cols-1 md:flex md:grid-cols-none  translate-y-full">
                                                @foreach ($sale->products as $item)
                                                    @php
                                                        $product = $item->product;
                                                        $productItem = $product->items->first();
                                                    @endphp
                                                    <!-- component -->
                                                    @livewire('product-card', ['product' => $product, 'item' => $productItem])
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
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
                                        d="M15 19l-7-7 7-7">
                                    </path>
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
                                        d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                                <span class="hidden">Next</span>
                            </span>
                        </button>
                    </div>
                    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                @else
                    <p class="flex text-center text-4xl font-bold">No hay promoción creada</p>
                @endif
            </div>
        </div>
    </section>

    <section>
        @livewire('products')
    </section>




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
@endsection
