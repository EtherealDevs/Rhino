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
                    Almacenar Productos
                </h2>

                <div class="mt-6">
                    <div class="px-12 mt-12">
                        <div class="mx-auto">
                            <form action={{ route('admin.productitems.store') }} method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Campo de selección de producto -->
                                <div class="relative z-0 w-full mb-5">
                                    <div class="grid grid-cols-10 gap-2">
                                        <!-- Botón para abrir el modal -->
                                        <div class="col-span-9 flex">
                                            <button type="button" onclick="openModal('product-selection-modal')"
                                                class="text-black font-bold py-2 px-4 rounded-lg">
                                                Seleccionar producto
                                            </button>

                                            <!-- Campo oculto para almacenar el ID del producto seleccionado -->
                                            <input type="hidden" name="product_id" id="selected-product-id">

                                            <!-- Muestra el nombre del producto seleccionado -->
                                            <p id="selected-product-name" class="text-gray-500 mt-2">Ningún producto
                                                seleccionado</p>

                                            @error('product_id')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Modal para seleccionar el producto -->


                                        <div class="flex place-content-center">
                                            <button data-modal-target="crud-modal-product"
                                                data-modal-toggle="crud-modal-product"
                                                class="block text-white text-3xl bg-blue-700 hover:bg-blue-800 font-medium rounded-lg px-3 py-1 text-center"
                                                type="button">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Campo de precio original y stock -->
                                <div class="relative z-30 w-full mb-5">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="relative">
                                            <input type="text" name="displayInput" id="displayInput" placeholder=""
                                                required
                                                class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                            <input type="hidden" name="original_price" id="original_price">
                                            <script>
                                                const displayInput = document.getElementById("displayInput");
                                                const hiddenInput = document.getElementById("original_price");

                                                displayInput.addEventListener("input", () => {
                                                    let value = displayInput.value.replace(/\D/g, ""); // Remove non-numeric characters
                                                    hiddenInput.value = value; // Store raw number without decimal in hidden input

                                                    // Add decimal point before the last two digits, if there are at least three digits
                                                    if (value.length > 2) {
                                                        displayInput.value = value.slice(0, -2) + "," + value.slice(-2);
                                                    } else {
                                                        displayInput.value = value; // No need to add a decimal point if less than 3 digits
                                                    }
                                                });
                                            </script>
                                            <label for="original_price"
                                                class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Precio</label>
                                            @error('original_price')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="relative">
                                            <input type="number" name="stock" placeholder=" " required
                                                class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                            <label for="stock"
                                                class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Stock</label>
                                            @error('stock')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Campo de color -->
                                <div class="grid grid-cols-1 md:grid-cols-2 z-30 gap-8">
                                    <!-- Campo de Color -->
                                    <div class="relative z-0 w-full mb-5">
                                        <fieldset class="mb-4">
                                            <legend class="block text-gray-700 font-semibold font-josefin mb-2">Color:
                                            </legend>
                                            <div class="flex flex-wrap gap-4 mt-6">
                                                @foreach ($colors as $color)
                                                    <div
                                                        class="flex flex-col items-center p-2 border border-gray-200 rounded-xl">
                                                        <input type="radio" id="color-{{ $color->id }}" name="color_id"
                                                            value="{{ $color->id }}" class="hidden peer" required />
                                                        <label for="color-{{ $color->id }}"
                                                            style="background-color: {{ $color->color }}"
                                                            class="w-10 h-10 rounded-full cursor-pointer outline outline-2 outline-gray-300
                                                                transition-all duration-200 ease-in-out
                                                                peer-checked:outline-blue-400 hover:outline-gray-400
                                                                shadow-md"></label>
                                                        <p class="text-gray-700 text-xs font-semibold font-josefin">
                                                            {{ $color->name }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </fieldset>

                                        <div>
                                            <button data-modal-target="crud-modal-color"
                                                data-modal-toggle="crud-modal-color"
                                                class="block text-white text-3xl bg-blue-700 hover:bg-blue-800 font-medium rounded-lg px-3 py-1 text-center"
                                                type="button">+</button>
                                        </div>
                                        @error('color_id')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Campo de Talle -->
                                    <div class="relative z-0 w-full mb-5">
                                        <legend class="block text-gray-700 font-semibold font-josefin mb-2">Talle:</legend>
                                        <div class="flex flex-wrap gap-4 mt-8">
                                            @foreach ($sizes as $size)
                                                <div class="flex flex-col items-center">
                                                    <input type="radio" id="size-{{ $size->id }}" name="size_id"
                                                        value="{{ $size->id }}" class="hidden peer" required />
                                                    <label for="size-{{ $size->id }}"
                                                        class="px-3 py-1 rounded-md bg-gray-200 cursor-pointer transition hover:bg-blue-100 peer-checked:bg-blue-500 peer-checked:text-white">
                                                        {{ $size->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div>
                                            <button data-modal-target="crud-modal-size" data-modal-toggle="crud-modal-size"
                                                class="block text-white text-3xl bg-blue-700 hover:bg-blue-800 font-medium rounded-lg px-3 py-1 text-center"
                                                type="button">+</button>
                                        </div>
                                        @error('size_id')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Campo de selección de imágenes -->
                                <div class="mb-8">
                                    <label for="image"
                                        class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] py-12 text-center">
                                        <div class="w-full">
                                            <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                                                Selecciona una o más imágenes aquí 👇🏼
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

                                <!-- Botón de envío -->
                                <button id="button" type="submit"
                                    class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-blue-600 hover:bg-blue-700 hover:shadow-lg focus:outline-none">
                                    Guardar
                                </button>
                            </form>
                        </div>
                    </div>

                    <script>
                        // Variable para almacenar las imágenes seleccionadas
                        let selectedFiles = [];

                        function previewImages(event) {
                            const files = Array.from(event.target.files);

                            // Combinar los archivos nuevos con los ya seleccionados
                            selectedFiles = [...selectedFiles, ...files];
                            buildFileList();

                            // Limpiar el contenedor de vista previa

                            // Mostrar cada archivo seleccionado
                            populatePreviewContainer();
                        }

                        function populatePreviewContainer() {
                            const previewContainer = document.getElementById('preview-container');
                            previewContainer.innerHTML = '';
                            selectedFiles.forEach((file, index) => {
                                const reader = new FileReader();

                                reader.onload = function(e) {
                                    // Contenedor de la imagen y el botón de eliminar
                                    const imageWrapper = document.createElement('div');
                                    imageWrapper.classList.add('relative', 'w-full', 'h-auto');

                                    // Crear imagen
                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.classList.add('w-full', 'h-auto', 'rounded-md', 'border', 'border-gray-300');

                                    // Crear botón para eliminar la imagen
                                    const removeButton = document.createElement('button');
                                    removeButton.innerHTML = 'Eliminar';
                                    removeButton.classList.add('absolute', 'top-1', 'right-1', 'bg-red-500', 'text-white',
                                        'px-2', 'py-1', 'rounded');

                                    // Manejar el evento de clic para eliminar la imagen
                                    removeButton.onclick = () => {
                                        removeImage(index)
                                    };

                                    // Agregar imagen y botón al contenedor
                                    imageWrapper.appendChild(img);
                                    imageWrapper.appendChild(removeButton);

                                    // Añadir contenedor al preview-container
                                    previewContainer.appendChild(imageWrapper);
                                };

                                // Leer el archivo como URL de datos
                                reader.readAsDataURL(file);
                            });
                        };

                        function removeImage(index) {
                            const previewContainer = document.getElementById('preview-container');
                            previewContainer.children[index].remove(); // Remueve el div correspondiente a la imagen
                            selectedFiles.splice(index, 1);
                            buildFileList(); // Update the file list in the input field
                            populatePreviewContainer(); // Update the preview container with the new images
                        }

                        function buildFileList() {
                            imageInput = document.getElementById('image');
                            let list = new DataTransfer();
                            selectedFiles.forEach((file, index) => {
                                list.items.add(file);
                            });
                            imageInput.files = list.files; // Update the input file list with the new files
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


    <!--Model de Color -->
    <div id="crud-modal-color" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center backdrop-blur-md items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">

            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow ">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold font-josefin italic text-black">
                        Crear nuevo Color
                    </h3>
                    <button type="button"
                        class="text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:text-white"
                        data-modal-toggle="crud-modal-color">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action={{ route('admin.colors.store') }} method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Type product name" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="color" class="block mb-2 text-sm font-medium text-gray-900">Color</label>
                            <input type="color" name="color" id="color"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Talles -->
    <div id="crud-modal-size" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center backdrop-blur-md items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Crear nuevo Talle
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="crud-modal-size">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action={{ route('admin.sizes.store') }} method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="size" class="block mb-2 text-sm font-medium text-gray-900 ">Talle</label>
                            <input type="text" name="size" id="size"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Escribe un talle" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="sort_number" class="block mb-2 text-sm font-medium text-gray-900">Orden</label>
                            <input type="number" name="sort_number" id="sort_number"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Marcas -->
    <div id="crud-modal-brand" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center backdrop-blur-md items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Crear nuevo Color
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal-brand">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action={{ route('admin.brands.store') }} method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type product name" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                            <input type="textarea" name="description" id="description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type product name" required="">
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Productos -->
    <div id="product-selection-modal"
    class="hidden fixed inset-0 z-50 h-screen backdrop-blur-md flex items-center justify-center overflow-y-auto overflow-x-hidden">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-12 relative">
        <h2 class="text-xl font-semibold mb-4">Seleccionar Producto</h2>

        <!-- Botón de cerrar -->
        <button type="button" onclick="closeModal('product-selection-modal')" class="absolute top-8 right-8 text-gray-400">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Lista de productos con scroll -->
        <div class="flex flex-col space-y-2 z-50 overflow-y-auto max-h-80">
            @foreach ($products as $product)
                <button type="button" onclick="selectProduct({{ $product->id }}, '{{ $product->name }}')"
                    class="px-4 py-2 text-left hover:bg-gray-100 rounded-lg">
                    {{ $product->name }}
                </button>
            @endforeach
        </div>
    </div>
</div>


    <!-- Main modal -->
    <div id="crud-modal-product" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 backdrop-blur-md h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg text-black font-semibold ">
                        Crear nuevo Producto
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="crud-modal-product">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action={{ route('admin.products.store') }} method="POST" class="p-4 md:p-5">
                    @csrf
                    <!-- Errores -->
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="text-sm text-red-500">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nombre</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Type product name" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="slug" class="block mb-2 text-sm font-medium text-gray-900e">Slug</label>
                            <input type="text" name="slug" id="slug"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Type product name" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900">Descripción</label>
                            <input type="textarea" name="description" id="description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Type product description" required="">
                        </div>
                        <div>
                            <label for="volume" class="block mb-2 text-sm font-medium text-gray-900">Volumen</label>
                            <input type="number" name="volume" id="volume"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Type product volume" required="">
                        </div>
                        <div>
                            <label for="weigth" class="block mb-2 text-sm font-medium text-gray-900">Peso</label>
                            <input type="number" name="weight" id="weight"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Type product weigth" required="">
                        </div>
                        <div class="col-span-2 grid grid-cols-5">
                            <div class="col-span-4">
                                <select name="category_id" required="" id=""
                                    onclick="this.setAttribute('value', this.value);"
                                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                                    <option value="">Categoria</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <label for="select"
                                    class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Seleccionar
                                    categoria</label>
                            </div>
                            <div class="flex justify-center aling-items-center">
                                <a class="text-white text-lg font-bold border rounded-lg bg-blue-700 p-3"
                                    href={{ route('admin.categories.create') }}>+</a>
                            </div>
                        </div>
                        <div class="col-span-2 grid grid-cols-5">
                            <div class="col-span-4">
                                <select name="brand_id" required id="brand_id"
                                    onclick="this.setAttribute('value', this.value);"
                                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                                    <option value="" disabled selected>Marca</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <label for="brand_id"
                                    class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Seleccionar
                                    marca</label>
                                @error('brand_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex justify-center items-center">
                                <a class="text-white text-lg font-bold border rounded-lg bg-blue-700 p-3"
                                    href={{ route('admin.brands.create') }}>+</a>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Función para abrir el modal
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        // Función para cerrar el modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Función para seleccionar un producto
        function selectProduct(productId, productName) {
            // Asigna el ID y el nombre del producto seleccionado al campo oculto y al texto de visualización
            document.getElementById('selected-product-id').value = productId;
            document.getElementById('selected-product-name').textContent = productName;

            // Cierra el modal
            closeModal('product-selection-modal');
        }
    </script>
    <script src="https://flowbite.com/docs/flowbite.min.js?v=2.3.0a"></script>
    <script src="https://flowbite.com/docs/datepicker.min.js?v=2.3.0a"></script>
    <script src="https://flowbite.com/docs/docs.js?v=2.3.0a"></script>
@endsection
