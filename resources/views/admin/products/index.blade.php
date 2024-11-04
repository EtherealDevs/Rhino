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
            @forelse ($productSizes as $productId => $productSizes)
            @php
            // Obtener el primer ProductSize para acceder a la información del producto
            $product = $productSizes->first()->item->product;
        @endphp
                <div class=" mx-auto w-full" x-data="{ open: null }">
                    <!-- Q 1 -->
                    <div class="border border-gray-200  rounded-md my-5">
                        <button @click="open === {{ $product->id }} ? open = null : open = {{ $product->id }}"
                            class="w-full flex justify-between items-center py-2 px-4  text-gray-700 rounded-md">
                            <span>{{ $product->name }}</span>
                            <svg :class="{ 'rotate-180': open === 1 }"
                                class="ml-2 h-4 w-4 transition-transform duration-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="open === {{ $product->id }}" x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0"
                            class="overflow-hidden  px-4 py-2 rounded-b-md">
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
                                @foreach ($productSizes as $productSize)
                                        <tbody>
                                                    @livewire('admin.products', ['id' => $productSize->id])
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
