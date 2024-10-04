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
                                    Descripcion
                                </p>
                            </th>
                            <th colspan="3"
                                class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p
                                    class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-center gap-2 font-normal leading-none opacity-70">
                                    Acciones
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="flex flex-col">
                                            <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                                {{ $category->name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="flex flex-col">
                                            <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                                {{ $category->slug }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex flex-col">
                                        <p class="block antialiased text-ellipsis overflow-hidden font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                            {{ $category->description }} <span class="truncate">...</span>
                                        </p>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50 space-x-4 ">
                                        <a class="text-center" href={{route('admin.categories.create',['id'=>$category->id])}} >
                                            <span>crear</span>
                                            <span>subcategoria</span>
                                        </a>
                                    <div class="inline-flex items-center rounded-md shadow-sm">
                                        <a href="{{ route('admin.categories.edit', $category) }}">
                                            <button
                                                class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </a>
                                        <button
                                            class="text-slate-800 hover:text-red-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center"
                                            data-modal-target="default-modal-{{ $category->id }}"
                                            data-modal-toggle="default-modal-{{ $category->id }}">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </span>
                                        </button>
                                        @include('admin.components.delete-modal', [
                                            'item' => $category,
                                            'route' => 'admin.categories.destroy',
                                            'name' => 'category',
                                        ])
                                    </div>
                                </td>
                                {{-- <td class="p-4">
                                    <button class="relative align-middle font-sans font-medium h-10 rounded-lg text-xs" type="button">
                                        <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                            <a href= class="">
                                                Ver Mas
                                            </a>
                                        </span>
                                    </button>
                                </td>
                                <td class="p-4">
                                    <form action={{ route('admin.categories.destroy', $category) }} method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Se eliminara')" class="relative align-middle font-sans font-medium w-7 h-10 rounded-lg text-xs" type="button">
                                            <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                                <p class="bg-red-400 p-2 px-4 rounded-xl flex font-bold text-white">Eliminar</p>
                                            </span>
                                        </button>
                                    </form>
                                </td> --}}
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
