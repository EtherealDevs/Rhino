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
                            <th
                                class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p
                                    class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                                    Subcategoria
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php
                            $total=0;
                        @endphp --}}
                        @foreach ($categories as $category)
                            <tr>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="flex flex-col">
                                            <p
                                                class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                                {{ $category->name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="flex flex-col">
                                            <p
                                                class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                                {{ $category->slug }}
                                            </p>
                                        </div>
                                        {{-- @php
                                        $subtotal=$orderDetail->price * $orderDetail->amount;
                                        $total=$total+$subtotal;
                                    @endphp
                                    @endforeach --}}
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex flex-col">
                                        <p
                                            class="block antialiased text-ellipsis overflow-hidden font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                            {{ $category->description }} <span class="truncate">...</span>
                                        </p>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="w-max">
                                        <div class="relative grid items-center font-sans font-bold uppercase whitespace-nowrap select-none bg-green-500/20 text-green-600 py-1 px-2 text-xs rounded-md"
                                            style="opacity: 1;">
                                            <span class="">Entregado</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <button class="relative align-middle font-sans font-medium h-10 rounded-lg text-xs "
                                        type="button">
                                        <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                            <a href={{ route('admin.categories.edit', $category) }} class="">
                                                Ver Mas
                                            </a>
                                        </span>
                                    </button>
                                </td>
                                <td class="p-4">
                                    <form action={{ route('admin.categories.destroy', $category) }} method="post">
                                        @csrf
                                        @method('delete');
                                        <button type="submit" onclick="return confirm('Se eliminara')"
                                            class="relative align-middle font-sans font-medium w-7 h-10 rounded-lg text-xs"
                                            type="button">
                                            <span
                                                class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                                <p class="bg-red-400 p-2 px-4 rounded-xl flex font-bold text-white">
                                                    Eliminar
                                                </p>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
