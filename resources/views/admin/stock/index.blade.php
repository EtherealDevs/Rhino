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
                            <p class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">Cantidad</p>
                        </th>
                        <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                            <p class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">Producto</p>
                        </th>
                        <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                            <p class="antialiased font-sans text-sm text-blue-gray-900 flex items-center justify-between gap-2 font-normal leading-none opacity-70">Estado</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="lg:w-8/12 w-full mx-auto items-center">
                        <td>
                            <p class="mt-4">
                                <span class="lg:mr-6 mr-4 lg:text-4xl md:text-xl text-lg leading-6 md:leading-5 lg:leading-4 font-semibold text-gray-800">52.</span>
                            </p>
                        </td>
                        <td class="">
                            <div style="width: 25em">
                                <div id="mainHeading" class="flex justify-between items-center w-1/2 mt-4">
                                    <div class="">
                                        <p class="flex lg:text-2xl transition justify-center items-center font-semibold w-full leading-none text-gray-800">Remeras Arrow</p>
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
                                                        <tbody>
                                                            <tr class="bg-white border-b">
                                                                <td class="py-4 px-6">XL</td>
                                                                <td class="py-4 px-6">Rojo</td>
                                                                <form action="">
                                                                    <td class="py-4 px-6">32</td>
                                                                    <td>
                                                                        <button class="py-1 px-3 rounded-full bg-blue-400 text-white mr-4">Editar</button>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="rounded-full bg-green-300 w-1/2 flex justify-center">
                                <p class="text-green-800 justify-center my-2 font-josefin font-bold">Activo</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><hr class="my-4 border-t-1 border-gray-100"></td>
                    </tr>
                    <tr class="lg:w-8/12 w-full mx-auto items-center">
                        <td>
                            <p class="mt-4">
                                <span class="lg:mr-6 mr-4 lg:text-4xl md:text-xl text-lg leading-6 md:leading-5 lg:leading-4 font-semibold text-gray-800">52.</span>
                            </p>
                        </td>
                        <td class="">
                            <div style="width: 25em">
                                <div id="mainHeading" class="flex justify-between items-center w-1/2 mt-4">
                                    <div class="">
                                        <p class="flex lg:text-2xl transition justify-center items-center font-semibold w-full leading-none text-gray-800">Remeras Arrow</p>
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
                                                        <tbody>
                                                            <tr class="bg-white border-b">
                                                                <td class="py-4 px-6">XL</td>
                                                                <td class="py-4 px-6">Rojo</td>
                                                                <form action="">
                                                                    <td class="py-4 px-6">32</td>
                                                                    <td>
                                                                        <button class="py-1 px-3 rounded-full bg-blue-400 text-white mr-4">Editar</button>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="rounded-full bg-green-300 w-1/2 flex justify-center">
                                <p class="text-green-800 justify-center my-2 font-josefin font-bold">Activo</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
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
