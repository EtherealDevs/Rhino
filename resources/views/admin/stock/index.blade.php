@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 md:grid-cols-3 col-span-2 h-5/6 gap-6 mt-16">
            <div class="p-2 bg-white rounded-xl ">
                <p class="font-blinker font-medium text-md text-center p-4">
                    <span class="font-bold text-4xl">2</span>
                    <br>Promociones Activas
                </p>
            </div>
            <div class="p-2 bg-white rounded-xl ">
                <p class="font-blinker font-medium text-md text-center p-4">
                    <span class="font-bold text-4xl">32</span>
                    <br>Productos En oferta
                </p>
            </div>
            <div class="p-2 bg-white rounded-xl ">
                <p class="font-blinker font-medium text-md text-center p-4">
                    <span class="font-bold text-4xl">36</span>
                    <br>Ventas Nuevas
                </p>
            </div>
            <div class="p-2 bg-white rounded-xl ">
                <p class="font-blinker font-medium text-md text-center p-4">
                    <span class="font-bold text-4xl">$36.000</span>
                    <br>Ingreso
                </p>
            </div>
        </div>

        <div class="p-6 mt-6 bg-white rounded-xl overflow-scroll">
            <div class="md:flex">
                <div class="">
                    <button class="bg-blue-700 rounded-md p-2">
                        <a class="text-white" href="{{ route('admin.products.create') }}">Agregar Producto</a>
                    </button>
                </div>
                <div class="mx-auto">
                    <h2 class="text-2xl mr-12 font-josefin font-bold">Stock Actual</h2>
                </div>
            </div>

            <table class="mt-6 w-full min-w-max table-auto text-left">
                <thead>
                    <tr>
                        <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                            <p class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-around gap-2 font-normal leading-none opacity-70">Producto</p>
                        </th>
                        <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                            <p class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">Cantidad</p>
                        </th>
                        <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                            <p class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">Estado</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    @php
                        $stock=0;
                    @endphp
                    <tr class="lg:w-8/12 w-full mx-auto items-center">
                            <td class="w-1/2">
                                <div style="width: 25em" class="ml-10">
                                    <div id="mainHeading" class="flex justify-between items-center w-1/2 mt-4">
                                        <div class="">
                                            <p class="flex lg:text-2xl transition justify-center items-center font-semibold w-full leading-none text-gray-800">{{$product->name}}</p>
                                        </div>
                                        <button aria-label="toggler" class="" data-menu>
                                            <p class="font-sans text-sm font-extralight">Ver Mas</p>
                                        </button>
                                    </div>
                                    <div id="menu" class="hidden mt-6 w-full transition-height duration-500 overflow-hidden">
                                        <div class='flex items-center justify-start'>
                                            <div class="flex items-center justify-center">
                                                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                                                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                                                        <table class="w-full text-sm text-left text-gray-500">
                                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                                <tr>
                                                                    <th scope="col" class="py-3 px-6">Talle</th>
                                                                    <th scope="col" class="py-3 px-6">Color</th>
                                                                    <th scope="col" class="py-3 px-6">Cantidad</th>
                                                                </tr>
                                                            </thead>
                                                            <form action="{{route('admin.stock.store')}}" method="POST">
                                                                @csrf
                                                                <tbody>
                                                                        @php
                                                                            $i=1;
                                                                        @endphp
                                                                    @foreach ($product->items as $item)
                                                                            @php
                                                                                $j=1;
                                                                            @endphp
                                                                        @foreach ($item->sizes as $size)
                                                                            <tr class="bg-white border-b">
                                                                                <td class="py-4 px-6">{{$size->name}}</td>
                                                                                <input type="number" name="size_id" class="hidden" value="{{$size->id}}">
                                                                                <td class="py-4 px-6">{{$item->color->name}}</td>
                                                                                <input type="number" name="product_id" class="hidden" value="{{$item->id}}">
                                                                                <td class="py-4 px-6">
                                                                                    <input id="input-{{$i}}-{{$j}}" type="number" name="stock" class="w-16 h-8 text-sm border-none" placeholder="{{$size->pivot->stock}}" disabled/>
                                                                                </td>
                                                                                @php
                                                                                    $stock+=$size->pivot->stock;
                                                                                @endphp
                                                                                <td>
                                                                                    <button type="button" class="py-1 px-3 rounded-full bg-blue-400 text-white mr-4" onclick="edit('input-{{$i}}-{{$j}}')">Editar</button>
                                                                                </td>
                                                                            </tr>
                                                                            @php
                                                                                $j++;
                                                                            @endphp
                                                                        @endforeach
                                                                        @php
                                                                            $i++;
                                                                        @endphp
                                                                    @endforeach
                                                                </tbody>
                                                                <button type="submit">guardar</button>
                                                            </form>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mt-4">
                                    <span class="lg:mr-6 mr-4 lg:text-4xl md:text-xl text-lg leading-6 md:leading-5 lg:leading-4 font-semibold text-gray-800">{{$stock}}</span>
                                </p>
                            </td>
                            <td>
                                @if ($stock == 0)
                                    <div class="rounded-full bg-gray-300 w-1/2 flex justify-center">
                                        <p class="text-gray-500 justify-center my-2 font-josefin font-bold">Inactivo</p>
                                    </div>
                                @else
                                    <div class="rounded-full bg-green-300 w-1/2 flex justify-center">
                                        <p class="text-green-800 justify-center my-2 font-josefin font-bold">Activo</p>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><hr class="my-4 border-t-1 border-gray-100"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function edit(e){
            let input=document.getElementById(e);
            input.disabled = false;
            input.classList.remove('border-none')
            input.classList.add('border')
        }
        let elements = document.querySelectorAll("[data-menu]");
        elements.forEach(element => {
            element.addEventListener("click", function() {
                let parent = element.closest('div[style="width: 25em"]');
                let menu = parent.querySelector("#menu");
                let textElement = element.querySelector("p");

                if (menu.classList.contains("hidden")) {
                    menu.classList.remove("hidden");
                    menu.style.height = "0";
                    setTimeout(() => {
                        menu.style.height = menu.scrollHeight + "px";
                        textElement.textContent = "Ver Menos";
                    }, 10);
                } else {
                    menu.style.height = menu.scrollHeight + "px";
                    setTimeout(() => {
                        menu.style.height = "0";
                        textElement.textContent = "Ver Más";
                    }, 10);
                    menu.addEventListener("transitionend", () => {
                        if (menu.style.height === "0px") {
                            menu.classList.add("hidden");
                        }
                    }, { once: true });
                }
            });
        });
    </script>
@endsection
