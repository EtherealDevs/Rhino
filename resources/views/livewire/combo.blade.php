@php
    // Verifica si $items tiene al menos un elemento y que las relaciones necesarias existen
    $image =
        $items->isNotEmpty() && $items->first()->product && $items->first()->product->items->isNotEmpty()
            ? $items->first()->product->items->first()->images
            : null;

    $image2 =
        $items->isNotEmpty() && $items->last()->product && $items->last()->product->items->isNotEmpty()
            ? $items->last()->product->items->first()->images
            : null;

    $discount = $items->isNotEmpty() && $items->first()->combo ? $items->first()->combo->discount : 0;

    $priceDiscount = $price - ($price * $discount) / 100;
@endphp

{{-- Card --}}
@php
    // Verifica si $items tiene al menos un elemento y que las relaciones necesarias existen
    $image =
        $items->isNotEmpty() && $items->first()->product && $items->first()->product->items->isNotEmpty()
            ? $items->first()->product->items->first()->images
            : null;

    $image2 =
        $items->isNotEmpty() && $items->last()->product && $items->last()->product->items->isNotEmpty()
            ? $items->last()->product->items->first()->images
            : null;

    $discount = $items->isNotEmpty() && $items->first()->combo ? $items->first()->combo->discount : 0;

    $priceDiscount = $price - ($price * $discount) / 100;
@endphp

{{-- Card --}}
<div class="max-w-7xl mx-auto">
    <div
        class="custom-card bg-white rounded-xl shadow-xl transition-transform pb-2 lg:pb-3 duration-300 hover:scale-105">

        {{-- Grid de Imagenes --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 p-4 lg:p-4 gap-4">
            <div class="relative col-span-1 sm:col-span-2 lg:col-span-2 flex justify-center items-center">
                <img src="{{ url(Storage::url('images/product/' . $image2->first()->url)) }}"
                    class="w-full h-auto object-cover rounded-2xl" />
        
                <div class="absolute top-4 left-4 flex space-x-2">
                    <button
                        class="rounded-full px-3 py-2 bg-[#26ca60] font-josefin text-white text-sm font-bold hover:bg-white hover:text-green-700 transition-colors">
                        {{ $discount }}%
                    </button>
                </div>
            </div>
            <div class="col-span-1 flex flex-col justify-center items-center text-center space-y-2">
                <div class="my-1 lg:my-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="3em" height="1em" viewBox="0 0 32 32">
                        <path fill="black"
                            d="M19.05 5.06c0-1.68-1.37-3.06-3.06-3.06s-3.07 1.38-3.06 3.06v7.87H5.06C3.38 12.93 2 14.3 2 15.99c0 1.68 1.38 3.06 3.06 3.06h7.87v7.86c0 1.68 1.37 3.06 3.06 3.06c1.68 0 3.06-1.37 3.06-3.06v-7.86h7.86c1.68 0 3.06-1.37 3.06-3.06c0-1.68-1.37-3.06-3.06-3.06h-7.86z" />
                    </svg>
                </div>
            </div>
            <div class="relative col-span-1 sm:col-span-2 lg:col-span-2 flex justify-center items-center">
                @if ($image && $image->isNotEmpty())
                    <img src="{{ url(Storage::url('images/product/' . $image->first()->url)) }}"
                        class="w-full h-auto object-cover rounded-2xl" />
                @endif
        
                <!-- Botones de descuento y precio (Ahora en la esquina superior derecha) -->
                <div class="absolute top-4 right-4 flex space-x-2">
                    <button
                        class="rounded-full px-3 py-2 bg-[#26ca60] font-josefin text-white text-sm font-bold hover:bg-white hover:text-green-700 transition-colors">
                        ${{ number_format($price, 2, ',', ' ') }}
                    </button>
                </div>
            </div>
        </div>

        {{-- Item Title and add cart --}}
        <div class="grid grid-cols-1 gap-0 px-2 lg:p-4">

            {{-- Title --}}
            <div class="grid grid-cols-6 bg-black h-20 rounded-t-xl p-3 text-white relative">
                @foreach ($items as $item)
                    <div class="flex col-span-2 items-center justify-center w-full">
                        <!-- Verifica que $item->product no sea null antes de acceder a su propiedad -->
                        @if ($item->product)
                            <p class="font-sans font-bold text-base text-white text-center">
                                {{ $item->product->name }}
                            </p>
                        @else
                            <p class="font-sans font-bold text-base text-white text-center">
                                Producto no disponible
                            </p>
                        @endif
                    </div>

                    @if ($loop->iteration == 1)
                        <div class="col-span-2 flex items-center justify-center">
                            <div class="text-white text-xl">+</div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Add to cart --}}
            <div class="flex justify-center bg-black h-18 rounded-b-xl p-3 text-white">
                <form method="POST" action="{{ route('cart.addCombo') }}">
                    @csrf
                    <input type="hidden" name="comboId" value="{{ $items->first()->combo_id }}">

                    <button href="" class="w-full flex justify-center">
                        <p class="ml-2 font-sans font-bold text-base text-white">
                            Ver Contenido del combo
                        </p>
                        <span class="text-xl ml-2">
                            →
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Estilos base para la tarjeta */
        .custom-card {
            width: 300px;
            /* Ancho por defecto para pantallas pequeñas */
            max-width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding-bottom: 0.5rem;
            transition: transform 0.3s ease-in-out;
        }

        /* Media query para pantallas más grandes (ej. tablets y desktops) */
        @media (min-width: 768px) {
            .custom-card {
                width: 680px;
            }
        }

        /* Media query para pantallas de escritorio más grandes */
        @media (min-width: 1024px) {
            .custom-card {
                width: 680px;
            }
        }
    </style>

    <script>
        function changeImage(element, newImageUrl) {
            const img = element.querySelector('.product-image');
            img.src = newImageUrl;
        }

        function resetImage(element, originalImageUrl) {
            const img = element.querySelector('.product-image');
            img.src = originalImageUrl;
        }
    </script>
</div>
