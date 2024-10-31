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
                                Teamlead
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
                    @forelse ($products as $product)
                        @livewire('admin.products', ['id' => $product->id])
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center py-12 p-4">
                                No tienes productos almacenados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
            <table>
                @forelse ($deletedItems as $deletedItem)
                    <h2 class="font-bold text-slate-400 text-xl my-2 mt-4">Aqui veras los productos eliminados</h2>
                    @foreach ($deletedItems as $deletedItem)
                        <tr class="bg-gray-100">
                            <td class="p-4 border-b border-gray-300">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block antialiased font-sans text-sm leading-normal text-red-800 font-normal">
                                            {{ $deletedItem->product->name }} (Eliminado)
                                        </p>
                                        <p
                                            class="block antialiased font-sans text-sm leading-normal text-red-800 font-normal opacity-70">
                                            {{ $deletedItem->deleted_at->format('d-m-Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-gray-300">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block antialiased font-sans text-sm leading-normal text-red-800 font-normal">
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
                                    {{ $deletedItem->size ? $deletedItem->size->name : 'Sin tamaño' }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-gray-300">
                                <p class="block antialiased font-sans text-sm leading-normal text-red-800 font-normal">
                                    {{ $deletedItem->stock }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-gray-300">
                                <div class="inline-flex space-x-4">
                                    <!-- Botón para recuperar el producto -->
                                    <form action="{{ route('admin.productitems.restore', $deletedItem->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="text-blue-600 hover:text-blue-900">Recuperar</button>
                                    </form>
                                    <!-- Botón para eliminar definitivamente -->
                                    <form action="{{ route('admin.productitems.forceDelete', $deletedItem->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900">Eliminar definitivamente</button>
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
                    @endforeach

                </table>
            </div>
        </div>
    @endsection
