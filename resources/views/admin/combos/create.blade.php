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
                    Crear Combo
                </h2>

                <div class="mt-6">
                    <div class="px-12 mt-12">
                        <div class="mx-auto">
                            <form action={{ route('admin.combos.store') }} method="POST" enctype="multipart/form-data">

                                @csrf
                                <div class="relative z-1 w-full mb-5">
                                    <select data-placeholder="Begin typing a name to filter..." multiple
                                        class="chosen-select ww-full" name="items[]" style="width: 100%">
                                        <option value="">Seleccionar Products</option>
                                        @foreach ($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->products as $product)
                                                    @foreach ($product->items as $item)
                                                        <option value="{{ $item->id }}">{{ $product->name }}({{$item->color->name}})</option>
                                                    @endforeach
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="relative z-0 w-full mb-5">
                                    <input type="number" name="discount" placeholder=" " required
                                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                    <label for="discout"
                                        class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Descuento</label>
                                    <span class="text-sm text-red-600 hidden" id="error">Este Campo es requerido</span>
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
                </div>
            </div>


        </div>
    </div>
@endsection
