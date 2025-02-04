@extends('layouts.app')

@section('content')
    <script defer src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/glide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/css/glide.core.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/css/glide.theme.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="container mx-auto p-0 lg:pt-20 lg:p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0 lg:gap-4">
            <div class="p-6 rounded-lg shadow-lg bg-white">
                @if ($item->images->count() > 1)
                    <x-item-carousel :item="$item" :colors="$colors"></x-item-carousel>
                @elseif ($item->images->count() == 1)
                    <div class="glide">
                        <div class="glide__track" data-glide-el="track">
                            <ul class="glide__slides">
                                @foreach ($item->images as $image)
                                    <li class="glide__slide">
                                        <img class="w-full h-64 object-cover" src="{{ url(Storage::url($image->url)) }}"
                                            alt="{{ $item->id }}-{{ $item->product->id }}-{{ $item->product->name }}-{{ $item->color->name }}">
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
                <div class="block lg:flex justify-between items-center mb-4">
                    <h2 class="text-3xl font-josefin font-bold">{{ $item->product->name }}</h2>
                    <span class="text-xl flex h-6 text-yellow-500">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($averageRating))
                                <!-- Estrella completa -->
                                <svg class="h-12" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m7.69 18.346l1.614-5.33L5.115 10h5.216L12 4.462L13.67 10h5.215l-4.189 3.016l1.614 5.33L12 15.07z" />
                                </svg>
                            @elseif ($i == floor($averageRating) + 1 && $averageRating - floor($averageRating) >= 0.5)
                                <!-- Estrella media -->
                                <svg class="h-12" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m15.15 16.85l-.825-3.6l2.775-2.4l-3.65-.325l-1.45-3.4v7.8zm-7.825 2.073l1.24-5.313l-4.123-3.571l5.431-.472L12 4.557l2.127 5.01l5.43.472l-4.123 3.57l1.241 5.314L12 16.102z" />
                                </svg>
                            @else
                                <!-- Estrella vacía -->
                                <svg class="h-12" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M9.6 15.65L12 13.8l2.4 1.85l-.9-3.05l2.25-1.6h-2.8L12 7.9l-.95 3.1h-2.8l2.25 1.6zm-1.91 2.696l1.614-5.33L5.115 10h5.216L12 4.462L13.67 10h5.215l-4.189 3.016l1.614 5.33L12 15.07zM12 11.775" />
                                </svg>
                            @endif
                        @endfor
                    </span>
                </div>

                <div class="mb-4">
                    @if ($item->product != null)
                        @if ($item->product->sale != null)
                            <span
                                class="text-2xl font-semibold font-josefin text-gray-700">${{ number_format($item->price() / 100, 2, ',', '.') }}</span>
                            <span
                                class="text-lg line-through font-bold text-gray-500">${{ number_format($item->original_price / 100, 2, ',', '.') }}</span>
                        @else
                            <span
                                class="text-2xl font-semibold font-josefin text-gray-700">${{ number_format($item->price() / 100, 2, ',', '.') }}</span>
                        @endif
                    @endif
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold font-josefin mb-4 text-lg">Seleccione un color:</label>
                    <div class="flex flex-wrap gap-6 mt-6">

                        {{-- Color seleccionado actual --}}
                        <div
                            class="flex flex-col items-center p-3 border border-blue-600 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-200">
                            <p class="text-blue-800 text-xs font-bold font-josefin mb-2">{{ $item->color->name }}</p>
                            <button style="background-color: {{ $item->color->color }}"
                                class="w-12 h-12 rounded-full cursor-pointer outline outline-2 outline-gray-300
                                       transition-all duration-200 ease-in-out
                                       shadow-md hover:scale-105 transform"></button>
                        </div>

                        {{-- Variaciones de color --}}
                        @foreach ($productVariations as $variation)
                            <a href="{{ route('products.show', ['product' => $variation->product, 'productItem' => $variation]) }}"
                                class="transform transition-transform duration-200 hover:scale-105">
                                <div
                                    class="flex flex-col items-center p-3 border border-gray-300 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-200">
                                    <p class="text-gray-700 text-xs font-semibold font-josefin mb-2">
                                        {{ $variation->color->name }}</p>
                                    <button style="background-color: {{ $variation->color->color }}"
                                        class="w-12 h-12 rounded-full cursor-pointer outline outline-2 outline-gray-300
                                               transition-all duration-200 ease-in-out
                                               hover:outline-gray-400 shadow-md"></button>
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

                    <select x-data id="size-selector" onchange="sizeOptionChanged()"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400
                                focus:border-blue-500 transition duration-200 ease-in-out bg-white text-gray-700">

                        <option value="" selected
                            x-on:changed-size-option-0.window="$dispatch('change-livewire-component', { stock: null })"
                            class="text-gray-500">Seleccionar...</option>

                        @php
                            $sizes = $item->sizes()->orderBy('sort_number')->get();
                        @endphp

                        @foreach ($itemVariations as $itemVariation)
                            <option
                                x-on:changed-size-option-{{ $loop->index + 1 }}.window="$dispatch('change-livewire-component', { stock: {{ $itemVariation->stock }} })"
                                data-stock="{{ $itemVariation->stock }}" value="{{ $itemVariation->size->name }}"
                                class="px-3 py-2 text-gray-700 hover:bg-blue-100
                                        transition duration-150 ease-in-out
                                        @if ($itemVariation->stock < 1) text-red-500 @endif">
                                {{ $itemVariation->size->name }} -
                                @if ($itemVariation->stock < 1)
                                    No Hay Stock
                                @else
                                    Disponibles: {{ $itemVariation->stock }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold font-josefin mb-2">Cantidad:</label>
                    <div class="flex items-center space-x-2">
                        @livewire('counter')
                    </div>
                </div>


                <form id="sendProductToCart" onsubmit="populateProductSubmitForm(event, {{ $sizes }})"
                    method="POST" action="{{ route('cart.addItem') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 font-josefin rounded-lg hover:bg-blue-500">Agregar al
                        carrito</button>
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
                            class="py-2 px-4 text-[14px] xl:text-lg font-medium font-josefin border-b-2">Tamaños y
                            Medidas</button>
                        <button @click="activeTab = 'reviews'"
                            :class="{ 'border-blue-500 text-blue-500': activeTab === 'reviews' }"
                            class="py-2 px-4 text-[14px] xl:text-lg font-medium font-josefin border-b-2">Reseñas y
                            Calificaciones</button>
                    </div>

                    <div x-show="activeTab === 'description'">
                        <h3 class="text-2xl font-bold font-josefin mb-4">Descripción</h3>
                        <p class="text-gray-700">{{ $item->product->description }}</p>
                    </div>
                    <div x-show="activeTab === 'size'">
                        <h3 class="text-2xl font-bold font-josefin mb-4">Tamaños y Medidas</h3>
                        @foreach ($item->images as $image)
                            @if (!$image->is_active)
                                <div class="glide__slide">
                                    <img class="w-full h-64 lg:h-[240px] object-cover"
                                        src="{{ url(Storage::url($image->url)) }}" alt="">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div x-show="activeTab === 'reviews'">
                        <h3 class="text-2xl font-bold font-josefin mb-4">Reseñas y Calificaciones</h3>
                        <div class="flex justify-center items-center h-full">
                            <div class="w-full mx-auto">
                                <div>
                                    @if ($canReview)
                                        <!-- Mostrar el componente de reseñas -->
                                        @livewire('rating-stars', ['product' => $product])
                                    @else
                                        <!-- Mostrar mensaje si no puede reseñar -->
                                        <p class="text-gray-600">
                                            Para dejar una reseña, debes haber comprado este producto.
                                        </p>
                                    @endif
                                </div>

                                @foreach ($reviews as $review)
                                    <div
                                        class="relative mb-6  bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                                        <div class="flex items-start gap-4 p-6">
                                            <img class="h-10 rounded-full"
                                                src="{{ $review->user->avatar ?: $review->user->profile_photo_url }}"
                                                alt="Avatar">
                                            <div class="flex flex-col w-full">
                                                <div class="flex items-center justify-between">
                                                    <h5 class="text-lg font-semibold text-blue-gray-900">
                                                        {{ $review->user->name }}
                                                    </h5>
                                                    <div class="flex items-center">
                                                        @for ($i = 0; $i < $review->rating; $i++)
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                fill="currentColor" class="w-5 h-5 text-yellow-500">
                                                                <path fill-rule="evenodd"
                                                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="justify-end">
                                                    <p class="text-xs text-gray-600">
                                                        {{ $review->created_at->timezone('America/Argentina/Buenos_Aires')->format('d/m/Y H:i:s') }}

                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-4 mb-4 bg-gray-50 rounded-b-lg">
                                            <p class="text-base text-gray-800 italic">
                                                "{{ $review->content }}"
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-10 bg-white rounded-lg shadow-lg p-8">
            <h3 class="text-3xl font-bold font-josefin text-gray-800 mb-6 border-b-2 border-gray-200 pb-2">
                Productos Recomendados
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($relatedProducts as $relatedProduct)
                    @php
                        $relatedItem = $relatedProduct->items->first();
                    @endphp
                    @if ($relatedItem)
                        <div
                            class="bg-white rounded-lg overflow-hidden shadow-md transform transition-transform duration-300 hover:scale-105">
                            <a
                                href="{{ route('products.show', ['product' => $relatedProduct->id, 'productItem' => $relatedItem->id]) }}">
                                <div class="relative">
                                    <img class="w-full h-48 object-cover"
                                        src="{{ $relatedItem->images->first()?->url ? url(Storage::url($relatedItem->images->first()?->url)) : asset('images/default.png') }}"
                                        alt="{{ $relatedProduct->name }}">
                                    <div
                                        class="absolute top-0 left-0 bg-green-500 bg-opacity-50 text-white text-sm px-3 py-1 rounded-br-lg font-bold">
                                        Nuevo
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-semibold uppercase truncate text-gray-800 mb-2">
                                        {{ $relatedProduct->name }}</h4>
                                    <p class="text-gray-500 truncate text-sm">{{ $relatedProduct->description }}</p>
                                    {{-- Precio desactivado --}}
                                </div>
                                <div
                                    class="bg-gray-100 items-center justify-center flex px-4 py-2 text-center font-semibold text-sm text-gray-800">
                                    <p class="">
                                        Ver más detalles
                                    </p>
                                    <svg class="h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="1em"
                                        height="1em" viewBox="0 0 16 16">
                                        <path fill="currentColor"
                                            d="M8.22 2.97a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.042-.018a.75.75 0 0 1-.018-1.042l2.97-2.97H3.75a.75.75 0 0 1 0-1.5h7.44L8.22 4.03a.75.75 0 0 1 0-1.06" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>


    </div>

    <script src="{{ asset('js/products/show.js') }}"></script>
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
