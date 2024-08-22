@php
    $image = $items->first()->product->items->first()->images;
    $image2 = $items->last()->product->items->first()->images;
    $discount = $items->first()->combo->discount;
    $priceDiscount = $price - ($price * $discount) / 100;
@endphp

{{-- Card --}}
<div class="max-w-7xl mx-auto">
    <div
        class="custom-card bg-white rounded-xl shadow-md transition-transform pb-0 lg:pb-4 duration-300 hover:scale-105">

        {{-- Grid de Imagenes --}}
        <div class="grid grid-cols-5 lg:grid-cols-5 p-2 lg:p-4">
            <div class="relative col-span-2 md:col-span-2 lg:col-span-2 flex justify-center">
                <img src="{{ url(Storage::url('images/product/' . $image->first()->url)) }}"
                    class="w-full h-auto object-cover rounded-2xl" />
            </div>
            <div class="col-span-1 md:col-span-1 flex flex-col justify-center items-center text-center">
                <div class="">
                    <div class="text-black text-xl font-bold rounded-2xl px-2 py-2 ">
                        {{-- ${{ $priceDiscount }} --}}
                    </div>
                    <div class="line-through text-slate-400 text-xl font-bold rounded-2xl px-2 py-2">
                        {{-- ${{ $price }} --}}
                    </div>
                </div>
                <div class="my-1 lg:my-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="3em" height="1em" viewBox="0 0 32 32">
                        <path fill="black"
                            d="M19.05 5.06c0-1.68-1.37-3.06-3.06-3.06s-3.07 1.38-3.06 3.06v7.87H5.06C3.38 12.93 2 14.3 2 15.99c0 1.68 1.38 3.06 3.06 3.06h7.87v7.86c0 1.68 1.37 3.06 3.06 3.06c1.68 0 3.06-1.37 3.06-3.06v-7.86h7.86c1.68 0 3.06-1.37 3.06-3.06c0-1.68-1.37-3.06-3.06-3.06h-7.86z" />
                    </svg>
                </div>
            </div>
            <div class="relative col-span-2 md:col-span-2 lg:col-span-2 flex justify-center">
                <img src="{{ url(Storage::url('images/product/' . $image2->first()->url)) }}"
                    class="w-full h-auto object-cover rounded-2xl" />
            </div>
        </div>

        {{-- Item Title and add cart --}}
        <div class="grid grid-cols-1 gap-0 px-2 lg:p-4">

            {{-- Title --}}
            <div class="grid grid-cols-6 bg-black h-20 rounded-t-xl p-3 text-white relative">
                @foreach ($items as $item)
                    <div class="flex col-span-2 items-center justify-center w-full">
                        <p class="font-sans font-bold text-base text-white text-center">
                            {{ $item->product->name }}
                        </p>
                    </div>
                    @if ($loop->iteration == 1)
                        <div class="col-span-2 flex items-center justify-center">
                            <div class="text-white text-xl">+</div>
                        </div>
                    @endif
                @endforeach
            </div>
            
            {{-- Add to cart --}}
            <div class="flex bg-black h-18 rounded-b-xl p-3 text-white">
                <a href="" class="w-full flex justify-center">
                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.2 14.4C14.1455 14.4 13.3 15.201 13.3 16.2C13.3 16.6774 13.5002 17.1352 13.8565 17.4728C14.2128 17.8104 14.6961 18 15.2 18C15.7039 18 16.1872 17.8104 16.5435 17.4728C16.8998 17.1352 17.1 16.6774 17.1 16.2C17.1 15.7226 16.8998 15.2648 16.5435 14.9272C16.1872 14.5896 15.7039 14.4 15.2 14.4ZM0 0V1.8H1.9L5.32 8.631L4.028 10.836C3.8855 11.088 3.8 11.385 3.8 11.7C3.8 12.1774 4.00018 12.6352 4.3565 12.9728C4.71282 13.3104 5.19609 13.5 5.7 13.5H17.1V11.7H6.099C6.03601 11.7 5.9756 11.6763 5.93106 11.6341C5.88652 11.5919 5.8615 11.5347 5.8615 11.475C5.8615 11.43 5.871 11.394 5.89 11.367L6.745 9.9H13.8225C14.535 9.9 15.162 9.522 15.485 8.973L18.886 3.15C18.9525 3.006 19 2.853 19 2.7C19 2.4613 18.8999 2.23239 18.7218 2.0636C18.5436 1.89482 18.302 1.8 18.05 1.8H3.9995L3.1065 0M5.7 14.4C4.6455 14.4 3.8 15.201 3.8 16.2C3.8 16.6774 4.00018 17.1352 4.3565 17.4728C4.71282 17.8104 5.19609 18 5.7 18C6.20391 18 6.68718 17.8104 7.0435 17.4728C7.39982 17.1352 7.6 16.6774 7.6 16.2C7.6 15.7226 7.39982 15.2648 7.0435 14.9272C6.68718 14.5896 6.20391 14.4 5.7 14.4Z"
                            fill="white" />
                    </svg>
                    <p class="ml-2 font-sans font-bold text-base text-white">
                        Sumar a carrito


                    </p>
                </a>
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
