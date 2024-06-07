@extends('layouts.app')

@section('content')
    <script defer src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/glide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/css/glide.core.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/css/glide.theme.min.css">

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-6 rounded-lg shadow-lg bg-white">
                @if ($item->images->count() > 1)
                <x-item-carousel :item="$item" :colors="$colors"></x-item-carousel>
                @elseif ($item->images->count() == 1)   
                    <div class="glide">
                        <div class="glide__track" data-glide-el="track">
                            <ul class="glide__slides">
                                @foreach ($item->images as $image)    
                                    <li class="glide__slide">
                                        <img class="w-full h-64 lg:h-96 object-cover"
                                        src="/storage/{{$image->url}}"
                                            alt="{{$item->id}}-{{$item->product->id}}-{{$item->product->name}}-{{$item->color->name}}">
                                    </li>
                                @endforeach
                            </ul>
                    </div>
                    </div>
                @else
                <div class="glide">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            @foreach ($item->images as $image)    
                                <li class="glide__slide">
                                    <p>No hay Imagen</p>
                                </li>
                            @endforeach
                        </ul>
                </div>
                @endif

                
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-3xl font-bold">{{$item->product->name}}</h2>
                    <span class="text-xl text-yellow-500">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                    </span>
                </div>
                <div class="mb-4">
                    <span class="text-2xl font-semibold text-gray-700">{{$item->price()}}</span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Color:</label>
                    <div class="flex space-x-2">
                        @foreach ($colors as $color)
                        <div class="grid grid-cols-1 grid-rows-2 justify-items-center">
                            <p>{{$color->name}}</p>
                        <button style="background-color: {{$color->color}}" class="w-8 h-8 rounded-full outline-dashed outline-1 transition ease-in-out delay-150 hover:outline-none"></button>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Talle:</label>
                    <div class="flex space-x-2">
                        @foreach ($item->sizes as $size)
                            <button class="w-10 h-10 border rounded-lg focus:outline-none">{{$size->name}}</button>
                        @endforeach
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
                                <img class="w-12 h-12 rounded-full"
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
                                <img class="w-12 h-12 rounded-full"
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
                                <img class="w-12 h-12 rounded-full"
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
                @foreach ($item->category()->items()->with('product')->take(4)->get() as $relatedItem)
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <a href="{{route('products.show', ['id' => $relatedItem->id])}}">
                        <img class="w-full h-48 object-cover rounded-t-lg" 
                            alt="Producto 1">
                        <h4 class="text-lg font-semibold mt-2">{{$relatedItem->product->name}}</h4>
                        <p class="text-gray-700">${{$relatedItem->price()}}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <button onclick="test()">TEST</button>
    {{-- SCRIPTS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            test();
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
