
<li class="py-4 px-4 mb-3 bg-white rounded-lg shadow-lg flex flex-col sm:flex-row sm:items-center">
    <div class="flex-shrink-0 mx-auto sm:mx-0">
        <img class="h-14 w-14 rounded-full border-2 border-white object-cover shadow hover:shadow-xl"
            src="/storage/images/product/{{ $cartItem->images[0]->url }}" alt="Product image">
    </div>
    <div class="flex-1 sm:ml-4 mt-4 sm:mt-0 w-full flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div class="sm:w-1/3 text-center sm:text-left">
            <p class="text-xl font-bold text-gray-900 truncate">{{ $cartItem->product->name }}</p>
            <div class="flex items-center justify-center sm:justify-start mt-2 gap-2">
                @if ($discount)
                    <span class="bg-red-500 text-white text-sm font-bold rounded-full px-3 py-1">
                        -{{ number_format($discount, 0, ',', '.') }}%
                    </span>
                @endif
                <span class="bg-green-500 text-white text-sm font-bold rounded-full px-3 py-1">
                    ${{ number_format($price / 100, 2, ',', '.') }}
                </span>
            </div>
        </div>
        <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
            <p class="font-semibold text-gray-600">Talle</p>
            <p class="font-bold text-gray-900">{{ $size }}</p>
        </div>
        <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
            <p class="font-semibold text-gray-600">Cantidad</p>
            <p class="font-bold text-gray-900"><form method="POST" action="{{route('cart.updateItem', ['cartItemId' => $cartItemId])}}" class="inline">
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
            <p class="font-semibold text-gray-600">Total</p>
            <p class="text-lg font-bold text-green-500">
                ${{ number_format($total / 100, 2, ',', '.') }}
            </p>
        </div>
        <form method="POST" action="{{ route('cart.removeItem', ['cartItemId' => $cartItemId]) }}"
            class="mt-4 sm:mt-0">
            @csrf
            @method('delete')
            <input value="{{ $size }}" type="hidden" name="size">
            <button type="submit" class="text-gray-400 hover:text-red-500 text-xl font-bold">
                &times;
            </button>
        </form>
    </div>
</li>