@extends('layouts.admin')
@section('content')
<div class=" p-6">
    <div class="p-6 mt-24 bg-white rounded-xl overflow-scroll">

        <div class="flex justify-between w-full mb-5">
            <div class="justify-start">
                <h2 class="font-josefin font-bold italic text-2xl">
                    Promociones
            </div>

            <div class="justify-end">
                <button class="bg-blue-500 rounded-xl p-2 px-4">
                    <a class="text-white font-bold" href={{ route('admin.sales.create') }}>Cargar Promocion</a>
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
                            Pedido Nro/Fecha
                        </p>
                    </th>
                    <th
                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                        <p
                            class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                           Usuario
                        </p>
                    </th>
                    <th
                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                        <p
                            class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                            Total
                        </p>
                    </th>
                    <th
                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                        <p
                            class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                            Fecha de entrega
                        </p>
                    </th>
                    <th
                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                        <p
                            class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                            Estado
                        </p>
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($sales as $sale )
            <tr>
                <td class="p-4 border-b border-blue-gray-50">
                    <div class="flex items-center gap-3">
                        <div class="flex flex-col">
                            <p
                            class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                            #{{$sale->id}}</p>
                            <p
                            class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal opacity-70">
                            fecha</p>
                            </div>
                            </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="flex flex-col">
                                <p
                                class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                {{$sale->title}} </p>
                                <p
                                class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal opacity-70">
                                Cantidad</p>
                                </div>
                                </div>
                    </td>
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex flex-col">
                            <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                {{$sale->start_date}}</p>
                                </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                        {{$sale->end_date}}</p>
                                        </td>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            <div class="w-max">
                                                <div class="relative grid items-center font-sans font-bold uppercase whitespace-nowrap select-none bg-green-500/20 text-green-600 py-1 px-2 text-xs rounded-md"
                                                style="opacity: 1;">
                                                <span class="">Completed</span>
                                                </div>
                                                </div>
                                                </td>
                    <td class="p-4">
                        <form action={{ route('admin.sales.destroy', $sale) }} method="post">
                        @csrf
                        @method('DELETE')
                        <button class="relative align-middle font-sans font-medium w-7 h-10 rounded-lg text-xs "
                            type="submit">
                            <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                <p class="flex">
                                    Delete
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

                                    @endsection
