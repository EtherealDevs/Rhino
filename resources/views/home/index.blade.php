@extends('layouts.app')
@section('content')
    <div class="static justify-center bg-white w-screen">
        <section>
            <div class="grid grid-cols-3 gap-6 grid-row-2">
                <div class="col-span-3 mx-6 bg-blue-600 h-full rounded-b-3xl">
                    <div class="grid grid-cols-2 justify-between gap-6">
                        <div class="justify-start p-20 mt-6 ml-2">
                            <div>
                                <h1 class="text-3xl font-black font-sans text-white">
                                    Bienvenidos a <br>
                                    <span class="bold">
                                        Rino
                                    </span>
                                </h1>
                            </div>

                            <div class="mt-6">
                                <p class="text-md text-white">
                                    Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                                    laboriosam,
                                    nisi ut al Ut enim ad minima veniam.
                                </p>
                            </div>
                        </div>
                        <div class="place-self-end p-12 flex gap-4">
                            <button class="p-2 px-2 bg-white rounded-2xl flex items-center space-x-2">
                                <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                        fill="#3E68FF" />
                                </svg>
                                <p class="font-bold">Ver Promociones</p>
                            </button>
                            <button class="p-2 px-2 bg-black rounded-2xl flex items-center space-x-2">
                                <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                        fill="#3E68FF" />
                                </svg>
                                <p class="text-white font-bold">Iniciar Sesion</p>
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    class="col-span-1 mx-6 mr-6 bg-blue-600 drop-shadow-lg w-full h-full rounded-3xl text-white font-extrabold">
                    <div class="flex justify-end">
                        <p class="text-2xl p-6 mr-6">
                            Tendencias
                        </p>
                    </div>
                    <div class="flex items-end justify-end">
                        <button class="mr-6 rounded-full bg-black p-2 px-2 flex items-center space-x-2">
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

                <div class="col-span-2 mx-6 bg-blue-600 h-full rounded-3xl text-white font-extrabold">
                    <div class="grid grid-cols-2 mt-6">
                        <div class="flex ml-16 justify-start">
                            <p class="text-2xl p-6 mr-6">
                                Nuevos Ingresos
                            </p>


                        </div>

                        <div>
                            <button class="rounded-full px-4 p-2 mt-6 bg-black flex items-center space-x-2">
                                <svg width="25" height="20" viewBox="0 0 25 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.7595 11.4133C24.1224 11.0383 24.3262 10.53 24.3262 9.99996C24.3262 9.46996 24.1224 8.96163 23.7595 8.58663L16.4539 1.0413C16.0904 0.666104 15.5974 0.455322 15.0834 0.455322C14.5694 0.455322 14.0764 0.666104 13.713 1.0413C13.3495 1.41649 13.1453 1.92536 13.1453 2.45596C13.1453 2.98657 13.3495 3.49544 13.713 3.87063L17.712 7.99996L2.81259 7.99996C2.29873 7.99996 1.80592 8.21068 1.44257 8.58575C1.07922 8.96082 0.875088 9.46953 0.875088 9.99996C0.875088 10.5304 1.07922 11.0391 1.44257 11.4142C1.80592 11.7892 2.29873 12 2.81259 12L17.712 12L13.713 16.128C13.533 16.3137 13.3902 16.5343 13.2928 16.777C13.1954 17.0197 13.1453 17.2799 13.1453 17.5426C13.1453 17.8054 13.1954 18.0655 13.2928 18.3082C13.3902 18.551 13.533 18.7715 13.713 18.9573C13.8929 19.1431 14.1066 19.2904 14.3417 19.391C14.5769 19.4915 14.8289 19.5433 15.0834 19.5433C15.3379 19.5433 15.59 19.4915 15.8251 19.391C16.0602 19.2904 16.2739 19.1431 16.4539 18.9573L23.7595 11.4133Z"
                                        fill="#3E68FF" />
                                </svg>
                                <p class="">
                                    Ver Nuevos Ingresos
                                </p>
                            </button>
                        </div>
                    </div>

                    <div class="w-full flex justify-center">
                        <!-- component -->
                        <div class="grid grid-cols-3 gap-8">
                            <div
                                class="relative flex w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                                <div
                                    class="relative mx-3 mt-3 h-40 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                                    <img src="https://images.unsplash.com/photo-1578262825743-a4e402caab76?ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80"
                                        class="h-full w-full object-cover" />
                                    <div
                                        class="absolute top-2 left-2 bg-[#5FA878] text-white text-sm font-bold rounded-full px-2 py-1">
                                        $12.00
                                    </div>
                                    <div class="absolute top-2 right-2 flex flex-col space-y-2">
                                        <button
                                            class="bg-black/20 text-gray-600 hover:bg-gray-600 p-2 rounded-full transition">
                                            <svg width="18" height="16" viewBox="0 0 17 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.5 16L7.2675 14.849C2.89 10.7771 0 8.08283 0 4.79564C0 2.10136 2.057 0 4.675 0C6.154 0 7.5735 0.706267 8.5 1.81362C9.4265 0.706267 10.846 0 12.325 0C14.943 0 17 2.10136 17 4.79564C17 8.08283 14.11 10.7771 9.7325 14.849L8.5 16Z"
                                                    fill="red" />
                                            </svg>
                                        </button>
                                        <button
                                            class="bg-black/20 text-gray-600 hover:bg-gray-600 p-2 rounded-full transition">
                                            <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15.2 14.4C14.1455 14.4 13.3 15.201 13.3 16.2C13.3 16.6774 13.5002 17.1352 13.8565 17.4728C14.2128 17.8104 14.6961 18 15.2 18C15.7039 18 16.1872 17.8104 16.5435 17.4728C16.8998 17.1352 17.1 16.6774 17.1 16.2C17.1 15.7226 16.8998 15.2648 16.5435 14.9272C16.1872 14.5896 15.7039 14.4 15.2 14.4ZM0 0V1.8H1.9L5.32 8.631L4.028 10.836C3.8855 11.088 3.8 11.385 3.8 11.7C3.8 12.1774 4.00018 12.6352 4.3565 12.9728C4.71282 13.3104 5.19609 13.5 5.7 13.5H17.1V11.7H6.099C6.03601 11.7 5.9756 11.6763 5.93106 11.6341C5.88652 11.5919 5.8615 11.5347 5.8615 11.475C5.8615 11.43 5.871 11.394 5.89 11.367L6.745 9.9H13.8225C14.535 9.9 15.162 9.522 15.485 8.973L18.886 3.15C18.9525 3.006 19 2.853 19 2.7C19 2.4613 18.8999 2.23239 18.7218 2.0636C18.5436 1.89482 18.302 1.8 18.05 1.8H3.9995L3.1065 0M5.7 14.4C4.6455 14.4 3.8 15.201 3.8 16.2C3.8 16.6774 4.00018 17.1352 4.3565 17.4728C4.71282 17.8104 5.19609 18 5.7 18C6.20391 18 6.68718 17.8104 7.0435 17.4728C7.39982 17.1352 7.6 16.6774 7.6 16.2C7.6 15.7226 7.39982 15.2648 7.0435 14.9272C6.68718 14.5896 6.20391 14.4 5.7 14.4Z"
                                                    fill="white" />
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-3">
                                    <div class="flex flex-col items-center justify-center">
                                        <p
                                            class="block font-sans font-bold text-base leading-5 text-white antialiased text-center">
                                            Camisa a rayas adidas roja
                                        </p>
                                        <p
                                            class="block font-sans text-sm font-light leading-relaxed text-white antialiased text-center">
                                            Ver detalle →
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div
                                class="relative flex w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                                <div
                                    class="relative mx-3 mt-3 h-32 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                                    <img src="https://images.unsplash.com/photo-1629367494173-c78a56567877?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=927&amp;q=80"
                                        class="h-full w-full object-cover" />
                                </div>
                                <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-6">
                                    <div class=" flex items-center justify-between">
                                        <p
                                            class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                            Apple AirPods
                                        </p>
                                        <p
                                            class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                            $95.00
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="relative flex w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                                <div
                                    class="relative mx-3 mt-3 h-32 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                                    <img src="https://images.unsplash.com/photo-1629367494173-c78a56567877?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=927&amp;q=80"
                                        class="h-full w-full object-cover" />
                                </div>
                                <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-6">
                                    <div class=" flex items-center justify-between">
                                        <p
                                            class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                            Apple AirPods
                                        </p>
                                        <p
                                            class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                            $95.00
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    </section>

    <section class="mt-6">
        <div class="col-span-3 mx-6">
            <!-- component -->
            <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>

            <article x-data="slider" class="relative w-full flex flex-shrink-0 overflow-hidden shadow-2xl">
                <div class="rounded-full bg-gray-600 text-white absolute top-5 right-5 text-sm px-2 text-center z-10">
                    <span x-text="currentIndex"></span>/
                    <span x-text="images.length"></span>
                </div>

                <template x-for="(image, index) in images">
                    <figure class="h-96" x-show="currentIndex == index + 1"
                        x-transition:enter="transition transform duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition transform duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <img :src="image" alt="Image"
                            class="absolute inset-0  h-full rounded-3xl w-full object-cover opacity-70" />
                        <figcaption class="absolute inset-x-0 bottom-1 z-10 w-96 mx-auto p-4 font-light text-center mb-24">
                            <p class="text-3xl text-white mb-12">
                                <span class="font-extrabold">
                                    Elige tu coleccion
                                </span> <br>
                                y ahorra en <span class="text-blue-600 font-black">Promociones</span>
                            </p>

                            <button class="bg-black rounded-full mb-12 p-2 px-4">
                                <p class="text-white">
                                    Ver Promociones
                                </p>
                            </button>
                        </figcaption>
                    </figure>
                </template>

                <button @click="back()"
                    class="absolute left-14 mt-12 top-1/2 -translate-y-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 bg-black hover:bg-gray-700">
                    <svg class=" w-8 h-8 font-bold transition duration-500 ease-in-out transform motion-reduce:transform-none text-gray-500 hover:text-gray-600 hover:-translate-x-0.5"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>

                <button @click="next()"
                    class="absolute right-14 top-1/2 translate-y-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 bg-black hover:bg-gray-700">
                    <svg class=" w-8 h-8 font-bold transition duration-500 ease-in-out transform motion-reduce:transform-none text-gray-500 hover:text-gray-600 hover:translate-x-0.5"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </button>
            </article>
            <div class="bg-gradient-to-b z-40 h-50 from-transparent to-white via-white -translate-y-1/2">
                <div class="flex justify-center w-full">
                    <div class="grid grid-cols-4 gap-20">
                        <!-- component -->
                        <div class="w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                            <div
                                class="relative mx-3 mt-3 h-32 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                                <img src="https://images.unsplash.com/photo-1629367494173-c78a56567877?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=927&amp;q=80"
                                    class="h-full w-full object-cover" />
                            </div>
                            <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-6">
                                <div class=" flex items-center justify-between">
                                    <p
                                        class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                        Apple AirPods
                                    </p>
                                    <p
                                        class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                        $95.00
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- component -->
                        <div class="w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                            <div
                                class="relative mx-3 mt-3 h-32 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                                <img src="https://images.unsplash.com/photo-1629367494173-c78a56567877?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=927&amp;q=80"
                                    class="h-full w-full object-cover" />
                            </div>
                            <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-6">
                                <div class=" flex items-center justify-between">
                                    <p
                                        class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                        Apple AirPods
                                    </p>
                                    <p
                                        class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                        $95.00
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- component -->
                        <div class="w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                            <div
                                class="relative mx-3 mt-3 h-32 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                                <img src="https://images.unsplash.com/photo-1629367494173-c78a56567877?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=927&amp;q=80"
                                    class="h-full w-full object-cover" />
                            </div>
                            <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-6">
                                <div class=" flex items-center justify-between">
                                    <p
                                        class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                        Apple AirPods
                                    </p>
                                    <p
                                        class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                        $95.00
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- component -->
                        <div class="w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                            <div
                                class="relative mx-3 mt-3 h-32 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                                <img src="https://images.unsplash.com/photo-1629367494173-c78a56567877?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=927&amp;q=80"
                                    class="h-full w-full object-cover" />
                            </div>
                            <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-6">
                                <div class=" flex items-center justify-between">
                                    <p
                                        class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                        Apple AirPods
                                    </p>
                                    <p
                                        class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                        $95.00
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        @livewire('products')
    </section>


    </div>

    </div>

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
