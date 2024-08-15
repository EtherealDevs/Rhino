@extends('layouts.app')
@section('content')
<div class="mt-12 h-screen">
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold text-slate-800">
            Combo
        </h1>
    </div>

    <div class="mt-8 justify-center">
        {{-- Se debera agregar el id id="product-{{ $product->id }}" en el segundo div  --}}
        @foreach ($combo->items as $product)
        <div class="flex justify-center items-center mb-4">
            <div  class="flex w-full max-w-screen-xl transform cursor-pointer flex-col justify-between rounded-md bg-white bg-opacity-75 p-6 text-slate-800 transition duration-500 ease-in-out hover:-translate-y-1 hover:shadow-lg lg:flex-row lg:p-4">

                <div class="flex w-full lg:w-2/12">
                    <div class="relative flex flex-col">
                        <div class="flex h-12 w-12 flex-shrink-0 flex-col justify-center rounded-full bg-slate-200 bg-opacity-50">
                            <img src="" class="z-10 h-12 w-12 rounded-full object-cover shadow hover:shadow-xl" alt="" />
                        </div>
                    </div>
                    <div class="ml-4 self-center overflow-x-hidden">
                        <div class="w-full truncate text-xl font-extrabold leading-5 tracking-tight">
                            {{ $product->name }}
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/12 self-center pt-4 lg:pt-0">
                    <div class="ml-1">
                        <div class="text-sm text-slate-500">
                            <span class="product-attribute" data-attribute="color"> product->color </span>
                            <select class="hidden form-input" name="color">
                                <option value="Rojo">Rojo</option>
                                <option value="Azul">Azul</option>
                                <option value="Verde">Verde</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/12 self-center pt-4 lg:pt-0">
                    <div class="ml-1">
                        <div class="text-sm text-slate-500">
                            <span class="product-attribute" data-attribute="size">product->size</span>
                            <select class="hidden form-input" name="size">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/12 self-center pt-4 lg:pt-0">
                    <div class="ml-1">
                        <div class="text-xl text-black font-extrabold leading-5 tracking-tight">
                            $product->price
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/12 self-center pt-4 lg:pt-0">
                    <div class="text-center">
                        <button class="bg-blue-500 rounded-xl p-2 px-4 edit-button" data-product-id="">
                            <p class="text-white font-bold">
                                Editar
                            </p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="bottom-10 mt-8 max-w-screen-xl mx-auto p-6 rounded-2xl bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg">
        <div class="grid grid-cols-3 gap-4 text-center">
            <div>
                <p class="text-xl font-semibold">Descuento</p>
                <p class="text-2xl font-bold">-$50.00</p>
            </div>
            <div>
                <p class="text-xl font-semibold">Precio</p>
                <p class="text-2xl font-bold">$450.00</p>
            </div>
            <div>
                <p class="text-xl font-semibold">Total</p>
                <p class="text-2xl font-bold">$400.00</p>
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
                    productElement.querySelectorAll('.product-attribute').forEach(function(attributeElement) {
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
