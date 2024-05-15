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
                        <div class="place-self-end p-12">
                            <button class="p-2 px-2 bg-white rounded-xl">
                                Ver Promociones
                            </button>
                            <button class="p-2 px-2 bg-white rounded-xl">
                                Iniciar Sesion
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
                        <button class="mr-6 rounded-full bg-black p-2 px-2">
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
                            <button class="rounded-full px-4 p-2 mt-6 bg-black ">
                                <p class="">
                                    Ver Nuevos Ingresos
                                </p>
                            </button>
                        </div>
                    </div>

                    <div class="w-full flex justify-center">
                        <!-- component -->
                        <div
                            class="relative flex w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                            <div
                                class="relative mx-3 mt-3 h-32 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                                <img src="https://images.unsplash.com/photo-1629367494173-c78a56567877?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=927&amp;q=80"
                                    class="h-full w-full object-cover" />
                            </div>
                            <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-6">
                                <div class=" flex items-center justify-between">
                                    <p class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                        Apple AirPods
                                    </p>
                                    <p class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                        $95.00
                                    </p>
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
                            <figcaption class="absolute inset-x-0 bottom-1 z-20 w-96 mx-auto p-4 font-light text-center mb-24">
                                <p class="text-2xl mb-12">
                                    <span class="font-extrabold">
                                        Elige tu coleccion
                                    </span> <br>
                                    y ahorra en Promociones
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
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
                                        <p class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                            Apple AirPods
                                        </p>
                                        <p class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
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
                                        <p class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
                                            Apple AirPods
                                        </p>
                                        <p class="block font-sans text-base font-medium leading-relaxed text-white antialiased">
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
