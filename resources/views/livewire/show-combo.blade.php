<div>
    <div class="flex justify-center items-center mb-4 w-full px-4">
        <div
            class="relative z-10 flex justify-center w-44 lg:w-56 mt-1 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md transition-transform duration-300 hover:scale-105">
            <div class="relative mx-3 mt-3 h-42 overflow-hidden rounded-2xl bg-clip-border text-gray-700">
                <img src="{{ url(Storage::url($item->images->first()->url)) }}"
                    class="product-image h-full w-full object-cover" />
            </div>
            <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-3">

                <div class="flex flex-col items-center justify-center">
                    <p class="block font-sans font-bold text-base leading-5 text-white antialiased text-center">
                        {{ $product->name }}
                    </p>
                    <div class="text-sm text-slate-500">
                        <span class="product-attribute" data-attribute="color">
                            {{ $product->items->first()->color->name }} </span>
                    </div>
                    <div class="text-sm text-slate-500">
                        <select name="size" wire:model.change='size_id' id=""
                            class="block py-2.5 px-6 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option class="my-2 bg-black" value="">Select Size</option>
                            @foreach ($product->items->first()->sizes as $size)
                                <option class="my-2 bg-black" value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" class="hidden" name="sizes[]"
                        value=" {{ $size->id }}">
                    <a href="{{ route('products.show', ['product' => $product, 'productItem' => $productItem]) }}">
                        <p
                            class="block font-sans text-sm font-light leading-relaxed text-white antialiased text-center mt-2">
                            Ver Producto →
                        </p>

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
