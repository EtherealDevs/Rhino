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
        <td class="p-4 border-b border-blue-gray-50">
            <div class="flex flex-col">
                <p class="block antialiased font-sans text-sm leading-normal text-green-500 font-normal">
                    ${{ $productItem->price() }}</p>
            </div>
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
                <a href="{{ route('admin.productitems.edit', $productSize->id, $size) }}">
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
                    data-modal-target="default-modal-{{ $productItem->id }}"
                    data-modal-toggle="default-modal-{{ $productItem->id }}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </span>
                </button>
                @include('admin.components.delete-modal', [
                    'item' => $productItem,
                    'route' => 'admin.products.destroy',
                    'name' => 'productos',
                ])
            </div>
        </td>
        </td>
    </tr>
</div>
