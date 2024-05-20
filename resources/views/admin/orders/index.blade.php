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
                <h2 class="text-2xl mr-12 font-bold">
                    Pedidos
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

    <div
                        class="mb-3 mt-24 flex transform cursor-pointer flex-col justify-between rounded-md bg-white bg-opacity-75 p-6 text-slate-800 transition duration-500 ease-in-out hover:-translate-y-1 hover:shadow-lg dark:bg-white dark:bg-opacity-25 dark:text-slate-300 lg:flex-row lg:p-4">
                        <div class="flex w-full flex-row lg:w-3/12">
                            <div class="relative flex flex-col">
                                <div
                                    class="flex h-12 w-12 flex-shrink-0 flex-col justify-center rounded-full bg-slate-200 bg-opacity-50 dark:bg-slate-600">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&w=128&h=128&q=60&facepad=1.5"
                                        class="z-10 h-12 w-12 rounded-full object-cover shadow hover:shadow-xl"
                                        alt="Rocky Balboa" />
                                    <span class="absolute right-0 top-0 z-20 flex h-3 w-3">
                                        <span
                                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex h-3 w-3 rounded-full bg-green-500"></span>
                                    </span>
                                </div>
                            </div>

                            <div class="w-full self-center pt-4 lg:w-1/6 lg:pt-0">
                                <div class="ml-1">
                                    <div class="text-xl font-extrabold leading-5 tracking-tight">
                                        <span class="align-middle">$1,234.56</span>
                                        <span
                                            class="text-[8px] ml-2 rounded bg-green-600 px-2 py-1 align-middle font-bold uppercase text-white">Paid</span>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="ml-4 self-center overflow-x-hidden">
                                <div class="w-full text-gray-700 truncate text-xl font-extrabold leading-5 tracking-tight">
                                    Rocky
                                    Balboa</div>
                                <div class="text-sm text-gray-700">Fayetteville, AR 72701</div>
                            </div>
                        </div>

                        <div class="z-50 hidden w-1/6 self-center lg:block">
                            <div class="flex flex-row justify-center">
                                <div x-data="{ tooltip: false }"
                                    class="relative z-0 -mr-4 inline-flex transition duration-300 ease-in-out hover:-mr-1"
                                    x-cloak>
                                    <img @mouseover="tooltip = true" @mouseleave="tooltip = false"
                                        class="z-10 h-9 w-9 rounded-full border-2 border-white object-cover shadow hover:shadow-xl dark:border-slate-800"
                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&w=128&h=128&q=60&facepad=1.5"
                                        alt="Marilyn Monroe" />
                                    <span
                                        class="absolute bottom-0 right-0 z-20 h-3 w-3 rounded-full border-2 border-slate-200 bg-green-400 dark:border-slate-800"></span>
                                    <div class="relative z-50 overflow-visible pt-2" x-cloak x-show="tooltip"
                                        x-transition:enter="transition ease-out duration-150"
                                        x-transition:enter-start="transform opacity-0 translate-y-full"
                                        x-transition:enter-end="transform opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="transform opacity-100 translate-y-0"
                                        x-transition:leave-end="transform opacity-0 translate-y-full">
                                        <div
                                            class="absolute -right-1 z-50 mt-1 w-40 -translate-x-10 -translate-y-5 transform overflow-x-hidden rounded-lg bg-blue-200 p-2 text-center leading-tight text-white shadow-md dark:bg-slate-900">
                                            <div
                                                class="text-slate-700 dark:text-slate-200 text-center text-base font-extrabold">
                                                Marilyn
                                                Monroe</div>
                                            <div class="text-slate-500 text-xs uppercase">Primary</div>
                                        </div>
                                        <svg class="absolute right-2 z-50 h-6 w-6 -translate-x-4 translate-y-0 transform fill-current stroke-current text-blue-200 dark:text-slate-900"
                                            width="8" height="8">
                                            <rect x="9" y="-8" width="8" height="8" transform="rotate(45)"></rect>
                                        </svg>
                                    </div>
                                </div>
                                <div x-data="{ tooltip: false }"
                                    class="relative z-0 -mr-4 inline-flex transition duration-300 ease-in-out" x-cloak>
                                    <img @mouseover="tooltip = true" @mouseleave="tooltip = false"
                                        class="z-10 h-9 w-9 rounded-full border-2 border-white object-cover shadow hover:shadow-xl dark:border-slate-800"
                                        src="https://images.unsplash.com/photo-1554151228-14d9def656e4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&w=128&h=128&q=60&facepad=1.5"
                                        alt="Salesperson" />
                                    <span
                                        class="absolute bottom-0 right-0 z-20 h-3 w-3 rounded-full border-2 border-slate-200 bg-green-400 dark:border-slate-800"></span>
                                    <div class="relative z-50 overflow-visible pt-2" x-cloak x-show="tooltip"
                                        x-transition:enter="transition ease-out duration-150"
                                        x-transition:enter-start="transform opacity-0 translate-y-full"
                                        x-transition:enter-end="transform opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="transform opacity-100 translate-y-0"
                                        x-transition:leave-end="transform opacity-0 translate-y-full">
                                        <div
                                            class="absolute -right-1 z-50 mt-1 w-40 -translate-x-10 -translate-y-5 transform overflow-x-hidden rounded-lg bg-blue-200 p-2 text-center leading-tight text-white shadow-md dark:bg-slate-900">
                                            <div
                                                class="text-slate-700 dark:text-slate-200 text-center text-base font-extrabold">
                                                Jimmy
                                                Stewart</div>
                                            <div class="text-slate-500 text-xs uppercase">Secondary</div>
                                        </div>
                                        <svg class="absolute right-2 z-50 h-6 w-6 -translate-x-4 translate-y-0 transform fill-current stroke-current text-blue-200 dark:text-slate-900"
                                            width="8" height="8">
                                            <rect x="9" y="-8" width="8" height="8" transform="rotate(45)"></rect>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full self-center pt-4 lg:w-1/6 lg:pt-0">
                            <div class="ml-1">
                                <div class="text-xl font-extrabold leading-5 tracking-tight">Oct 20, 2022</div>
                                <div class="text-sm text-slate-500">2 hours ago</div>
                            </div>
                        </div>

                        <div class="w-full self-center pt-4 lg:w-1/6 lg:pt-0">
                            <div class="ml-1">
                                <div class="text-xl font-extrabold leading-5 tracking-tight">
                                    <span class="align-middle">$1,234.56</span>
                                    <span
                                        class="text-[8px] ml-2 rounded bg-green-600 px-2 py-1 align-middle font-bold uppercase text-white">Paid</span>
                                </div>
                                <div class="text-sm text-slate-500">Total Paid</div>
                            </div>
                        </div>

                        <div class="w-full self-center px-1 pt-4 pb-2 lg:w-1/6 lg:px-0 lg:pt-0 lg:pb-0">
                            <div class="text-base font-bold leading-4 tracking-tight">This is great for short status
                                messages</div>
                            <div class="status-bars w-full pt-2">
                                <div class="flex flex-row lg:pr-6">
                                    <div class="max-w-6 h-1 w-1/5 rounded bg-green-500"></div>
                                    <div class="max-w-6 ml-1 h-1 w-1/5 rounded bg-amber-500"></div>
                                    <div
                                        class="max-w-6 ml-1 h-1 w-1/5 rounded bg-slate-400 bg-opacity-25 dark:bg-slate-600">
                                    </div>
                                    <div
                                        class="max-w-6 ml-1 h-1 w-1/5 rounded bg-slate-400 bg-opacity-25 dark:bg-slate-600">
                                    </div>
                                    <div
                                        class="max-w-6 ml-1 h-1 w-1/5 rounded bg-slate-400 bg-opacity-25 dark:bg-slate-600">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
@endsection
