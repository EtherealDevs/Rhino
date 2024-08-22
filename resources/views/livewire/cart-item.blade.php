<li class="py-3 mb-2 mt-6 sm:py-4 bg-white rounded-lg shadow-md">
    <div class="flex items-center space-x-4">
        <div class="grid grid-cols-7 gap-12">
            <div class="flex-shrink-0 ml-5">
                <img class="w-14 h-14 rounded-full ml-2" src="/storage/images/product/{{ $images[0]->url }}"
                    alt="Product Image">
            </div>
            <div class="flex-1 grid-rows-2 col-span-2">
                <p class="text-2xl font-josefin font-bold text-gray-900 truncate ">
                    {{ $product->name }}
                </p>
                <div class="flex gap-2 mt-2 justify-center">
                    @if ($discount)
                        <div class="flex justify-center bg-[#df2929] text-white text-sm font-bold rounded-xl px-2 py-1">
                            <p>{{number_format($discount, 0, ',', '.')}}%</p>
                        </div>
                    @endif
                    <div class="flex justify-center bg-[#26ca60] text-white text-sm font-bold rounded-xl px-2 py-1">
                        <p>${{number_format($price, 2, ',', '.')}}</p>
                    </div>
                </div>
            </div>
            <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                <p class="font-josefin font-bold text-gray-900">Talle</p>
                <p class="font-josefin font-bold">{{ $item['size'] }}</p>
            </div>
            <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                <p class="font-josefin font-bold text-gray-900">Cantidad</p>
                <p class="font-josefin font-bold">{{ $item['amount'] }}</p>
            </div>
            <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                <p class="font-josefin font-bold text-gray-900">Total</p>
                <p class="text-base font-semibold text-green-500">
                    ${{ number_format($total * $item['amount'], 2, ',', '.') }}</p>
            </div>
            <form method="POST" action="{{ route('cart.removeItem', ['item' => $item['id']]) }}" class="mt-4 sm:mt-0 sm:w-auto text-center">
                @csrf
                @method('delete')
                <input value="{{ $item['size'] }}" type="hidden" name="size">
                <button type="submit" class="text-3xl text-gray-400 font-encode font-extrabold hover:text-red-500">
                    x
                </button>
            </form>
        </div>
    </div>
</li>
