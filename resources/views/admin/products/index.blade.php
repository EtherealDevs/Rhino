@extends('layouts.admin')
@section('content')
    <div class=" p-6">
        <div class="p-6 mt-24 bg-white rounded-xl overflow-scroll">

            <div class="flex justify-between w-full mb-5 overflow-none">
                <div class="justify-start">
                    <h2 class="font-josefin font-bold italic text-2xl">
                        Productos
                    </h2>
                </div>

                <div class="justify-end">
                    <button class="bg-blue-500 rounded-xl p-2 px-4">
                        <a class="text-white font-bold" href={{ route('admin.products.create') }}>Nuevo Producto</a>
                    </button>
                </div>
            </div>

            @forelse ($products as $product)
                <div class="container mx-auto my-6">
                    <div
                        class="w-full lg:w-8/12 mx-auto bg-white rounded-lg shadow-lg p-6 hover:shadow-2xl transition-shadow duration-300 ease-in-out">
                        <!-- Product Header -->
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h3>
                            <button aria-label="Toggle Details"
                                class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800" data-menu>
                                <img class="transform transition-transform duration-300"
                                    src="https://tuk-cdn.s3.amazonaws.com/can-uploader/faq-8-svg2.svg" alt="Expand">
                            </button>
                        </div>

                        <!-- Product Details -->

                        <div id="menu" class="hidden mt-4">
                            <div class="mt-2 text-gray-700">
                                <table class="mt-1 w-full min-w-max table-auto text-left">

                                    <thead>
                                        <tr>
                                            <th
                                                class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                                <p
                                                    class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                                                    Producto
                                                </p>
                                            </th>
                                            <th
                                                class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                                <p
                                                    class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                                                    Color
                                                </p>
                                            </th>
                                            <th
                                                class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                                <p
                                                    class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                                                    Precio
                                                </p>
                                            </th>
                                            <th
                                                class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                                <p
                                                    class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                                                    Talla
                                                </p>
                                            </th>
                                            <th
                                                class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                                <p
                                                    class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                                                    Stock
                                                </p>
                                            </th>
                                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50"
                                                colspan="2">
                                                <p
                                                    class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                                                    Acciones
                                                </p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productSizes as $item)
                                            @livewire('admin.products', ['id' => $item->id])
                                        @endforeach
                                    </tbody>


                                </table>

                            </div>
                        </div>

                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let elements = document.querySelectorAll("[data-menu]");
                        elements.forEach(element => {
                            element.addEventListener("click", function() {
                                let parent = element.closest(".container");
                                let details = parent.querySelector("#menu");
                                let icon = element.querySelector("img");

                                details.classList.toggle("hidden");
                                icon.classList.toggle("rotate-180");
                            });
                        });
                    });
                </script>
            @empty
                <tr>
                    <td colspan="100%" class="text-center py-12 p-4 text-gray-500">
                        No tienes productos almacenados.
                    </td>
                </tr>
            @endforelse


            <table>
                <h2 class="font-bold text-slate-400 text-xl my-2 mt-4">Aqui veras los productos eliminados</h2>
                @forelse ($deletedItems as $deletedVariation)
                    @php
                        $deletedItem = $deletedVariation->item;
                    @endphp
                    <tr class="bg-gray-100">
                        <td class="p-4 border-b border-gray-300">
                            <div class="flex items-center gap-3">
                                <div class="flex flex-col">
                                    <p class="block antialiased font-sans text-sm leading-normal text-red-800 font-normal">
                                        {{ $deletedItem->product->name }} (Eliminado)
                                    </p>
                                    <p
                                        class="block antialiased font-sans text-sm leading-normal text-red-800 font-normal opacity-70">
                                        {{ $deletedVariation->deleted_at->format('d-m-Y') }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-gray-300">
                            <div class="flex items-center gap-3">
                                <div class="flex flex-col">
                                    <p class="block antialiased font-sans text-sm leading-normal text-red-800 font-normal">
                                        {{ $deletedItem->color ? $deletedItem->color->name : 'Sin color' }}
                                    </p>
                                    <span
                                        class="block border-4 border-[{{ $deletedItem->color ? $deletedItem->color->color : '#fff' }}]"></span>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-gray-300">
                            <div class="flex flex-col">
                                <p class="block antialiased font-sans text-sm leading-normal text-red-800 font-normal">
                                    ${{ number_format($deletedItem->price() / 100, 2, ',', '.') }}
                                </p>
                            </div>
                        </td>
                        <td class="p-4 border-b border-gray-300">
                            <p class="block antialiased font-sans text-sm leading-normal text-red-800 font-normal">
                                {{ $deletedVariation->size ? $deletedVariation->size->name : 'Sin tamaño' }}
                            </p>
                        </td>
                        <td class="p-4 border-b border-gray-300">
                            <p class="block antialiased font-sans text-sm leading-normal text-red-800 font-normal">
                                {{ $deletedVariation->stock }}
                            </p>
                        </td>
                        <td class="p-4 border-b border-gray-300">
                            <div class="inline-flex space-x-4">
                                <!-- Botón para recuperar el producto -->
                                <form action="{{ route('admin.productitems.restore', $deletedVariation->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="text-blue-600 hover:text-blue-900">Recuperar</button>
                                </form>
                                <!-- Botón para eliminar definitivamente -->
                                {{-- <form action="{{ route('admin.productitems.forceDelete', $deletedVariation->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900">Eliminar definitivamente</button>
                                    </form> --}}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="text-center py-12 p-4">
                            No tienes productos eliminados
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
@endsection
