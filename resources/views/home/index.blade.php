@extends('layouts.app')
@section('content')
    <div class="static justify-center bg-white w-full">
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
                            @livewire('product-card')
                            @livewire('product-card')
                            @livewire('product-card')
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
                    <svg class=" w-8 h-8 font-bold transition duration-500 ease-in-out transform motion-reduce:transform-none text-white hover:text-gray-600 hover:-translate-x-0.5"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>

                <button @click="next()"
                    class="absolute right-14 top-1/2 translate-y-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 bg-black hover:bg-gray-700">
                    <svg class=" w-8 h-8 font-bold transition duration-500 ease-in-out transform motion-reduce:transform-none text-white hover:text-gray-600 hover:translate-x-0.5"
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
                        @livewire('product-card')
                        @livewire('product-card')
                        @livewire('product-card')
                        @livewire('product-card')
                    </div>
                </div>
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
