@extends('layouts.app')
@section('content')
    <div class="static justify-center bg-white w-full">
        <div class="grid grid-cols-1 h-full lg:grid-cols-3 lg:grid-rows-2 gap-0 lg:gap-6 ">

            {{-- Seccion Bienvenida y Ofertas --}}
            <div class=" lg:col-span-3 mx-0 lg:mx-6 bg-black h-full rounded-none lg:rounded-b-3xl">
                <div class="grid grid-cols-1 lg:grid-cols-5 justify-between h-full gap-0">

                    {{-- Seccion de Bienvenida --}}
                    <div class="col-span-2 px-8 mb-6 my-32 lg:mb-0 bg-black rounded-none lg:rounded-bl-3xl shadow-lg">
                        <div class="text-center">
                            <h1 class="text-4xl lg:text-5xl font-extrabold font-josefin text-white mb-4">
                                Bienvenidos a
                            </h1>
                            <img class="mx-auto rounded-xl shadow-lg lg:w-3/4 w-3/5 mt-6 " src="/img/rino.png"
                                alt="Your Company">
                        </div>
                        <div class="mt-6 text-center">
                            <p class="text-lg italic font-josefin text-white leading-relaxed">
                                Aca vas a encontrar una selección cuidada de prendas y accesorios diseñados para resaltar tu
                                estilo y personalidad. <span class="font-bold">¡Explora nuestra colección y descubre lo que
                                    te hace único!</span>
                            </p>
                        </div>
                    </div>


                    {{-- Carrousel --}}
                    <div class="col-span-3 h-full flex rounded-none lg:rounded-br-3xl">
                        <div class="max-w-7xl w-full justify-end">

                            <div id="default-carousel" class="relative h-full" data-carousel="active">
                                <!-- Carousel wrapper -->
                                <div class="overflow-hidden relative h-48 sm:h-96 lg:h-[580px]">
                                    <!-- Item 1 -->
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="/img/banners/banner1.png"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="...">
                                    </div>
                                    <!-- Item 2 -->
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="/img/banners/banner3.png"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="...">
                                    </div>
                                    <!-- Item 3 -->
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="/img/banners/banner2.jpeg"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="...">
                                    </div>
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="/img/banners/banner4.png"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="...">
                                    </div>
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
                            <style>
                                [data-carousel-item] {
                                    position: absolute;
                                    inset: 0;
                                    transition: opacity 5s ease-in-out;
                                }

                                .opacity-0 {
                                    opacity: 0;
                                }

                                .opacity-100 {
                                    opacity: 1;
                                }
                            </style>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const carousel = document.querySelector('#default-carousel');
                                    const items = carousel.querySelectorAll('[data-carousel-item]');
                                    let currentIndex = 0;
                                    const intervalTime = 12000; // 12 seconds

                                    const showSlide = (index) => {
                                        items.forEach((item, i) => {
                                            item.classList.toggle('hidden', i !== index);
                                        });
                                    };

                                    const nextSlide = () => {
                                        currentIndex = (currentIndex + 1) % items.length;
                                        showSlide(currentIndex);
                                    };

                                    // Initialize carousel
                                    showSlide(currentIndex);

                                    // Set interval for automatic slide transition
                                    setInterval(nextSlide, intervalTime);
                                });
                            </script>
                            <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Seccion Nuevos Ingresos --}}
            <div
                class=" lg:col-span-2 lg:ml-6 bg-center bg-contain bg-[url(/public/img/new.png)] h-full rounded-none lg:rounded-3xl text-white font-extrabold">
                <div class="backdrop-blur-2xl h-full w-full py-14 rounded-none lg:rounded-3xl">
                    <div class="grid grid-cols-2">
                        <div class="flex mt-5 ml-6 lg:ml-16 justify-start">
                            <p class="text-4xl pb-8 italic font-bold mr-6 text-white">
                                Nuevos Ingresos
                            </p>
                        </div>

                        <div class="mt-4 flex justify-end pr-6"> <!-- Añadir "flex justify-end pr-6" aquí -->
                            <button
                                class="rounded-full p-1 lg:p-3 px-4 mt-6 bg-black flex items-center space-x-2 hover:bg-white transition-colors hover:text-blue-900"
                                style="
                                height: 42px;
                            >
                                <svg width="25"
                                height="20" viewBox="0 0 25 20" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        <div class="grid grid-cols-2 lg:grid-cols-3 xl:gap-8 gap-8">
                            @foreach ($latestProductItems as $productItem)
                                @livewire('product-card', ['product' => $productItem->product, 'item' => $productItem])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Seccion Ofertas --}}
            <div
                class="relative lg:col-span-1 drop-shadow-lg w-full lg:w-[520px] xl:w-[460px] h-full rounded-none lg:rounded-3xl text-white font-extrabold">
                <!-- Video de fondo -->
                <video autoplay muted loop playsinline
                    class="absolute inset-0 w-full h-full object-cover rounded-none lg:rounded-3xl">
                    <source src="/img/nigga.mp4" type="video/mp4">
                </video>

                <!-- Capa de superposición oscura -->
                <div class="relative bg-black/30 w-full h-full rounded-none lg:rounded-3xl mb-8">
                    <div class="flex justify-center">
                        <p class="text-3xl p-12 mr-6 mt-6 italic font-extrabold text-blue-100 tracking-wide">
                            ¡No Dejes Pasar Nuestras Ofertas Exclusivas!
                        </p>
                    </div>
                    <div class="flex justify-start p-4 mb-12">
                        <p class="text-center mt-6 text-xl mx-8   py-2 px-4 rounded-full shadow-lg">
                            Disponibles por tiempo limitado. No dejes pasar esta oportunidad de ahorrar y disfrutar de la
                            mejor calidad al mejor precio.
                        </p>
                    </div>

                    <div class="flex items-end justify-center">
                        <a href="/promos">
                            <button
                                class="mr-6 rounded-full bg-blue-400 text-white hover:bg-white transition-colors hover:text-blue-900 p-3 px-4 flex items-center space-x-2">
                                <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                        fill="#290880" />
                                </svg>
                                <p class="">Descubrelas Aqui</p>
                            </button>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Carrousel Promociones --}}
    <section class="mt-0 lg:mt-6">
        <div class="col-span-3 mx-0 lg:mx-6">
            <div class="w-full mx-auto">
                @if ($sales->first() != null)
                    <div id="default-carousel" class="relative" data-carousel="active">
                        <!-- Carousel wrapper -->
                        <div class="overflow-hidden relative rounded-none lg:rounded-t-[25px] h-[90vh]">
                            <!-- Items -->
                            @foreach ($sales as $sale)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <div class="h-full bg-cover bg-center block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                        style="background-image: url('{{ url(Storage::url($sale->images->first()->url)) }}')">
                                        <div class="w-full flex justify-end">
                                            {{--  <a href="/promos">
                                                <button
                                                    class="rounded-full p-3 px-4 mt-12 mr-24 bg-black text-white flex items-center space-x-2 hover:bg-white transition-colors hover:text-blue-900">
                                                    <svg width="25" height="20" viewBox="0 0 25 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                                            fill="#3E68FF" />
                                                    </svg>
                                                    <p class="">
                                                        Ver promociones Activas
                                                    </p>
                                                </button>
                                            </a> --}}
                                        </div>
                                        <div
                                            class="flex flex-col py-20 space-y-4 bg-gradient-to-b z-40 h-full from-transparent from-10% to-70% to-white">

                                            <div class="flex justify-center">
                                                <p
                                                    class="font-bold font-josefin py-2 px-8 rounded-tl-3xl rounded-br-3xl bg-black text-white justify-center text-3xl">
                                                    {{ $sale->title }}</p>
                                            </div>
                                            <p class="flex justify-center text-white text-lg">{{ $sale->description }}</p>
                                            <div class="">
                                                <div
                                                    class="grid mt-24 gap-1 justify-center w-full space-x-4 grid-cols-2 lg:grid-cols-4 md:flex ">
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
                                            {{-- Boton de Promociones --}}
                                            <div class="flex justify-center">
                                                <a href="/promos">
                                                    <button
                                                        class="rounded-full p-1 lg:p-3 px-4 text-white mt-6 bg-black hover:ring-2 ring-black flex items-center space-x-2 hover:bg-white transition-colors hover:text-blue-900"
                                                        style="height: 42px;>
                                                    
                                                    <p class="ml-2">
                                                        Ver mas Promociones <span class="ml-2 text-xl">→</span>
                                                        </p>
                                                    </button>
                                                </a>
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
