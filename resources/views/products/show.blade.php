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
                                        src="{{ url(Storage::url('images/product/' . $image->url)) }}"
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
                </div>
                @endif
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-3xl font-josefin font-bold">{{$item->product->name}}</h2>
                    <span class="text-xl text-yellow-500">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($averageRating))
                                <i class="ri-star-fill"></i>
                            @elseif ($i == ceil($averageRating))
                                <i class="ri-star-half-fill"></i>
                            @else
                                <i class="ri-star-line"></i> <!-- Estrella vacía -->
                            @endif
                        @endfor
                    </span>
                </div>

                <div class="mb-4">
                    @if ($item->product != null)
                        @if ($item->product->sale != null)
                            <span class="text-2xl font-semibold font-josefin text-gray-700">${{number_format($item->price() / 100, 2, ',', '.')}}</span>
                            <span class="text-lg line-through font-bold text-gray-500">${{number_format($item->original_price / 100, 2, ',', '.')}}</span>
                        @else
                            <span class="text-2xl font-semibold font-josefin text-gray-700">${{number_format($item->price() / 100, 2, ',', '.')}}</span>
                        @endif
                    @endif
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold font-josefin mb-2">Color:</label>
                    <div class="flex space-x-2">
                        <div class="grid grid-cols-1 grid-rows-2 justify-items-center">
                            <p class="text-blue-800 font-bold font-josefin">{{$item->color->name}}</p>
                            <button style="background-color: {{$item->color->color}}" class="w-8 h-8 rounded-full outline-dashed outline-1 transition ease-in-out delay-150 hover:outline-none"></button>
                        </div>
                        @foreach ($item->product->items->where('id', '!=', $item->id) as $variation)
                            <a href="{{route('products.show', ['product' => $variation->product, 'productItem' => $variation])}}">
                                <div class="grid grid-cols-1 grid-rows-2 justify-items-center">
                                    <p>{{$variation->color->name}}</p>
                                    <button style="background-color: {{$variation->color->color}}" class="w-8 h-8 rounded-full outline-dashed outline-1 transition ease-in-out delay-150 hover:outline-none"></button>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <script>
                    function getCounterValue(id) {
                        var value = document.getElementById(id).value;
                        console.log(value);
                        return value;
                    }
                </script>

                <div class="mb-4" id="size-container">
                    <label class="block text-gray-700 font-semibold font-josefin mb-2">Talle:</label>
                    <select x-data id="size-selector" onchange="sizeOptionChanged()">
                        <option value="" selected x-on:changed-size-option-0.window="$dispatch('change-livewire-component', { stock: null })">Seleccionar...</option>
                        @php
                            $sizes = $item->sizes()->orderBy('sort_number')->get();
                        @endphp
                        @foreach ($sizes as $size)
                            <option x-on:changed-size-option-{{$loop->index + 1}}.window="$dispatch('change-livewire-component', { stock: {{$size->pivot->stock}} })" data-stock="{{$size->pivot->stock}}" value="{{$size->name}}" class="w-10 h-10 border rounded-lg focus:outline-none">{{$size->name}} -  @if ($size->pivot->stock < 1)
                                No Hay Stock
                                @else
                                disponibles :{{$size->pivot->stock}}
                            @endif </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold font-josefin mb-2">Cantidad:</label>
                    <div class="flex items-center space-x-2">
                        @livewire('counter')
                    </div>
                </div>


                <form id="sendProductToCart" onsubmit="populateProductSubmitForm(event, {{$sizes}})" method="POST" action="{{route('cart.addItem')}}">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 font-josefin rounded-lg hover:bg-blue-500">Agregar al carrito</button>
                    <input name="item" id="productIdInput" type="hidden" value="{{ $item->id }}">
                    <input name="quantity" id="counterInput" type="hidden">
                    <input name="size" id="sizeInput" type="hidden">
                </form>

                <!-- Tabs Section -->
                <div x-data="{ activeTab: 'description' }" class="mt-6">
                    <div class="flex space-x-4 border-b-2 mb-4">
                        <button @click="activeTab = 'description'"
                            :class="{ 'border-blue-500 text-blue-500': activeTab === 'description' }"
                            class="py-2 px-4 text-[14px] xl:text-lg font-medium font-josefin border-b-2">Descripción</button>
                        <button @click="activeTab = 'size'"
                            :class="{ 'border-blue-500 text-blue-500': activeTab === 'size' }"
                            class="py-2 px-4 text-[14px] xl:text-lg font-medium font-josefin border-b-2">Tamaños y Medidas</button>
                        <button @click="activeTab = 'reviews'"
                            :class="{ 'border-blue-500 text-blue-500': activeTab === 'reviews' }"
                            class="py-2 px-4 text-[14px] xl:text-lg font-medium font-josefin border-b-2">Reseñas y Calificaciones</button>
                    </div>
                    <div x-show="activeTab === 'description'">
                        <h3 class="text-2xl font-bold font-josefin mb-4">Descripción</h3>
                        <p class="text-gray-700">{{$item->product->description}}</p>
                    </div>
                    <div x-show="activeTab === 'size'">
                        <h3 class="text-2xl font-bold font-josefin mb-4">Tamaños y Medidas</h3>
                        <!-- component -->
                        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

                        <main class="grid w-full place-content-center bg-white">
                            <div x-data="imageSlider" class="relative mx-auto max-w-2xl overflow-hidden rounded-md bg-gray-100 p-2 sm:p-4">
                                <div class="absolute right-5 top-5 z-10 rounded-full bg-gray-600 px-2 text-center text-sm text-white">
                                    <span x-text="currentIndex"></span>/<span x-text="images.length"></span>
                                </div>

                                <button @click="previous()" class="absolute left-5 top-1/2 z-10 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-gray-100 shadow-md">
                                    <i class="fas fa-chevron-left text-2xl font-bold text-gray-500"></i>
                                </button>
                                <button @click="next()" class="absolute right-5 top-1/2 z-10 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-gray-100 shadow-md">
                                    <i class="fas fa-chevron-right text-2xl font-bold text-gray-500"></i>
                                </button>

                                <div class="flex h-full overflow-hidden">
                                    <template x-for="(image, index) in images" :key="index">
                                        <img :src="image" class="h-full w-full object-cover" x-show="currentIndex === index" />
                                    </template>
                                </div>
                            </div>
                        </main>
                    </div>
                    <div x-show="activeTab === 'reviews'">
                        <h3 class="text-2xl font-bold font-josefin mb-4">Reseñas y Calificaciones</h3>
<div class="flex justify-center items-center h-full">
    <div class="max-w-[720px] mx-auto">
        @foreach($reviews as $review)
        <div class="relative mb-6 flex items-start gap-4 p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <img
                src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1480&q=80"
                alt="{{ $review->user->name }}"
                class="h-16 w-16 rounded-full object-cover border-2 border-gray-300" />
            <div class="flex flex-col w-full">
                <div class="flex items-center justify-between">
                    <h5 class="text-lg font-semibold text-blue-gray-900">
                        {{ $review->user->name }}
                    </h5>
                    <div class="flex items-center">
                        @for($i = 0; $i < $review->rating; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-yellow-700">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        @endfor
                    </div>
                </div>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $review->product->name }} <!-- Asegúrate de que tengas la relación definida -->
                </p>
            </div>
        </div>
        <div class="p-4 mb-4 bg-gray-50 rounded-lg">
            <p class="text-base text-gray-800 italic">
                "{{ $review->content }}"
            </p>
        </div>
    @endforeach


</div>
                    </div>
                </div>
            </div>
        </div>


    </div>
     <!-- Recommended Products Section -->
     <div class="mt-6 bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-2xl font-bold font-josefin mb-4">Productos Recomendados</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($item->category()->products()->where('id', '!=', $item->product_id)->with('items')->take(4)->get() as $relatedProduct)
                @php
                    $relatedItem = $relatedProduct->items()->first();
                @endphp
            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                <a href="{{route('products.show', ['product' => $relatedProduct,'productItem' => $relatedItem])}}">
                    <img class="w-full h-48 object-cover rounded-t-lg" src="/storage/images/product/{{$relatedItem->images->first()->url}}"
                        alt="Producto 1">
                    <h4 class="text-lg font-semibold mt-2">{{$relatedProduct->name}}</h4>
                    <p class="text-gray-700">${{number_format($relatedItem->price() / 100, 2, ',', ',')}}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <script src="{{asset('js/products/show.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new Glide('.glide', {
                type: 'carousel',
                startAt: 0,
                perView: 1,
                focusAt: 'center',
                breakpoints: {
                    1200: {
                        perView: 1
                    },
                    800: {
                        perView: 1
                    }
                }
            }).mount();
        });
/*
        function sizeOptionChanged() {
            let selectedOption = document.querySelector('#size-selector option:checked');
            let stock = selectedOption ? selectedOption.getAttribute('data-stock') : null;
            let messageElement = document.getElementById('no-stock-message');
            let formElement = document.getElementById('sendProductToCart');
            let counterInput = document.getElementById('counterInput');

            if (stock === '0') {
                messageElement.classList.remove('hidden');
                formElement.classList.add('hidden');
            } else {
                messageElement.classList.add('hidden');
                formElement.classList.remove('hidden');
            }
        } */

        /* function populateProductSubmitForm(event, sizes) {
            event.preventDefault();
            let sizeInput = document.getElementById('sizeInput');
            let counterInput = document.getElementById('counterInput');
            let sizeSelector = document.getElementById('size-selector');

            sizeInput.value = sizeSelector.value;
            counterInput.value = document.getElementById('counterInput').value;

            document.getElementById('sendProductToCart').submit();
        } */
    </script>
@endsection
