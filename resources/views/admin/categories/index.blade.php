@extends('layouts.admin')
@section('content')
    <div class="pt-20 px-10">
        <div class="p-6 bg-white rounded-xl ">

            <div class="flex justify-between w-full mb-5">
                <div class="justify-start">
                    <h2 class="font-josefin font-bold italic text-2xl">
                        Categorias
                    </h2>
                </div>

                <div class="justify-end">
                    <button class="bg-blue-500 rounded-xl p-2 px-4">
                        <a class="text-white font-bold" href={{ route('admin.categories.create') }}>Nueva categoria</a>
                    </button>
                </div>
            </div>

            <div class="overflow-scroll">
                <table class="mt-1 w-full min-w-max table-auto text-left">
                    <thead>
                        <tr>
                            <th
                                class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p
                                    class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                                    Nombre
                                </p>
                            </th>
                            <th
                                class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p
                                    class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                                    Slug
                                </p>
                            </th>
                            <th
                                class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p
                                    class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                                    Descripción
                                </p>
                            </th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td colspan="100%" class="p-0">
                                <div class="group bg-gray-50 hover:bg-gray-100 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg mb-4">
                                    <summary class="cursor-pointer p-4 flex justify-between items-center transition-colors">
                                        <p class="block antialiased font-sans text-base font-medium text-blue-gray-900">
                                            {{ $category->name }}
                                        </p>
                                        <p class="block antialiased font-sans text-sm text-gray-600">
                                            {{ $category->slug }}
                                        </p>
                                        <p class="block antialiased text-ellipsis overflow-hidden font-sans text-sm leading-normal text-blue-gray-900">
                                            {{ $category->description }} <span class="truncate">...</span>
                                        </p>

                                        <!-- Botones de acción -->
                                        <div class="space-x-4 flex items-center">
                                            <a href="{{ route('admin.categories.create', ['id' => $category->id]) }}"
                                                class="block px-2 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg hover:bg-blue-600 transition-all duration-300 ease-in-out transform hover:scale-105 shadow">
                                                Crear Subcategoría
                                            </a>
                                            <a href="{{ route('admin.categories.edit', $category) }}">
                                                <button
                                                    class="text-gray-800 hover:text-blue-600 bg-white hover:bg-slate-100 border border-slate-200 rounded-lg px-3 py-1.5 flex items-center transition-all duration-200 ease-in-out shadow">
                                                    <span class="mr-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                    </span>
                                                    Editar
                                                </button>
                                            </a>
                                            <button class="text-gray-800 hover:text-red-600 bg-white hover:bg-slate-100 border border-slate-200 rounded-lg px-3 py-1.5 flex items-center transition-all duration-200 ease-in-out shadow"
                                                data-modal-target="default-modal-{{ $category->id }}"
                                                data-modal-toggle="default-modal-{{ $category->id }}">
                                                <span class="mr-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </span>
                                                Eliminar
                                            </button>
                                        </div>
                                    </summary>

                                    <div class="border-t border-gray-300 my-2"></div>

                                    <details class="ml-6">
                                        <summary class="font-medium text-gray-800 hover:text-gray-900 cursor-pointer mb-2">
                                            Subcategorías
                                        </summary>
                                        <div class="pl-6">
                                            @if ($category->children->isNotEmpty())
                                                @foreach ($category->children as $childCategory)
                                                <div class="p-2 border-b border-blue-gray-200">
                                                    <p class="font-medium text-gray-700">
                                                        {{ $childCategory->name }}
                                                    </p>
                                                    <p class="text-sm text-gray-600">
                                                        Slug: {{ $childCategory->slug }}
                                                    </p>
                                                    <p class="text-sm text-gray-600">
                                                        Descripción: {{ $childCategory->description }}
                                                    </p>
                                                </div>
                                                <div class="space-x-4 flex items-center">
                                                    <a href="{{ route('admin.categories.create', ['id' => $category->id]) }}"
                                                        class="block px-2 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg hover:bg-blue-600 transition-all duration-300 ease-in-out transform hover:scale-105 shadow">
                                                        Crear Subcategoría
                                                    </a>
                                                    <a href="{{ route('admin.categories.edit', $category) }}">
                                                        <button
                                                            class="text-gray-800 hover:text-blue-600 bg-white hover:bg-slate-100 border border-slate-200 rounded-lg px-3 py-1.5 flex items-center transition-all duration-200 ease-in-out shadow">
                                                            <span class="mr-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                </svg>
                                                            </span>
                                                            Editar
                                                        </button>
                                                    </a>
                                                    <button class="text-gray-800 hover:text-red-600 bg-white hover:bg-slate-100 border border-slate-200 rounded-lg px-3 py-1.5 flex items-center transition-all duration-200 ease-in-out shadow"
                                                        data-modal-target="default-modal-{{ $category->id }}"
                                                        data-modal-toggle="default-modal-{{ $category->id }}">
                                                        <span class="mr-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                        </span>
                                                        Eliminar
                                                    </button>
                                                </div>
                                                @endforeach
                                            @else
                                                <p class="text-sm text-gray-500">
                                                    No tiene categoría hija.
                                                </p>
                                            @endif
                                        </div>
                                    </details>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="100%" class="text-center p-4">
                                No tienes categorías almacenadas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody> --}}

                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td colspan="100%" class="p-0">
                                    <div
                                        class="group bg-gray-50 hover:bg-gray-100 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg mb-4">
                                        <summary
                                            class="cursor-pointer p-4 flex justify-between items-center transition-colors">
                                            <!-- Nombre de la categoría -->
                                            <p class="block antialiased font-sans text-base font-medium text-blue-gray-900">
                                                {{ $category->name }}
                                            </p>
                                            <!-- Slug de la categoría -->
                                            <p class="block antialiased font-sans text-sm text-gray-600">
                                                {{ $category->slug }}
                                            </p>
                                            <!-- Descripción de la categoría -->
                                            <p
                                                class="block antialiased text-ellipsis overflow-hidden font-sans text-sm leading-normal text-blue-gray-900">
                                                {{ $category->description }} <span class="truncate">...</span>
                                            </p>

                                            <!-- Etiqueta del padre o indicación de ser padre -->
                                            <!-- Etiqueta del padre o indicación de ser padre -->
                                            <p class="block antialiased text-sm">
                                                @if ($category->parentCategory)
                                                    <span class="bg-blue-500 text-white px-2 py-1 rounded-full">
                                                        {{ $category->parentCategory->name }}
                                                    </span>
                                                @else
                                                    <span class="bg-black text-white px-2 py-1 rounded-full">
                                                        Padre
                                                    </span>
                                                @endif
                                            </p>


                                            <!-- Botones de acción -->
                                            <div class="space-x-4 flex items-center">
                                                <a href="{{ route('admin.categories.create', ['id' => $category->id]) }}"
                                                    class="block px-2 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg hover:bg-blue-600 transition-all duration-300 ease-in-out transform hover:scale-105 shadow">
                                                    Crear Subcategoría
                                                </a>
                                                <a href="{{ route('admin.categories.edit', $category) }}">
                                                    <button
                                                        class="text-gray-800 hover:text-blue-600 bg-white hover:bg-slate-100 border border-slate-200 rounded-lg px-3 py-1.5 flex items-center transition-all duration-200 ease-in-out shadow">
                                                        <span class="mr-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                            </svg>
                                                        </span>
                                                        Editar
                                                    </button>
                                                </a>
                                                <button
                                                    class="text-gray-800 hover:text-red-600 bg-white hover:bg-slate-100 border border-slate-200 rounded-lg px-3 py-1.5 flex items-center transition-all duration-200 ease-in-out shadow"
                                                    data-modal-target="default-modal-{{ $category->id }}"
                                                    data-modal-toggle="default-modal-{{ $category->id }}">
                                                    <span class="mr-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </span>
                                                    Eliminar
                                                </button>
                                            </div>
                                        </summary>

                                        <div class="border-t border-gray-300 my-2"></div>

                                        <!-- Detalles de Subcategorías -->
                                        @if ($category->children->isNotEmpty())
                                            <details class="ml-6">
                                                <summary
                                                    class="font-medium text-gray-800 hover:text-gray-900 cursor-pointer mb-2">
                                                    Subcategorías
                                                </summary>
                                                <div class="pl-6">
                                                    @foreach ($category->children as $childCategory)
                                                        <div class="p-2 border-b border-blue-gray-200">
                                                            <p class="font-medium text-gray-700">
                                                                {{ $childCategory->name }}
                                                            </p>
                                                            <p class="text-sm text-gray-600">
                                                                Slug: {{ $childCategory->slug }}
                                                            </p>
                                                            <p class="text-sm text-gray-600">
                                                                Descripción: {{ $childCategory->description }}
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </details>
                                        @else
                                            <p class="text-sm text-gray-500 ml-6">
                                                No tiene categoría hija.
                                            </p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center p-4">
                                    No tienes categorías almacenadas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>





                </table>
            </div>
        </div>
    </div>
@endsection
