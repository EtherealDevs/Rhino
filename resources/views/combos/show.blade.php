@extends('layouts.app')
@section('content')
    <div class="lg:my-12 h-full">
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-2xl mt-6 md:text-3xl font-bold text-slate-800">
                Productos del Combo
            </h1>
        </div>
        @php
            $total = 0;
        @endphp
        <div class="mt-8 max-w-screen-xl mx-auto grid grid-cols-2 gap-2 lg:grid-cols-4 justify-center ">
            {{-- Se debera agregar el id id="product-{{ $product->id }}" en el segundo div  --}}
            @foreach ($combo->items as $item)
                @php
                    $product = $item->product;
                    $total += $product->items->first()->price();
                @endphp
                <div class="relative z-10 flex justify-center w-44 lg:w-56 mt-1 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md transition-transform duration-300 hover:scale-105">
                    <div class="relative mx-3 mt-3 h-42 overflow-hidden rounded-2xl bg-white bg-clip-border text-gray-700">
                        <img src="{{ url(Storage::url('images/product/')) }}"
            class="product-image h-full w-full object-cover" />
                    </div>
                    <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-3">
                        <a href="{{ route('products.show', ['product' => $product, 'productItem' => $item]) }}">
                            <div class="flex flex-col items-center justify-center">
                                <p class="block font-sans font-bold text-base leading-5 text-white antialiased text-center">
                                    {{ $product->name }}
                                </p>
                                <div class="text-sm text-slate-500">
                                    <span class="product-attribute" data-attribute="color">
                                        {{ $product->items->first()->color->name }} </span>
                                    <select class="hidden form-input" name="color">
                                        <option value="Rojo">Rojo</option>
                                        <option value="Azul">Azul</option>
                                        <option value="Verde">Verde</option>
                                    </select>
                                </div>
                                <div class="text-sm text-slate-500">
                                    <span class="product-attribute" data-attribute="size">
                                        {{ $product->items->first()->sizes->first()->name }} </span>
                                    <select class="hidden form-input" name="size">
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                    </select>
                                </div>
                                <p
                                    class="block font-sans text-sm font-light leading-relaxed text-white antialiased text-center">
                                    Ver detalle →
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div
            class="mt-8 max-w-screen-xl mx-auto p-6 rounded-none lg:rounded-3xl w-full bg-gradient-to-b via-[#2E3366] lg:-translate-x-2 lg:-translate-y-2 from-[#343678] to-[#273053] text-white shadow-lg">
            <div class="grid grid-cols-1 xl:grid-cols-4 gap-4 text-center">
                @php
                    $discount = ($combo->discount / 100) * $total;
                    $totalDiscount = $total - $discount;
                @endphp
                <div class="col-span-1 md:col-span-1">
                    <p class="text-xl font-semibold">Descuento</p>
                    <p class="text-2xl font-bold">-${{ number_format($discount, 2, '.', ',') }}</p>
                </div>
                <div class="col-span-1 md:col-span-1">
                    <p class="text-xl font-semibold">Precio sin descuento</p>
                    <p class="text-2xl line-through  font-bold text-gray-500">${{ number_format($total, 2, '.', ',') }}</p>
                </div>
                <div class="col-span-1 md:col-span-1">
                    <p class="text-xl font-semibold">Total</p>
                    <p class="text-2xl text-green-400 font-bold">${{ number_format($totalDiscount, 2, '.', ',') }}</p>
                </div>
                <div class="col-span-1 m-2">
                    <button class="w-full sm:w-auto bg-[#2957de] rounded-lg">
                        <a href="{{ route('checkout.delivery') }}" class="col-span-3 bg-[#11C818] rounded-lg">
                            <p class="text-white text-lg font-bold font-josefin py-2 px-5">Agregar al Carrito</p>
                        </a>
                    </button>

                    <button class="w-full sm:w-auto bg-black rounded-lg">
                        <a href="/products" class="col-span-3 bg-[#11C818] rounded-lg">
                            <p class="text-white text-lg font-bold font-josefin py-2 px-5">Volver</p>
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    let productId = this.getAttribute('data-product-id');
                    let productElement = document.getElementById('product-' + productId);
                    let isEditing = productElement.classList.contains('editing');

                    if (isEditing) {
                        // Save logic
                        productElement.querySelectorAll('.form-input').forEach(function(input) {
                            input.classList.add('hidden');
                            input.classList.remove('form-input-visible');
                            let attributeElement = input.previousElementSibling;
                            attributeElement.textContent = input.value;
                            attributeElement.classList.remove('hidden');
                        });

                        this.textContent = 'Editar';
                        this.classList.remove('bg-green-500');
                        this.classList.add('bg-blue-500');
                        productElement.classList.remove('editing');
                    } else {
                        // Edit logic
                        productElement.querySelectorAll('.product-attribute').forEach(function(
                            attributeElement) {
                            attributeElement.classList.add('hidden');
                            let input = attributeElement.nextElementSibling;
                            input.classList.remove('hidden');
                            input.classList.add('form-input-visible');
                        });

                        this.textContent = 'Guardar';
                        this.classList.remove('bg-blue-500');
                        this.classList.add('bg-green-500');
                        productElement.classList.add('editing');
                    }
                });
            });

            document.querySelectorAll('.form-input').forEach(function(input) {
                input.addEventListener('blur', function() {
                    let attributeElement = this.previousElementSibling;
                    attributeElement.textContent = this.value;
                    this.classList.add('hidden');
                    this.classList.remove('form-input-visible');
                    attributeElement.classList.remove('hidden');
                });
            });
        });
    </script>

    <style>
        .form-input-visible {
            display: block !important;
            transition: all 0.3s ease-in-out;
        }

        .product-attribute.hidden {
            display: none;
        }
    </style>
@endsection
