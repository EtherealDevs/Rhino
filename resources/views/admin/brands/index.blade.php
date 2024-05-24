@extends('layouts.admin')
@section('content')
<div class=" p-6">
    <div class="p-6 mt-24 bg-white rounded-xl overflow-scroll">

        <div class="flex justify-between w-full mb-5">
            <div class="justify-start">
                <h2 class="font-josefin font-bold italic text-2xl">
                    Marcas
                </h2>
            </div>

            <div class="justify-end">
                <button class="bg-blue-500 rounded-xl p-2 px-4">
                    <a class="text-white font-bold" href={{ route('admin.brands.create') }}>Nueva Marca</a>
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
                            Nombre
                        </p>
                    </th>
                    <th
                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                        <p
                            class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                            Descripcion
                        </p>
                    </th>
                </tr>
            </thead>
            <tbody>
               {{--  @php
                $total=0;
            @endphp  --}}
            @foreach ($brands as $brand)
                <tr>
                    
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex flex-col">
                            <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                {{ $brand->name}}
                            </p>
                        </div>
                    </td>
                    <td class="p-4 border-b border-blue-gray-50">
                        <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                            {{ $brand->description}}
                        </p>
                    </td>
                    <td class="p-4">
                        <button class="relative align-middle font-sans font-medium w-7 h-10 rounded-lg text-xs "
                            type="button">
                            <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                <p class="flex">
                                    Ver Mas
                                </p>

                            </span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
