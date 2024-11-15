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


    <div class="pt-20 px-10">
        <div class="p-6 bg-white rounded-xl">
            <div class="border-b border-gray-400">
                <h2 class="font-josefin font-bold italic mb-2 text-xl">
                    @if ($id)
                        Crear Subategoria
                    @else
                        Crear Categoria
                    @endif
                </h2>
            </div>

            <div class="mt-6">
                <div class="px-12 mt-12">
                    <div class="mx-auto">
                        <form action={{ route('admin.categories.store') }} method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="relative z-0 w-full mb-5">
                                <input type="text" name="name" placeholder=" " required
                                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                <label for="name" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Nombre
                                    de Categoria</label>
                                <span class="text-sm text-red-600 hidden" id="error">Este Campo es requerido</span>
                            </div>

                            <div class="relative z-0 w-full mb-5">
                                <input type="text" name="slug" placeholder=" " required
                                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                <label for="slug" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Slug
                                    Amigable</label>
                                <span class="text-sm text-red-600 hidden" id="error">Este Campo es requerido</span>
                            </div>

                            <div class="relative z-0 w-full mb-5">
                                <input type="textarea" name="description" placeholder=" " required
                                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                <label for="description"
                                    class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Descripcion</label>
                                <span class="text-sm text-red-600 hidden" id="error">Este Campo es requerido</span>
                            </div>
                            @if ($id)
                                <input class="hidden" type="text" name="parent_id" id="parent_id"
                                    value={{ $id }}>
                            @endif

                            {{-- <div class="relative z-0 w-full mb-5">
                                <select name="parent_id" id=""
                                    onclick="this.setAttribute('value', this.value);"
                                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                                    <option value={{null}} >No tiene padre</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <label for="select"
                                    class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Seleccionar el
                                    padre</label>
                                <span class="text-sm text-red-600 hidden" id="error">Option has to be selected</span>
                            </div> --}}

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

                                {{-- Mostrar mensajes de error de validación si las imágenes no cumplen los requisitos --}}
                                @error('images')
                                    <div class="mt-2 text-red-500 text-sm">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                                @error('images.*')
                                    <div class="mt-2 text-red-500 text-sm">
                                        <p>{{ $message }}</p>
                                    </div>
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
@endsection
