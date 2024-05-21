@extends('layouts.admin')
@section('content')
<div class="p-6 pt-20">
    <!-- component -->
    <div class="p-6 bg-white rounded-xl overflow-scroll">

        <div class="md:flex">
            {{-- <div class="">
                <button class="bg-blue-700 rounded-md p-2">
                    <a class="text-white" href="/shop">
                        Hacer Nuevo Pedido
                    </a>
                </button>
            </div> --}}

            <div class="mx-auto">
                <h2 class="text-2xl mt-4 mb-2 font-bold">
                    Crear Combo
                </h2>
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
                            Productos
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
                            Estado
                        </p>
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- @php
                    $total=0;
                @endphp
                @foreach ($orders as $order ) --}}
                <tr>
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="flex flex-col">
                                <p
                                    class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                    #222</p>
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
                                    name</p>
                                <p
                                    class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal opacity-70">
                                    Cantidad</p>
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
                                class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                total</p>
                        </div>
                    </td>
                    <td class="p-4 border-b border-blue-gray-50">
                        <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                            total $$$</p>
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
            </tbody>
        </table>
    </div>

    
</div>
@endsection
