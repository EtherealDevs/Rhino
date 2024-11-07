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
                    Cargar Venta
                </h2>

                <div class="mt-6">
                    <div class="px-12 mt-12">
                        <div class="mx-auto">
                            <form action={{ route('admin.sales.store') }} method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="relative z-0 w-full mb-5">
                                    <input type="date" name="start_date" placeholder=" " required
                                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                    <label for="start_date"
                                        class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Fecha de inicio
                                    </label>
                                    @error('start_date')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="relative z-0 w-full mb-5">
                                    <input type="date" name="end_date" placeholder=" " required
                                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                    <label for="end_date"
                                        class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Fecha de
                                        Finalizacion</label>
                                    @error('end_date')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="relative z-0 w-full mb-5">
                                    <input type="text" name="title" placeholder=" " required
                                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                    <label for="title"
                                        class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Titulo</label>
                                    @error('title')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="relative z-0 w-full mb-5">
                                    <input type="textarea" name="description" placeholder=" " required
                                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                    <label for="description"
                                        class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Descripcion</label>
                                    @error('description')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="relative z-1 w-full mb-5">
                                    <select data-placeholder="Begin typing a name to filter..." multiple
                                        class="chosen-select w-full" name="products[]" style="width: 100%;">
                                        <option value="">Seleccionar Products</option>
                                        @foreach ($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @error('products')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                                @foreach ($category->products as $product)
                                                    @if ($product->sale == null)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="relative z-0 w-full mb-5">
                                    <input type="number" name="discount" placeholder=" " required
                                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                    <label for="discount"
                                        class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Descuento</label>
                                    @error('discount')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-8">
                                    <label for="image"
                                        class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] py-12 text-center">
                                        <div class="w-full">
                                            <!-- Texto descriptivo -->
                                            <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                                                Selecciona una o más imágenes aquí 👇🏼
                                            </span>
                                            <!-- Botón para seleccionar archivos -->
                                            <span
                                                class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                                <input class="hidden" type="file" name="image" accept="image/*"
                                                    id="image" multiple onchange="previewImages(event)" />
                                                <!-- SVG y texto dentro del label -->
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

                                    <!-- Contenedor para la vista previa de las imágenes -->
                                    <div id="preview-container" class="mt-4 grid grid-cols-2 gap-4"></div>
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
                        function previewImages(event) {
                            const files = event.target.files;
                            const previewContainer = document.getElementById('preview-container');
                            previewContainer.innerHTML = ''; // Limpiar previas anteriores

                            Array.from(files).forEach((file, index) => {
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
                                    removeButton.onclick = () => removeImage(index);

                                    // Agregar imagen y botón al contenedor
                                    imageWrapper.appendChild(img);
                                    imageWrapper.appendChild(removeButton);

                                    // Añadir contenedor al preview-container
                                    previewContainer.appendChild(imageWrapper);
                                };

                                reader.readAsDataURL(file);
                            });
                        }

                        function removeImage(index) {
                            const previewContainer = document.getElementById('preview-container');
                            previewContainer.children[index].remove(); // Remueve el div correspondiente a la imagen
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
                    <script>
                        document.getElementById('button').addEventListener('click', function(event) {
                            const inputs = document.querySelectorAll('input[required], textarea[required]');
                            let isValid = true;

                            inputs.forEach((input) => {
                                const errorMessage = input.nextElementSibling;

                                if (input.value.trim() === '') {
                                    errorMessage.classList.remove('hidden'); // Muestra el mensaje de error
                                    input.classList.add('border-red-600'); // Resalta el borde
                                    isValid = false;
                                } else {
                                    errorMessage.classList.add('hidden'); // Oculta el mensaje de error
                                    input.classList.remove('border-red-600'); // Quita el resaltado del borde
                                }
                            });

                            if (!isValid) {
                                event.preventDefault(); // Evita que el formulario se envíe si hay errores
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
