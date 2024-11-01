<div>
    <tr>
        <td class="p-4 border-b border-blue-gray-50">
            <div class="flex items-center gap-3">
                <div class="flex flex-col">
                    <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                        {{ $product->name }}</p>
                    <p
                        class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal opacity-70">
                        {{ $productItem->created_at->format('d-m-Y') }}</p>
                </div>
            </div>
        </td>
        <td class="p-4 border-b border-blue-gray-50">
            <div class="flex items-center gap-3">
                <div class="flex flex-col">
                    <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                        {{ $productItem->color->name }}</p>
                    <span class="block border-4 border-[{{ $productItem->color->color }}]">
                    </span>
                </div>
            </div>
        </td>
        <td class="p-4 relative grid grid-rows-3 gap-2 border-t border-gray-200">
            @if ($product->sale)
                {{-- Mostrar el porcentaje de descuento de manera más sutil --}}
                <div class="row-span-1 border-b border-green-300 text-gray-600 text-md font-medium font-josefin rounded-lg px-2 py-1">
                    {{ $product->sale->sale->discount }}% de descuento
                </div>

                {{-- Mostrar los precios en filas separadas --}}
                <div class="row-span-1 flex justify-start items-center text-sm font-josefin px-2 py-1">
                    <span class="text-green-500 font-semibold">
                        ${{ number_format($productItem->price() / 100, 2, ',', '.') }}
                    </span>
                    <span class="mx-2">-</span>
                    <span class="text-gray-400 font-medium line-through">
                        ${{ number_format($productItem->original_price / 100, 2, ',', '.') }}
                    </span>
                </div>
            @else
                {{-- Precio sin descuento, centrado y estilizado de forma minimalista --}}
                <div class="col-span-3 flex flex-col">
                    <p class="block font-sans text-sm leading-normal text-green-500 font-normal">
                        ${{ number_format($productItem->price() / 100, 2, ',', '.') }}
                    </p>
                </div>
            @endif
        </td>






        <td class="p-4 border-b border-blue-gray-50">
            <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                {{ $size->name }}
            </p>
        </td>
        <td class="p-4 border-b border-blue-gray-50">
            <div class="w-max">
                <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                    {{ $stock }}</p>

                @if ($stock == 0)
                    <div class="relative grid items-center font-sans font-bold uppercase whitespace-nowrap select-none bg-red-500/20 text-red-600 py-1 px-2 text-xs rounded-md"
                        style="opacity: 1;">
                        <span class="">Sin Stock</span>
                    </div>
                @elseif($stock <= 6)
                    <div class="relative grid items-center font-sans font-bold uppercase whitespace-nowrap select-none bg-yellow-500/20 text-yellow-600 py-1 px-2 text-xs rounded-md"
                        style="opacity: 1;">
                        <span class="">Con poco Stock</span>
                    </div>
                @else
                    <div class="relative grid items-center font-sans font-bold uppercase whitespace-nowrap select-none bg-green-500/20 text-green-600 py-1 px-2 text-xs rounded-md"
                        style="opacity: 1;">
                        <span class="">En Stock</span>
                    </div>
                @endif
            </div>

        </td>
        <td class="p-4">
        <td class="p-4 border-b border-blue-gray-50">
            <div class="inline-flex items-center rounded-md shadow-sm">
                <a href="{{ route('admin.productitems.edit', $productSize->id) }}">
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
                    data-modal-target="default-modal-{{ $productSize->id }}"
                    data-modal-toggle="default-modal-{{ $productSize->id }}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </span>
                </button>

                <form action={{ route('admin.productitems.destroy', $productSize->id) }} method="POST">
                    <div id="default-modal-{{ $productSize->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
                        id="modal-id">
                        <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
                        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                            <!--content-->
                            <div class="">
                                <!--body-->
                                <div class="text-center p-5 flex-auto justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <h2 class="text-xl font-bold py-4 ">¿ESTA SEGURO?</h3>
                                        <p class="text-sm text-gray-500 px-8">¿De verdad quiere borrar producto
                                            id:{{ $productSize->id }}?
                                            Este proceso no tiene retorno</p>
                                </div>
                                <!--footer-->
                                <div class="p-3  mt-2 text-center space-x-4 md:block">
                                    <button data-modal-hide="default-modal-{{ $productSize->id }}" type="button"
                                        class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                                        Cancelar
                                    </button>

                                    @csrf
                                    @method('DELETE')
                                    <button data-modal-hide="default-modal-{{ $productSize->id }}" type="submit"
                                        class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Eliminar</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </td>
        </td>
    </tr>
</div>
