@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/glide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/css/glide.core.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/css/glide.theme.min.css">

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-6 rounded-lg shadow-lg bg-white">
                <!-- Carousel -->
                <div class="glide" x-data="{ currentSlide: 0 }">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <li class="glide__slide">
                                <img class="w-full h-64 lg:h-96 object-cover"
                                    src="https://cdn.discordapp.com/attachments/880510966473826329/1244742689178517544/PHOTO-2024-05-27-10-13-30.jpg"
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
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
                        src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg"
                        alt="Miniatura 2">
                    <img class="w-24 h-24 object-cover cursor-pointer" @click="currentSlide = 2"
                        src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg"
                        alt="Miniatura 3">
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-3xl font-bold">Zapatilla Nike Smash</h2>
                    <span class="text-xl text-yellow-500">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                    </span>
                </div>
                <div class="mb-4">
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

                <!-- Tabs Section -->
                <div x-data="{ activeTab: 'description' }" class="mt-6">
                    <div class="flex space-x-4 border-b-2 mb-4">
                        <button @click="activeTab = 'description'"
                            :class="{ 'border-blue-500 text-blue-500': activeTab === 'description' }"
                            class="py-2 px-4 border-b-2">Descripción</button>
                        <button @click="activeTab = 'size'"
                            :class="{ 'border-blue-500 text-blue-500': activeTab === 'size' }"
                            class="py-2 px-4 border-b-2">Tamaños y Medidas</button>
                        <button @click="activeTab = 'reviews'"
                            :class="{ 'border-blue-500 text-blue-500': activeTab === 'reviews' }"
                            class="py-2 px-4 border-b-2">Reseñas y Calificaciones</button>
                    </div>
                    <div x-show="activeTab === 'description'">
                        <h3 class="text-2xl font-bold mb-4">Descripción</h3>
                        <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                            tempor
                            incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div x-show="activeTab === 'size'">
                        <h3 class="text-2xl font-bold mb-4">Tamaños y Medidas</h3>
                        <p class="text-gray-700">Aquí puedes incluir las tallas y medidas detalladas del producto.</p>
                    </div>
                    <div x-show="activeTab === 'reviews'">
                        <h3 class="text-2xl font-bold mb-4">Reseñas y Calificaciones</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <img class="w-12 h-12 rounded-full" src="https://via.placeholder.com/150"
                                    alt="Usuario 1">
                                <div>
                                    <h4 class="text-lg font-semibold">John Doe</h4>
                                    <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                                        do
                                        eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <div class="flex items-center mt-2">
                                        <div class="flex space-x-1 text-yellow-500">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-half-fill"></i>
                                        </div>
                                        <span class="ml-2 text-gray-600">27</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <img class="w-12 h-12 rounded-full" src="https://via.placeholder.com/150"
                                    alt="Usuario 2">
                                <div>
                                    <h4 class="text-lg font-semibold">Andrew Smith</h4>
                                    <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                                        do
                                        eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <div class="flex items-center mt-2">
                                        <div class="flex space-x-1 text-yellow-500">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-half-fill"></i>
                                        </div>
                                        <span class="ml-2 text-gray-600">51</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <img class="w-12 h-12 rounded-full" src="https://via.placeholder.com/150"
                                    alt="Usuario 3">
                                <div>
                                    <h4 class="text-lg font-semibold">Jessica Adams</h4>
                                    <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                                        do
                                        eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <div class="flex items-center mt-2">
                                        <div class="flex space-x-1 text-yellow-500">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-half-fill"></i>
                                        </div>
                                        <span class="ml-2 text-gray-600">34</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommended Products Section -->
        <div class="mt-6 bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-2xl font-bold mb-4">Productos Recomendados</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <img class="w-full h-48 object-cover rounded-t-lg" src="https://via.placeholder.com/200"
                        alt="Producto 1">
                    <h4 class="text-lg font-semibold mt-2">Producto 1</h4>
                    <p class="text-gray-700">$100.000,00</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <img class="w-full h-48 object-cover rounded-t-lg" src="https://via.placeholder.com/200"
                        alt="Producto 2">
                    <h4 class="text-lg font-semibold mt-2">Producto 2</h4>
                    <p class="text-gray-700">$200.000,00</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <img class="w-full h-48 object-cover rounded-t-lg" src="https://via.placeholder.com/200"
                        alt="Producto 3">
                    <h4 class="text-lg font-semibold mt-2">Producto 3</h4>
                    <p class="text-gray-700">$150.000,00</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <img class="w-full h-48 object-cover rounded-t-lg" src="https://via.placeholder.com/200"
                        alt="Producto 4">
                    <h4 class="text-lg font-semibold mt-2">Producto 4</h4>
                    <p class="text-gray-700">$180.000,00</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Glide('.glide', {
                type: 'carousel',
                perView: 1,
                autoplay: 3000,
                hoverpause: true,
                animationDuration: 800,
            }).mount();
        });
    </script>
@endsection
