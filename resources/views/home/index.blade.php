@extends('layouts.app')

@section('title', 'Bienvenidos a Rino Indumentaria | Moda Única')

@section('meta_description',
    'Descubre la última moda para hombres y adolescentes en nuestra tienda online. Desde ropa
    casual y deportiva hasta estilos más formales, tenemos todo lo que necesitas para lucir a la última. ¡Renueva tu armario
    con las últimas tendencias! #modamasculina #ropaonline #tendencias')

@section('content')
    <div class="static justify-center bg-white w-full">
        <div class="grid grid-cols-1 h-full lg:grid-cols-3 lg:grid-rows-2 gap-0 lg:gap-6 ">
            {{-- Seccion Bienvenida y Ofertas --}}
            <div class=" lg:col-span-3 mx-0 lg:mx-6 bg-black h-full rounded-none lg:rounded-b-3xl">
                <div class="grid grid-cols-1 lg:grid-cols-6 justify-between h-full gap-0">
                    {{-- Seccion de Bienvenida --}}
                    <div class="col-span-2 px-8 mb-6 my-24 lg:mb-0 bg-black rounded-none lg:rounded-bl-3xl shadow-lg">
                        <div class="text-center">
                            <h1 class="neon-text text-4xl lg:text-5xl font-extrabold font-josefin text-white mb-4">
                                Bienvenido a <span class="hidden">Rino Indumentaria</span>
                            </h1>
                            <style>
                                .neon-text {
                                    position: relative;
                                    color: white;
                                    text-shadow: 0 0 5px rgb(46, 61, 221), 0 0 10px rgb(21, 87, 255), 0 0 20px #0ff, 0 0 40px #00f, 0 0 80px #00f;
                                    /* Resplandor extendido */
                                    font-family: 'Josefin Sans', sans-serif;
                                    /* Asegúrate de cargar esta fuente */
                                }

                                /* Efecto adicional al contenedor */
                                .neon-text::after {
                                    content: '';
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    background: rgba(0, 255, 255, 0.1);
                                    /* Sutil brillo alrededor */
                                    filter: blur(10px);
                                    z-index: -1;
                                    border-radius: 5px;
                                }
                            </style>
                            <script>
                                document.addEventListener('DOMContentLoaded', () => {
                                    document.querySelector('.neon-text').classList.add('neon-active');
                                });
                            </script>

                            <img class="mx-auto rounded-xl shadow-lg lg:w-3/4 w-full mt-6" src="/img/rino.webp"
                                alt="Your Company" width="600" height="400">
                        </div>
                        <div class="mt-6 mx-12 text-center">
                            <h2 class="text-sm lg:py-2 py-12 lg:text-lg italic font-josefin text-white leading-relaxed">
                                Aca vas a encontrar una selección cuidada de prendas para resaltar tu estilo <span
                                    class="font-bold">¡Explora la colección y descubre lo que te hace único!</span>
                            </h2>
                            <a class="justify-center flex w-full lg:mt-6" href="/products">
                                <button
                                    class="mr-6 mb-6 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors p-3 px-4 flex items-center space-x-2">
                                    <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                            fill="white" />
                                    </svg>
                                    <p class="">Ver Productos</p>
                                </button>
                            </a>
                        </div>
                    </div>


                    {{-- Carrousel --}}
                    <div class="col-span-4 h-full flex">
                        <div class="max-w-7xl w-full justify-end">
                            <div id="default-carousel" class="relative h-full" data-carousel="active">
                                <!-- Carousel wrapper -->
                                <div class="overflow-hidden relative h-48 sm:h-96 lg:h-[580px]">
                                    <!-- Item 1 -->
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="/img/banners/1.webp"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="..." loading="lazy">
                                    </div>
                                    <!-- Item 3 -->
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="/img/banners/2.webp"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="..." loading="lazy">
                                    </div>
                                    <!-- Item 2 -->
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="/img/banners/3.webp"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="..." loading="lazy">
                                    </div>
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="/img/banners/4.webp"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="Banner de tienda física" loading="lazy">
                                    </div>
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="/img/banners/5.webp"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="..." loading="lazy">
                                        <!-- Botón que redirige a Google Maps -->
                                        {{-- <div
                                            class="absolute bottom-10 z-50 left-1/2 transform -translate-y-3/4 -translate-x-1/2">
                                            <a href="https://maps.app.goo.gl/ejFFD1789TdA8fuj9" target="_blank"
                                                class="flex items-center justify-center w-12 h-12 bg-white text-white hover:scale-125 rounded-full focus:ring-4 focus:ring-blue-300 transition">
                                                <!-- Icono SVG de Google Maps -->
                                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="0.7em"
                                                    height="1em" viewBox="0 0 256 367">
                                                    <path fill="#34a853"
                                                        d="M70.585 271.865a371 371 0 0 1 28.911 42.642c7.374 13.982 10.448 23.463 15.837 40.31c3.305 9.308 6.292 12.086 12.714 12.086c6.998 0 10.173-4.726 12.626-12.035c5.094-15.91 9.091-28.052 15.397-39.525c12.374-22.15 27.75-41.833 42.858-60.75c4.09-5.354 30.534-36.545 42.439-61.156c0 0 14.632-27.035 14.632-64.792c0-35.318-14.43-59.813-14.43-59.813l-41.545 11.126l-25.23 66.451l-6.242 9.163l-1.248 1.66l-1.66 2.078l-2.914 3.319l-4.164 4.163l-22.467 18.304l-56.17 32.432z" />
                                                    <path fill="#fbbc04"
                                                        d="M12.612 188.892c13.709 31.313 40.145 58.839 58.031 82.995l95.001-112.534s-13.384 17.504-37.662 17.504c-27.043 0-48.89-21.595-48.89-48.825c0-18.673 11.234-31.501 11.234-31.501l-64.489 17.28z" />
                                                    <path fill="#4285f4"
                                                        d="M166.705 5.787c31.552 10.173 58.558 31.53 74.893 63.023l-75.925 90.478s11.234-13.06 11.234-31.617c0-27.864-23.463-48.68-48.81-48.68c-23.969 0-37.735 17.475-37.735 17.475v-57z" />
                                                    <path fill="#1a73e8"
                                                        d="M30.015 45.765C48.86 23.218 82.02 0 127.736 0c22.18 0 38.89 5.823 38.89 5.823L90.29 96.516H36.205z" />
                                                    <path fill="#ea4335"
                                                        d="M12.612 188.892S0 164.194 0 128.414c0-33.817 13.146-63.377 30.015-82.649l60.318 50.759z" />
                                                </svg>
                                            </a>
                                        </div> --}}
                                    </div>
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="/img/banners/6.webp"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="..." loading="lazy">
                                    </div>
                                    {{-- <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="/img/banners/7.webp"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="..." loading="lazy">
                                    </div>
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="/img/banners/8.webp"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="..." loading="lazy">
                                    </div> --}}
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
                                <!-- Slider controls -->
                                <button type="button"
                                    class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                                    data-carousel-prev>
                                    <span
                                        class="inline-flex justify-center items-center w-10 h-10 rounded-full sm:w-10 sm:h-10 bg-white/80 text-black hover:bg-white/100 group-focus:ring-4 group-focus:ring-black group-focus:outline-none">
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
                                        class="inline-flex justify-center items-center w-10 h-10 rounded-full sm:w-10 sm:h-10 bg-white/80 text-black hover:bg-white/100 group-focus:ring-4 group-focus:ring-black">
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
                class=" lg:col-span-2 lg:ml-6 bg-gradient-to-r from-black  via-gray-900 to-neutral-800 h-full rounded-none lg:rounded-3xl text-white font-extrabold">
                <div class="backdrop-blur-2xl h-full w-full py-14 rounded-none lg:rounded-3xl">
                    <div class="grid grid-cols-2">
                        <div class="flex mt-5 ml-6 lg:ml-16 justify-start">
                            <p class="neon-text text-4xl pb-8 italic font-bold font-josefin mr-6 text-white">
                                Nuevos Ingresos
                            </p>

                            <style>
                                .neon-text {
                                    color: #ffffff;
                                    /* Color base del texto (blanco) */
                                    text-shadow:
                                        0 0 5px #1323ff,
                                        /* Resplandor interno */
                                        0 0 10px #1323ff,
                                        0 0 20px #1323ff,
                                        0 0 40px #1323ff,
                                        0 0 80px #1323ff,
                                        /* Resplandor más externo */
                                        0 0 120px #0066ff;
                                    /* Toque adicional para profundidad */
                                    font-family: 'Josefin Sans', sans-serif;
                                    /* Fuente personalizada */
                                    font-style: italic;
                                    /* Estilo en cursiva */
                                }
                            </style>
                        </div>
                        <div class="mt-4 flex justify-end pr-6"> <!-- Añadir "flex justify-end pr-6" aquí -->
                            <a href="/products">
                                <button
                                    class="rounded-full p-1 lg:p-3 px-4 mt-6 bg-black flex items-center space-x-2 hover:bg-white transition-colors hover:text-blue-900"
                                    style="
                                height: 42px;
                            >
                                <svg width="25"
                                    height="20" viewBox="0 0 25 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                        fill="#3E68FF" />
                                    </svg>
                                    <p class="">
                                        Ver Ingresos
                                    </p>
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="w-full flex justify-center">
                        <div class="grid grid-cols-2 lg:grid-cols-3 xl:gap-8 gap-4">
                            @foreach ($latestProductItems as $index => $productItem)
                                @php
                                    $item = $productItem;
                                    $product = $productItem->product;
                                @endphp
                                @livewire('product-card', ['product' => $product, 'item' => $item])
                            @endforeach
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            function adjustProductVisibility() {
                                const screenWidth = window.innerWidth;
                                const hiddenProduct = document.querySelector('.desktop-hidden');

                                // Oculta el cuarto producto en pantallas grandes (ancho >= 1024px)
                                if (screenWidth >= 1024 && hiddenProduct) {
                                    hiddenProduct.style.display = 'none';
                                } else if (hiddenProduct) {
                                    hiddenProduct.style.display = 'block';
                                }
                            }

                            // Ejecuta la función cuando se carga la página
                            adjustProductVisibility();

                            // Ejecuta la función cuando se cambia el tamaño de la ventana
                            window.addEventListener('resize', adjustProductVisibility);
                        });
                    </script>


                </div>
            </div>

            {{-- Seccion Ofertas --}}
            <div
                class="relative lg:col-span-1 drop-shadow-lg w-full xl:w-[410px] 2xl:w-[450px] h-full rounded-none lg:rounded-3xl overflow-hidden text-white font-extrabold">

                <!-- Video con efecto de zoom controlado -->
                <video autoplay muted loop playsinline
                    class="absolute inset-0 w-full h-full object-cover transform scale-125 rounded-none lg:rounded-3xl">
                    <source src="/img/Rino.mp4" type="video/mp4">
                </video>

                <!-- Contenido superpuesto -->
                <div class="relative bg-black/30 w-full h-full rounded-none lg:rounded-3xl mb-8">
                    <div class="flex justify-center">
                        <p class="text-3xl p-12 mr-6 mt-6 italic font-extrabold font-josefin text-white tracking-wide">
                            ¡No Dejes Pasar Nuestras Ofertas Exclusivas!
                        </p>
                    </div>
                    <div class="flex justify-start p-4 mb-12">
                        <p class="text-center mt-6 text-xl mx-8 font-josefin py-2 px-4">
                            Disponibles por tiempo limitado. No dejes pasar esta oportunidad de ahorrar y disfrutar de la
                            mejor
                            calidad al mejor precio.
                        </p>
                    </div>
                    <div class="flex items-end justify-center">
                        <a href="/promos">
                            <button
                                class="mr-6 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors p-3 px-4 flex items-center space-x-2">
                                <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                        fill="white" />
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
                    <div></div>
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
