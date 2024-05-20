@extends('layouts.admin')
@section('content')
<div class=" p-6">

    <div class="grid grid-cols-2 lg:grid-cols-4 md:grid-cols-3 col-span-2 h-5/6 gap-6 mt-16">
        <div class="p-2 bg-white rounded-xl ">
            <p class="font-blinker font-medium text-md text-center p-4">
                <span class="font-bold text-4xl">
                    2
                </span>
                <br>
                Promociones Activas
            </p>
        </div>
        <div class="p-2 bg-white rounded-xl ">
            <p class="font-blinker font-medium text-md text-center p-4">
                <span class="font-bold text-4xl">
                    32
                </span>
                <br>
                Productos En oferta
            </p>
        </div>
        <div class="p-2 bg-white rounded-xl ">
            <p class="font-blinker font-medium text-md text-center p-4">
                <span class="font-bold text-4xl">
                    36
                </span>
                <br>
                Ventas Nuevas
            </p>
        </div>
        <div class="p-2 bg-white rounded-xl ">
            <p class="font-blinker font-medium text-md text-center p-4">
                <span class="font-bold text-4xl">
                    $36.000
                </span>
                <br>
                Ingreso
            </p>
        </div>
    </div>

    <div class="p-6 mt-6 bg-white rounded-xl overflow-scroll">

        <div class="md:flex">
            <div class="">
                <button class="bg-blue-700 rounded-md p-2">
                    <a class="text-white" href="/shop">
                        Hacer Campaña de Promocion
                    </a>
                </button>
            </div>

            <div class="mx-auto">
                <h2 class="text-2xl mr-12 font-josefin font-bold">
                    Stock Actual
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
                            Promocion Nro/Fecha
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
                            Descuento
                        </p>
                    </th>
                    <th
                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                        <p
                            class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                            Fecha de Fin
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
            @foreach ($orders as $order) --}}
                <tr>
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="flex flex-col">
                                <p
                                    class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                    #222</p>
                                <p
                                    class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal opacity-70">
                                    21/2/89</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="flex flex-col">
                                <p
                                    class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                    39</p>
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
                            <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                50%</p>
                        </div>
                    </td>
                    <td class="p-4 border-b border-blue-gray-50">
                        <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                            23/04/18</p>
                    </td>
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="w-max">
                            <div class="relative grid items-center font-sans font-bold uppercase whitespace-nowrap select-none bg-green-500/20 text-green-600 py-1 px-2 text-xs rounded-md"
                                style="opacity: 1;">
                                <span class="">Activa</span>
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