@extends('layouts.admin')

@section('content')
    <div class="p-6 pt-20">
        <!-- component -->
        <div class="p-6 bg-white rounded-xl overflow-scroll">

            <div class="flex justify-between w-full mb-5">
                <div class="justify-start">
                    <h2 class="font-josefin font-bold italic text-2xl">
                        Pedidos
                    </h2>
                </div>

                <div class="justify-end">
                    <button class="bg-blue-500 rounded-xl p-2 px-4">
                        <a class="text-white font-bold" href={{ route('admin.orders.create') }}>Nuevo Pedido</a>
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
                        <th
                            class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                            <p
                                class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">
                                Acción
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                            #{{ $order->id }}
                                        </p>
                                        <p
                                            class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal opacity-70">
                                            {{ $order->created_at->format('d-m-Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                            {{ $order->user->name }}
                                        </p>
                                        <p
                                            class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal opacity-70">
                                            {{ $order->user->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex flex-col">
                                    @foreach ($order->details as $detail)
                                        <p
                                            class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                            {{ $detail->productItem()->name }} - {{ $detail->amount }} x {{ number_format($detail->price / 100, 2, ',', '.') }}
                                        </p>
                                    @endforeach
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p class="block font-josefin text-lg leading-normal text-green-600 font-semibold">
                                    <span class="font-bold text-green-700">$ </span>{{ number_format($order->total / 100, 2, ',', '.') }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="relative">
                                        <select name="order_status_id"
                                            class="form-select mt-1 block w-full p-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700">
                                            @foreach ($orderStatuses as $status)
                                                <option value="{{ $status->id }}"
                                                    {{ $status->id == $order->order_status_id ? 'selected' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit"
                                            class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-blue-500 text-white rounded-lg px-3 py-1 text-xs font-semibold shadow hover:bg-blue-600 transition">
                                            Actualizar
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td class="p-4">
                                <button class="relative align-middle font-sans font-medium w-7 h-10 rounded-lg text-xs"
                                    type="button">
                                    <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                            class="text-blue-600 hover:underline">
                                            Ver detalles
                                        </a>
                                    </span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center">
                                <p
                                    class="block antialiased py-12 font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                    No hay pedidos disponibles
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
@endsection
