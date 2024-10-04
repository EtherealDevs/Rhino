<li class="py-4 px-4 mb-3 bg-white rounded-lg shadow-lg lg:flex flex-col grid grid-cols-2 sm:flex-row sm:items-center">
    <div class="flex-shrink-0 mx-auto sm:mx-0">
        <img class="h-24 lg:h-16 w-24 lg:w-16 rounded-full border-2 border-white object-cover shadow hover:shadow-xl"
            src="/storage/images/product/{{ $cartItem->images[0]->url }}" alt="Product image">
    </div>
    <div class="sm:w-1/3 text-center mt-4 ml-5 lg:mt-0 sm:text-left">
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
    <div
        class="flex-1 sm:ml-4 mt-4 sm:mt-0 w-full lg:flex flex-col col-span-2 grid grid-cols-2 sm:flex-row sm:justify-between sm:items-center">

        <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
            <p class="font-semibold text-gray-600">Talle</p>
            <p class="font-bold text-gray-900">{{ $size }}</p>
        </div>
        <div class="sm:w-1/6 text-center mt-4 sm:mt-0">
            <p class="font-semibold text-gray-600">Cantidad</p>
            <p class="font-bold text-gray-900">

                <div class="col-span-1 lg:col-span-1 flex flex-col items-center justify-center">
                    <div class="w-1/2 gap-4 flex">
                        <form method="POST" action="{{ route('cart.updateItem', ['cartItemId' => $cartItemId]) }}"
                            class="inline">
                            @csrf
                            @method('post')
                            <input value="subtract" type="hidden" name="mode">
                            <button type="submit">
                                -
                            </button>
                        </form>
                        <div class="text-xl font-extrabold text-green-500">

                            {{ $quantity }}

                        </div>
                        <form method="POST" action="{{ route('cart.updateItem', ['cartItemId' => $cartItemId]) }}"
                            class="inline">
                            @csrf
                            @method('post')
                            <input value="add" type="hidden" name="mode">
                            <button type="submit">
                                +
                            </button>
                        </form>
                    </div>

                </div>

            {{-- <form method="POST" action="{{ route('cart.updateItem', ['cartItemId' => $cartItemId]) }}" class="inline">
                @csrf
                @method('post')
                <input value="subtract" type="hidden" name="mode">
                <button type="submit">
                    -
                </button>
            </form>
            {{ $quantity }}
            <form method="POST"
                action="{{ route('cart.updateItem', ['cartItemId' => $cartItemId]) }}" class="inline">
                @csrf
                @method('post')
                <input value="add" type="hidden" name="mode">
                <button type="submit">
                    +
                </button>
            </form> --}}
            </p>
        </div>
        <div class="sm:w-1/6 text-center col-span-2 mt-4 sm:mt-0">
            <p class="font-semibold text-gray-600">Total</p>
            <p class="text-lg font-bold text-green-500">
                ${{ number_format($total / 100, 2, ',', '.') }}
            </p>
        </div>
        <div class="">
            <form method="POST" action="{{ route('cart.removeItem', ['cartItemId' => $cartItemId]) }}"
                class="mt-4 sm:mt-0">
                @csrf
                @method('delete')
                <input value="{{ $size }}" type="hidden" name="size">

                <button type="submit"
                    class="hidden lg:block text-gray-400 hover:text-red-500 text-3xl lg:text-2xl font-bold">
                    &times;
                </button>
            </form>
        </div>
    </div>
    <div class="col-span-2">
        <button type="submit" class="lg:hidden block w-full sm:w-auto bg-[#f84e4e] rounded-lg mt-2 sm:mt-0">
            <p class="font-josefin text-lg text-white font-bold py-1 px-4">Eliminar</p>
        </button>
    </div>
</li>
