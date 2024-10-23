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
                    Editar {{ $productItem->product->name }} ({{ $productItem->color->name }} - {{ $size->name }})
                </h2>

                <div class="mt-6">
                    <div class="px-12 mt-12">
                        <div class="mx-auto">
                            <form action="{{ route('admin.productitems.update', $productItem->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="text" class="hidden" value="{{ $size->id }}" name="size_id">

                                <div class="relative z-0 w-full mb-5">
                                    <div class="grid grid-cols-10 gap-2">
                                        <div class="col-span-9">
                                            <select name="product_id" required
                                                class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                                                <option value="null"></option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" @selected($product->id == $productItem->product->id)>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="product_id"
                                                class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Seleccionar
                                                el producto</label>
                                            @error('product_id')
                                                <span class="text-sm text-red-600">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="relative z-0 w-full mb-5">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <input type="number" name="original_price" id="original_price" placeholder=""
                                                value="{{ old('original_price', $productItem->original_price) }}" required
                                                class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                            <label for="original_price"
                                                class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Precio</label>
                                            @error('original_price')
                                                <span class="text-sm text-red-600">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <input type="number" name="stock" placeholder=""
                                                value="{{ old('stock', $stock) }}" required
                                                class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                            <label for="stock"
                                                class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Stock</label>
                                            @error('stock')
                                                <span class="text-sm text-red-600">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-8">
                                    <div class="grid grid-cols-2 gap-4">
                                        @foreach ($productItem->images as $image)
                                            <div class="relative">
                                                <img src="{{ url(Storage::url($image->url)) }}" alt="Imagen del producto"
                                                    class="w-full h-auto rounded-md border border-gray-300">

                                                <!-- Botón para eliminar la imagen -->
                                                <button onclick="removeImage({{ $image->id }})"
                                                    class="absolute top-1 z-50 right-1 bg-red-500 text-white px-2 py-1 rounded">
                                                    Eliminar
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <label for="image"
                                        class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] py-12 text-center">
                                        <div class="w-full">
                                            <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                                                Selecciona una o más imágenes nuevas aquí 👇🏼
                                            </span>
                                            <span
                                                class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                                <input class="hidden" type="file" name="images[]" accept="image/*"
                                                    id="image" multiple onchange="previewImages(event)" />
                                                <div class="flex items-center justify-center space-x-2 cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 256 256" class="text-gray-500">
                                                        <path fill="currentColor"
                                                            d="M216 40H40a16 16 0 0 0-16 16v144a16 16 0 0 0 16 16h176a16 16 0 0 0 16-16V56a16 16 0 0 0-16-16m-60 48a12 12 0 1 1-12 12a12 12 0 0 1 12-12m60 112H40v-39.31l46.34-46.35a8 8 0 0 1 11.32 0L165 181.66a8 8 0 0 0 11.32-11.32l-17.66-17.65L173 138.34a8 8 0 0 1 11.31 0L216 170.07z">
                                                        </path>
                                                    </svg>
                                                    <span>Subir imágenes</span>
                                                </div>
                                            </span>
                                        </div>
                                    </label>
                                    <div id="preview-container" class="mt-4 grid grid-cols-2 gap-4"></div>
                                    @error('images.*')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror

                                </div>

                                <button id="button" type="submit"
                                    class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-blue-600 hover:bg-blue-700 hover:shadow-lg focus:outline-none">
                                    Guardar
                                </button>
                            </form>
                        </div>
                    </div>

                    <script>
                        function removeImage(imageId) {
                            if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
                                fetch(`/admin/products/images/${imageId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Content-Type': 'application/json',
                                        },
                                    })
                                    .then(response => {
                                        if (response.ok) {
                                            // Eliminar la imagen del DOM
                                            location.reload(); // Recargar la página para reflejar el cambio
                                        } else {
                                            alert('Error al eliminar la imagen.');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            }
                        }

                        function previewImages(event) {
                            const previewContainer = document.getElementById('preview-container');
                            previewContainer.innerHTML = ''; // Limpiar el contenedor antes de mostrar nuevas imágenes

                            Array.from(event.target.files).forEach(file => {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.classList.add('w-full', 'h-auto', 'rounded-md', 'border', 'border-gray-300');
                                    previewContainer.appendChild(img);
                                }
                                reader.readAsDataURL(file);
                            });
                        }
                    </script>
                    <script>
                        'use strict'

                        document.getElementById('button').addEventListener('click', toggleError)
                        const errMessages = document.querySelectorAll('#error')

                        // function price_sale(){
                        //     const original_price = document.getElementById('original_price').value
                        //     const sale_price = document.getElementById('sale_price').value
                        //     if(sale_price===null){
                        //         sale_price = original_price
                        //     }
                        // }

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
                </div>
            </div>

        </div>
    </div>

    <script src="https://flowbite.com/docs/flowbite.min.js?v=2.3.0a"></script>
    <script src="https://flowbite.com/docs/datepicker.min.js?v=2.3.0a"></script>
    <script src="https://flowbite.com/docs/docs.js?v=2.3.0a"></script>
@endsection
