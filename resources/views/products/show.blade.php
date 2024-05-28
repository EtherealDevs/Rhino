@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/glide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/css/glide.core.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/css/glide.theme.min.css">

    <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="p-6 rounded-lg shadow-lg">
            <!-- Carousel -->
            <div class="glide" x-data="{ currentSlide: 0 }">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <li class="glide__slide">
                            <img class="w-full h-64 lg:h-96 object-cover"
                                src="https://cdn.discordapp.com/attachments/880510966473826329/1244742689178517544/PHOTO-2024-05-27-10-13-30.jpg?ex=66563877&is=6654e6f7&hm=8f01b61899121c52cb7dd13597902188e9b62c43c95550fefdbcfb08cb6469a8&"
                                alt="Producto principal">
                        </li>
                        <li class="glide__slide">
                            <img class="w-full h-64 lg:h-96 object-cover"
                                src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg"
                                alt="Producto secundario">
                        </li>
                        <li class="glide__slide">
                            <img class="w-full h-64 lg:h-96 object-cover"
                                src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg"
                                alt="Producto secundario">
                        </li>
                    </ul>
                </div>
                <div class="glide__bullets" data-glide-el="controls[nav]">
                    <button class="glide__bullet" data-glide-dir="=0"></button>
                    <button class="glide__bullet" data-glide-dir="=1"></button>
                    <button class="glide__bullet" data-glide-dir="=2"></button>
                </div>
                <div class="glide__arrows" data-glide-el="controls">
                    <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                        <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>
                    <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
                        <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Thumbnails -->
            <div class="flex mt-4">
                <img class="w-24 h-24 object-cover mr-2 cursor-pointer" @click="currentSlide = 0"
                    src="https://cdn.discordapp.com/attachments/880510966473826329/1244742689178517544/PHOTO-2024-05-27-10-13-30.jpg"
                    alt="Miniatura 1">
                <img class="w-24 h-24 object-cover mr-2 cursor-pointer" @click="currentSlide = 1"
                    src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg" alt="Miniatura 2">
                <img class="w-24 h-24 object-cover cursor-pointer" @click="currentSlide = 2"
                    src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg" alt="Miniatura 3">
            </div>

            <!-- Reviews Section -->
            <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold mb-4">Reseñas y Calificaciones</h3>
                <div class="space-y-4">
                    <div class="flex items-start space-x-4">
                        <img class="w-12 h-12 rounded-full" src="https://via.placeholder.com/150" alt="Usuario 1">
                        <div>
                            <h4 class="text-lg font-semibold">Nina Holloway</h4>
                            <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="flex items-center mt-2">
                                <div class="flex space-x-1 text-yellow-500">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-half-fill"></i>
                                </div>
                                <span class="ml-2 text-gray-600">71</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <img class="w-12 h-12 rounded-full" src="https://via.placeholder.com/150" alt="Usuario 2">
                        <div>
                            <h4 class="text-lg font-semibold">Nina Holloway</h4>
                            <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="flex items-center mt-2">
                                <div class="flex space-x-1 text-yellow-500">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-half-fill"></i>
                                </div>
                                <span class="ml-2 text-gray-600">71</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <img class="w-12 h-12 rounded-full" src="https://via.placeholder.com/150" alt="Usuario 3">
                        <div>
                            <h4 class="text-lg font-semibold">Nina Holloway</h4>
                            <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="flex items-center mt-2">
                                <div class="flex space-x-1 text-yellow-500">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-half-fill"></i>
                                </div>
                                <span class="ml-2 text-gray-600">71</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold mb-2">Zapatilla Nike Smash</h2>
            <div class="flex items-center mb-4">
                <span class="text-2xl font-semibold text-gray-700">$250.000,00</span>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Color:</label>
                <div class="flex space-x-2">
                    <button class="w-8 h-8 rounded-full bg-red-600 focus:outline-none"></button>
                    <button class="w-8 h-8 rounded-full bg-blue-600 focus:outline-none"></button>
                    <button class="w-8 h-8 rounded-full bg-green-600 focus:outline-none"></button>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Talle:</label>
                <div class="flex space-x-2">
                    <button class="w-10 h-10 border rounded-lg focus:outline-none">41</button>
                    <button class="w-10 h-10 border rounded-lg focus:outline-none">42</button>
                    <button class="w-10 h-10 border rounded-lg focus:outline-none">43</button>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Cantidad:</label>
                <div class="flex items-center space-x-2">
                    <button class="w-10 h-10 border rounded-lg focus:outline-none">-</button>
                    <span class="text-lg">1</span>
                    <button class="w-10 h-10 border rounded-lg focus:outline-none">+</button>
                </div>
            </div>
            <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-500">Agregar al carrito</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new Glide('.glide').mount();
        });
    </script>
@endsection
