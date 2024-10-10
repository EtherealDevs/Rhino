@extends('layouts.admin')
@section('content')
    <style>
        .-z-1 {
            z-index: -1;
        }

        .origin-0 {
            transform-origin: 0%;
        }

        input:focus~label,
        input:not(:placeholder-shown)~label,
        textarea:focus~label,
        textarea:not(:placeholder-shown)~label,
        select:focus~label,
        select:not([value='']):valid~label {
            /* @apply transform; scale-75; -translate-y-6; */
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            --tw-scale-x: 0.75;
            --tw-scale-y: 0.75;
            --tw-translate-y: -1.5rem;
        }

        input:focus~label,
        select:focus~label {
            /* @apply text-black; left-0; */
            --tw-text-opacity: 1;
            color: rgba(0, 0, 0, var(--tw-text-opacity));
            left: 0px;
        }
    </style>
    <div class="p-6">
        <div class="pt-16  ">
            <div class="p-6 rounded-xl bg-white">
                <h2 class="font-josefin font-bold italic text-xl w-full mx-auto">
                    Editar Promocion #{{ $sale->id }}
                </h2>

                <div class="mt-6">
                    <div class="px-12 mt-12">
                        <div class="mx-auto">
                            <form action={{ route('admin.sales.update', $sale) }} method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="relative z-0 w-full mb-5">
                                    <input type="date" name="start_date" value="{{ old('start_date', $sale->start_date) }}"
                                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                    <label for="start_date" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Fecha de Inicio</label>
                                    @error('start_date')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="relative z-0 w-full mb-5">
                                    <input type="date" name="end_date" value="{{ old('end_date', $sale->end_date) }}"
                                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                    <label for="end_date" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Fecha de Finalización</label>
                                    @error('end_date')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="relative z-0 w-full mb-5">
                                    <input type="text" name="title" value="{{ old('title', $sale->title) }}"
                                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                    <label for="title" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Título</label>
                                    @error('title')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="relative z-0 w-full mb-5">
                                    <textarea name="description" class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">{{ old('description', $sale->description) }}</textarea>
                                    <label for="description" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Descripción</label>
                                    @error('description')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="relative z-1 w-full mb-5">
                                    <select data-placeholder="Seleccionar Productos" multiple class="chosen-select w-full" name="products[]">
                                        @foreach ($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->products as $product)
                                                    <option value="{{ $product->id }}"
                                                        {{ in_array($product->id, $sale->products->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @error('products')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="relative z-0 w-full mb-5">
                                    <input type="number" name="discount" value="{{ old('discount', $sale->discount) }}"
                                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                    <label for="discount" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Descuento</label>
                                    @error('discount')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-8">
                                    <label for="file" class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                        <div>
                                            <span class="mb-2 block text-xl font-semibold text-[#07074D]">Puedes Arrastrar archivos aquí</span>
                                            <span class="mb-2 block text-base font-medium text-[#6B7280]">o</span>
                                            <span class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                                <input type="file" name="image" accept="image/*" id="image" />
                                            </span>
                                        </div>
                                    </label>
                                </div>

                                <button id="button" type="submit"
                                    class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-blue-600 hover:bg-blue-700 hover:shadow-lg focus:outline-none">
                                    Guardar
                                </button>
                            </form>
                        </div>
                    </div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
                    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
                    <script>
                        'use strict'
                        $(".chosen-select").chosen({
                            no_results_text: "Oops, nothing found!"
                        })
                        document.getElementById('button').addEventListener('click', toggleError)
                        const errMessages = document.querySelectorAll('#error')

                        function toggleError() {
                            // Show error message
                            errMessages.forEach((el) => {
                                el.classList.toggle('hidden')
                            })

                            // Highlight input and label with red
                            const allBorders = document.querySelectorAll('.border-gray-200')
                            const allTexts = document.querySelectorAll('.text-gray-500')
                            allBorders.forEach((el) => {
                                el.classList.toggle('border-red-600')
                            })
                            allTexts.forEach((el) => {
                                el.classList.toggle('text-red-600')
                            })
                        }
                    </script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Seleccionar todos los inputs y textareas
                            const inputs = document.querySelectorAll('input, textarea');

                            // Añadir un event listener a cada input para manejar los errores en tiempo real
                            inputs.forEach(input => {
                                input.addEventListener('input', function() {
                                    const errorSpan = this.nextElementSibling;

                                    // Limpiar clases de error previas
                                    this.classList.remove('border-red-600');
                                    if (errorSpan && errorSpan.classList.contains('text-red-500')) {
                                        errorSpan.classList.add('hidden');
                                    }

                                    // Si hay un error, aplicar estilos de error
                                    if (!this.checkValidity()) {
                                        this.classList.add('border-red-600');
                                        if (errorSpan && errorSpan.classList.contains('text-red-500')) {
                                            errorSpan.classList.remove('hidden');
                                        }
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
