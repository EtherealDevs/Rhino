<div>
<div class="flex justify-center items-center mb-4 w-full px-4">
        <div
            class="relative z-10 flex justify-center w-44 lg:w-56 mt-1 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md transition-transform duration-300 hover:scale-105">
            <div class="relative mx-3 mt-3 h-42 overflow-hidden rounded-2xl bg-clip-border text-gray-700">
                <img src="{{ url(Storage::url('images/product/'.$product->items->first()->images->first()->url)) }}"
                    class="product-image h-full w-full object-cover" />
            </div>
            <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-3">

                <div class="flex flex-col items-center justify-center">
                    <p
                        class="block font-sans font-bold text-base leading-5 text-white antialiased text-center">
                        {{ $product->name }}
                    </p>
                    <div class="text-sm text-slate-500">
                        <span class="product-attribute" data-attribute="color">
                            {{ $product->items->first()->color->name }} </span>
                    </div>
                    <div class="text-sm text-slate-500">
                        <!-- Dropdown de talles -->
                        <div x-data="{
                            open: false,
                            sizes: {{ json_encode($product->items->first()->sizes->pluck('name')) }},
                            selectedSize: '{{ $product->items->first()->sizes->first()->name }}'
                        }" class="max-w-sm rounded overflow-hidden shadow-lg">
                            <div class="mr-8 ml-4">
                                <div class="relative">
                                    <!-- Botón para desplegar el dropdown -->
                                    <button @click="open = !open"
                                        class="bg-teal p-3 rounded text-white shadow-inner w-full">
                                        <span class="float-left" x-text="selectedSize">Elegir talle</span>

                                        <svg class="ml-1 h-4 float-right fill-current text-white"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129">
                                            <g>
                                                <path
                                                    d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z" />
                                            </g>
                                        </svg>
                                    </button>

                                    <!-- Menú desplegable -->
                                    <div x-show="open" @click.away="open = false" class="rounded shadow-md my-2 relative z-10 bg-white">
                                        <ul class="list-reset">
                                            <template x-for="size in sizes" :key="size">
                                                <li>
                                                    <p @click="selectedSize= size; open = false" class="p-2 block text-black hover:bg-gray-200 cursor-pointer">
                                                        <span x-text="size"></span>
                                                    </p>
                                                </li>
                                            </template>
                                            <input type="hidden" x-model="selectedSize" name="selected_size">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

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

