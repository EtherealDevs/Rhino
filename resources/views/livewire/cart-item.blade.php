
<li class="py-3 mb-2 mt-6 sm:py-4 bg-white rounded-lg shadow-md">
    <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
        <div class="flex-shrink-0 mx-auto sm:mx-0 sm:flex sm:justify-center">
            <img class="w-14 h-14 rounded-full" src="/storage/images/product/{{ $cartItem->images[0]->url }}"
                alt="Product image">
        </div>
        <div class="flex-1 sm:flex sm:justify-between sm:items-center w-full sm:text-center">
            <div class="sm:w-1/3 flex flex-col sm:items-center">
                <p
                    class="text-3xl flex left-1/2 justify-center sm:text-2xl font-josefin font-bold text-gray-900 truncate">
                    {{ $cartItem->product->name }}
                </p>
                <div class="flex gap-2 mt-2 justify-center">
                    @if ($discount)
                        <div class="flex justify-center bg-[#df2929] text-white text-sm font-bold rounded-xl px-2 py-1">
                            <p>{{ number_format($discount, 0, ',', '.') }}%</p>
                        </div>
                    @endif
                    <div class="flex justify-center bg-[#26ca60] text-white text-sm font-bold rounded-xl px-2 py-1">
                        <p>${{ number_format($price / 100, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                <p class="font-josefin font-bold text-gray-900">Talle</p>
                <p class="font-josefin font-bold">{{ $size }}</p>
            </div>
            <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                <p class="font-josefin font-bold text-gray-900">Cantidad</p>
                <p class="font-josefin font-bold">
                    <form method="POST" action="{{route('cart.updateItem', ['cartItemId' => $cartItemId])}}" class="inline">
                        @csrf
                        @method('post')
                        <input value="subtract" type="hidden" name="mode">
                        <button type="submit">
                            -
                        </button>
                    </form> {{ $quantity }} <form method="POST" action="{{route('cart.updateItem', ['cartItemId' => $cartItemId])}}" class="inline">
                        @csrf
                        @method('post')
                        <input value="add" type="hidden" name="mode">
                        <button type="submit">
                            +
                        </button>
                    </form></p>
            </div>
            <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
                <p class="font-josefin font-bold text-gray-900">Total</p>
                <p class="text-base font-semibold text-green-500">
                    ${{ number_format(($total * $quantity) / 100, 2, ',', '.') }}</p>
            </div>
            <form method="POST" action="{{ route('cart.removeItem', ['cartItemId' => $cartItemId]) }}"
                class="mt-4 sm:mt-0 sm:w-auto text-center">
                @csrf
                @method('delete')
                <input value="{{ $size }}" type="hidden" name="size">
                <button type="submit" class="text-3xl text-gray-400 font-encode font-extrabold hover:text-red-500">
                    x
                </button>
            </form>
        </div>
    </div>
    <div class="flex-1 sm:ml-4 mt-4 sm:mt-0 w-full flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div class="sm:w-1/3 text-center sm:text-left">
            <p class="text-xl font-bold text-gray-900 truncate">{{ $item['item']->product->name }}</p>
            <div class="flex items-center justify-center sm:justify-start mt-2 gap-2">
                @if ($discount)
                    <span class="bg-red-500 text-white text-sm font-bold rounded-full px-3 py-1">
                        -{{ number_format($discount, 0, ',', '.') }}%
                    </span>
                @endif
                <span class="bg-green-500 text-white text-sm font-bold rounded-full px-3 py-1">
                    ${{ number_format($price, 2, ',', '.') }}
                </span>
            </div>
        </div>
        <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
            <p class="font-semibold text-gray-600">Talle</p>
            <p class="font-bold text-gray-900">{{ $item['size'] }}</p>
        </div>
        <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
            <p class="font-semibold text-gray-600">Cantidad</p>
            <p class="font-bold text-gray-900">{{ $item['amount'] }}</p>
        </div>
        <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
            <p class="font-semibold text-gray-600">Total</p>
            <p class="text-lg font-bold text-green-500">
                ${{ number_format($total * $item['amount'], 2, ',', '.') }}
            </p>
        </div>
        <form method="POST" action="{{ route('cart.removeItem', ['item' => $item['id']]) }}"
            class="mt-4 sm:mt-0">
            @csrf
            @method('delete')
            <input value="{{ $item['size'] }}" type="hidden" name="size">
            <button type="submit" class="text-gray-400 hover:text-red-500 text-xl font-bold">
                &times;
            </button>
        </form>
    </div>
</li>