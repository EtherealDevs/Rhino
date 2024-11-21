@extends('layouts.admin')
@section('content')
    <div class=" p-6">
        <div class="p-6 mt-24 bg-white rounded-xl">

            {{-- Encabezado --}}
            <div class="flex justify-between w-full mb-5">
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

            {{-- Productos --}}
            @forelse ($products as $productId =>$productVariations)
                @php
                    // Obtener el primer ProductSize para acceder a la información del producto
                    $product = $productVariations->first()->item->product;
                @endphp
                <div class=" mx-auto w-full" x-data="{ open: null }">
                    <div class="border border-gray-200  rounded-xl my-5">

                        {{-- Boton para desplega los products Items --}}
                        <button @click="open === {{ $product->id }} ? open = null : open = {{ $product->id }}"
                            class="w-full flex justify-between items-center py-2 px-4  text-gray-700 rounded-md">
                            <span
                                class="font-bold text-md lg:text-md text-slate-800 tracking-wide hover:text-blue-600 transition-colors duration-200">
                                {{ $product->name }}
                            </span>
                            <hr>
                            <svg :class="{ 'rotate-180': open === 1 }"
                                class="ml-2 h-4 w-4 transition-transform duration-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        {{-- Botones de eliminar y editar producto padre --}}
                        <div>
                            <div class="flex justify-end">
                                <div class="flex justify-end">
                                    <div class="inline-flex items-center rounded-md shadow-sm">
                                        {{-- Botón de Editar --}}
                                        <button data-modal-target="edit-product-{{ $product->id }}"
                                            data-modal-toggle="edit-product-{{ $product->id }}"
                                            class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </span>
                                        </button>

                                        {{-- Botón de Eliminar --}}
                                        <button
                                            class="text-slate-800 hover:text-red-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-xl font-medium px-4 py-2 inline-flex space-x-1 items-center"
                                            data-modal-target="delete-modal-{{ $product->id }}"
                                            data-modal-toggle="delete-modal-{{ $product->id }}">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </span>
                                        </button>

                                        {{-- Modal de Confirmación para Eliminar --}}
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <div id="delete-modal-{{ $product->id }}" tabindex="-1" aria-hidden="true"
                                                class="hidden min-w-screen h-screen fixed left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
                                                <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
                                                <div
                                                    class="w-full max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white">
                                                    <!-- Contenido del Modal -->
                                                    <div class="text-center p-5 flex-auto justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-16 h-16 flex items-center text-red-500 mx-auto"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <h2 class="text-xl font-bold py-4">¿ESTÁ SEGURO?</h2>
                                                        <p class="text-sm text-gray-500 px-8">¿Desea eliminar el producto
                                                            <span
                                                                class="font-bold text-blue-500">{{ $product->name }}</span>?
                                                            Esta acción es irreversible. <span
                                                                class="block mt-6 text-red-600 font-bold text-xl"> Y
                                                                eliminara todos sus items creados</span>
                                                        </p>
                                                    </div>
                                                    <!-- Footer del Modal -->
                                                    <div class="p-3 mt-2 text-center space-x-4 md:block">
                                                        <button data-modal-hide="delete-modal-{{ $product->id }}"
                                                            type="button"
                                                            class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                                                            Cancelar
                                                        </button>
                                                        <button type="submit"
                                                            class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">
                                                            Eliminar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                                <div id="edit-product-{{ $product->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 backdrop-blur-md h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                <h3 class="text-lg text-black font-semibold">
                                                    Editar Producto
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                    data-modal-toggle="edit-product-{{ $product->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>

                                            <!-- Formulario para editar el producto -->
                                            <form action="{{ route('admin.products.update', $product->id) }}"
                                                method="POST" class="p-4 md:p-5">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                                                        <input type="text" name="name" id="name"
                                                            value="{{ old('name', $product->name) }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="slug"
                                                            class="block mb-2 text-sm font-medium text-gray-900">Slug</label>
                                                        <input type="text" name="slug" id="slug"
                                                            value="{{ old('slug', $product->slug) }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="description"
                                                            class="block mb-2 text-sm font-medium text-gray-900">Descripción</label>
                                                        <input type="text" name="description" id="description"
                                                            value="{{ old('description', $product->description) }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>
                                                    <div>
                                                        <label for="volume"
                                                            class="block mb-2 text-sm font-medium text-gray-900">Volumen</label>
                                                        <input type="number" name="volume" id="volume"
                                                            value="{{ old('volume', $product->volume) }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>
                                                    <div>
                                                        <label for="weight"
                                                            class="block mb-2 text-sm font-medium text-gray-900">Peso</label>
                                                        <input type="number" name="weight" id="weight"
                                                            value="{{ old('weight', $product->weight) }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="category_id"
                                                            class="block mb-2 text-sm font-medium text-gray-900">Categoría</label>
                                                        <select name="category_id" required
                                                            class="pt-3 pb-2 block w-full bg-transparent border-b-2 border-gray-200 focus:border-black rounded-lg">
                                                            <option value="">Categoría</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="brand_id"
                                                            class="block mb-2 text-sm font-medium text-gray-900">Marca</label>
                                                        <select name="brand_id" required
                                                            class="pt-3 pb-2 block w-full bg-transparent border-b-2 border-gray-200 focus:border-black rounded-lg">
                                                            <option value="">Marca</option>
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->id }}"
                                                                    {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                                    {{ $brand->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                                    Guardar cambios
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ProductItems Variaciones de color y talle --}}
                        <div x-show="open === {{ $product->id }}" x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0"
                            class="overflow-hidden overflow-x-auto  px-4 py-2 rounded-b-md">
                            <table class="mt-1 w-full min-w-max table-auto text-left">

                                <thead>
                                    <tr>
                                        <th
                                            class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                            <p
                                                class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
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
                                @foreach ($productVariations as $productVariation)
                                    <tbody class="overflow-scroll">
                                        @livewire('admin.products', ['id' => $productVariation->id])
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="100%" class="text-center py-12 p-4 text-gray-500">
                        No tienes productos almacenados.
                    </td>
                </tr>
            @endforelse

            {{-- Seccion de productos borrados --}}
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    @forelse ($deletedProductItemVariations as $deletedProductItemVariation)
                        @php
                            $newDeletedProductItem = $deletedProductItemVariation->item()->withTrashed()->first();
                            $newDeletedProduct = $newDeletedProductItem->product()->withTrashed()->first();
                        @endphp
                        <tr
                            class="bg-red-50 hover:bg-red-100 transition duration-300 w-full md:table-row flex flex-col md:flex-row mb-4 md:mb-0">
                            <td class="p-4 border-b border-gray-300 md:table-cell flex-1">
                                <div class="flex flex-col md:flex-row gap-3">
                                    <div>
                                        <p class="font-sans text-sm font-semibold text-red-900">
                                            {{ $newDeletedProduct->name }}
                                            <span class="text-red-700 font-normal">(Eliminado)</span>
                                        </p>
                                        <p class="text-xs text-red-700 opacity-80">
                                            Eliminado el {{ $deletedProductItemVariation->deleted_at->format('d-m-Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="p-4 border-b border-gray-300 md:table-cell flex-1">
                                <div class="flex items-center gap-3">
                                    <p class="font-sans text-sm font-semibold text-gray-800">
                                        {{ $newDeletedProductItem->color ? $newDeletedProductItem->color->name : 'Sin color' }}
                                    </p>
                                    <span class="h-4 w-4 rounded-full border-2"
                                        style="background-color: {{ $newDeletedProductItem->color ? $newDeletedProductItem->color->color : '#fff' }}">
                                    </span>
                                </div>
                            </td>

                            <td class="p-4 border-b border-gray-300 md:table-cell flex-1">
                                <p class="font-sans text-sm font-semibold text-gray-800">
                                    ${{ number_format($newDeletedProductItem->price() / 100, 2, ',', '.') }}
                                </p>
                            </td>

                            <td class="p-4 border-b border-gray-300 md:table-cell flex-1">
                                <p class="font-sans text-sm font-semibold text-gray-800">
                                    {{ $newDeletedProduct->category->name }}
                                </p>
                            </td>

                            <td class="p-4 border-b border-gray-300 md:table-cell flex-1">
                                <div class="flex space-x-4">
                                    <form
                                        action="{{ route('admin.productitemvariations.restore', $deletedProductItemVariation->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button
                                            class="text-blue-600 hover:text-blue-800 font-semibold transition duration-200 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M7.16 10.972A7 7 0 0 1 19.5 15.5a1.5 1.5 0 1 0 3 0c0-5.523-4.477-10-10-10a9.97 9.97 0 0 0-7.418 3.295L4.735 6.83a1.5 1.5 0 1 0-2.954.52l1.042 5.91c.069.391.29.74.617.968c.403.282.934.345 1.385.202l5.644-.996a1.5 1.5 0 1 0-.52-2.954l-2.788.491Z" />
                                            </svg>
                                            Recuperar
                                        </button>
                                    </form>
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
    </div>
    </div>
@endsection
