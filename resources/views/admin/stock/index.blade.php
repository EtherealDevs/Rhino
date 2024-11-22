@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="p-6 mt-16 bg-white rounded-xl overflow-scroll">
            <div class="md:flex">
                <div class="">
                    <button class="bg-blue-700 rounded-md p-2">
                        <a class="text-white" href="{{ route('admin.products.create') }}">Agregar Producto</a>
                    </button>
                </div>
                <div class="mx-auto">
                    <h2 class="text-2xl mr-12 font-josefin font-bold">Stock Actual</h2>
                </div>
            </div>

            <table class="mt-6 w-full min-w-max table-auto text-left">
                <thead>
                    <tr>
                        <th
                            class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                            <p
                                class="antialiased ml-4 font-sans text-sm text-blue-gray-900 flex items-center justify-start gap-2 font-normal leading-none opacity-70">
                                Producto</p>
                        </th>
                        <th
                            class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                            <p
                                class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-start gap-2 font-normal leading-none opacity-70">
                                Cantidad</p>
                        </th>
                        <th
                            class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                            <p
                                class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-start gap-2 font-normal leading-none opacity-70">
                                Estado</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @php $stock = 0; @endphp
                        <tr class="lg:w-8/12 w-full mx-auto items-center">
                            <td class="w-1/2">
                                <div style="width: 30em" class="ml-5">
                                    <div id="mainHeading" class="flex justify-between items-center w-full mt-4">
                                        <button aria-label="toggler" data-menu
                                            class="w-full flex py-2 px-4 text-gray-700 rounded-md hover:bg-gray-50 transition-colors duration-200">
                                            <span
                                                class="font-bold text-md lg:text-md text-slate-800">{{ $product->name }}</span>
                                            <svg :class="{ 'rotate-180': open === 1 }"
                                                class="ml-2 flex justify-end h-4 w-4 transition-transform duration-300 text-blue-500"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <div id="stock-modal" tabindex="-1" aria-hidden="true"
                                        class="hidden fixed z-50 justify-center backdrop-blur-md items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <!-- Modal content -->
                                        <div
                                            class="absolute max-h-full overflow-y-auto overflow-x-hidden left-1/4 top-12 bg-white h-[650px] w-[750px] rounded-lg shadow ">
                                            <!-- Modal header -->
                                            <div class="sticky top-0 z-10 bg-white border-b rounded-t">
                                                <div class="flex items-center justify-between p-4 md:p-5">
                                                    <h3 class="text-lg font-semibold font-josefin italic text-black">
                                                        Stock
                                                        de {{ $product->name }}</h3>
                                                    <button type="button"
                                                        class="text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                        onclick="toggleModal('stock-modal')">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Cerrar modal</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- Modal body -->


                                            <table class="w-full text-sm text-left text-gray-500">
                                                <thead
                                                    class="text-xs sticky top-20 z-40 text-gray-700 uppercase bg-gray-50">
                                                    <tr>
                                                        <th scope="col" class="py-3 px-6">Talle</th>
                                                        <th scope="col" class="py-3 px-6">Color</th>
                                                        <th scope="col" class="py-3 px-6">Cantidad</th>
                                                        <th scope="col" class="py-3 px-6">Habilitado</th>
                                                        <th scope="col" class="py-3 px-6">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product->items as $item)
                                                        @foreach ($item->sizes as $size)
                                                            <tr class="bg-white border-b">
                                                                <form action="{{ route('admin.stock.store') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <td class="py-4 px-6">{{ $size->name }}</td>
                                                                    <input type="hidden" name="size_id"
                                                                        value="{{ $size->id }}">
                                                                    <td class="py-4 px-6">{{ $item->color->name }}
                                                                        <span
                                                                            class="block border-4 border-[{{ $item->color->color }}]">
                                                                    </td>
                                                                    <input type="hidden" name="product_id"
                                                                        value="{{ $item->id }}">
                                                                    <td class="py-4 px-6">
                                                                        <input
                                                                            id="input-{{ $product->id }}-{{ $item->id }}-{{ $size->id }}"
                                                                            type="number" name="stock"
                                                                            class="w-16 h-8 text-sm border-none"
                                                                            placeholder="{{ $size->pivot->stock }}"
                                                                            value="{{ old('stock', $size->pivot->stock) }}"
                                                                            disabled />
                                                                    </td>
                                                                    <td class="py-4 px-6">
                                                                        {{ $size->pivot->deleted_at instanceof \Illuminate\Support\Carbon ? 'No' : 'Si' }}
                                                                    </td>
                                                                    @php $stock += $size->pivot->stock; @endphp
                                                                    <td class="flex justify-center items-center mt-3">
                                                                        <button type="button"
                                                                            id="button-{{ $product->id }}-{{ $item->id }}-{{ $size->id }}"
                                                                            class="py-2 px-4 bg-gray-50 text-gray-600 font-semibold rounded-lg shadow-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out"
                                                                            onclick="edit('{{ $product->id }}-{{ $item->id }}-{{ $size->id }}')"><svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke-width="1.5" stroke="currentColor"
                                                                                class="w-4 h-4">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                            </svg>
                                                                        </button>
                                                                        <button type="submit"
                                                                            id="submit-{{ $product->id }}-{{ $item->id }}-{{ $size->id }}"
                                                                            class="hidden py-2 px-4 bg-gray-50 text-gray-600 font-semibold rounded-lg shadow-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out text-xl"><svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="1em" height="1em"
                                                                                viewBox="0 0 24 24">
                                                                                <path fill="currentColor"
                                                                                    d="m20.71 9.29l-6-6a1 1 0 0 0-.32-.21A1.1 1.1 0 0 0 14 3H6a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3v-8a1 1 0 0 0-.29-.71M9 5h4v2H9Zm6 14H9v-3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1Zm4-1a1 1 0 0 1-1 1h-1v-3a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3v3H6a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V6.41l4 4Z" />
                                                                            </svg>
                                                                        </button>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mt-4">
                                    <span
                                        class="lg:mr-6 mr-4 lg:text-xl md:text-xl text-lg leading-6 md:leading-5 lg:leading-4 font-semibold text-gray-800">{{ $stock }}</span>
                                </p>
                            </td>
                            <td>
                                <div
                                    class="{{ $stock == 0 ? 'bg-gray-300' : 'bg-green-200' }} rounded-lg w-1/2 flex justify-center">
                                    <p
                                        class="{{ $stock == 0 ? 'text-gray-500' : 'text-green-800' }} uppercase justify-center my-1 mx-0 font-josefin font-bold text-sm">
                                        {{ $stock == 0 ? 'Inactivo' : 'Activo' }}</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <hr class="my-4 border-t-1 border-gray-100">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function edit(e) {
            let input = document.getElementById('input-' + e);
            let button = document.getElementById('button-' + e);
            let submit = document.getElementById('submit-' + e);
            input.disabled = false;
            input.classList.remove('border-none');
            input.classList.add('border');
            button.classList.add('hidden');
            submit.classList.remove('hidden');
        }

        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }
        let elements = document.querySelectorAll("[data-menu]");
        elements.forEach(element => {
            element.addEventListener("click", function() {
                let parent = element.closest('div[style="width: 30em"]'); // Adjust the selector as needed
                toggleModal(
                    'stock-modal'); // You might want to pass a specific modal ID if you have multiple
            });
        });
    </script>
@endsection
