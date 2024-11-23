@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-gray-800 mb-4">Detalle del Pedido #{{ $order->id }}</h1>

        <!-- Estado del Pedido -->
        <div
            class="inline-flex items-center justify-center text-xs font-semibold uppercase w-24 xl:w-40 h-6 rounded-full
            @if ($order->orderStatus->id == 5) text-red-500 bg-red-100
            @elseif ($order->orderStatus->id == 1) text-yellow-600 bg-yellow-300
            @else text-emerald-600 bg-emerald-100 @endif">
            {{ $order->orderStatus->name }}
        </div>

        <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Información del Usuario -->
            <div class="space-y-3">
                <p class="text-lg text-gray-600">
                    <strong class="font-medium">Usuario:</strong> {{ $order->user->name }}
                </p>
                <p class="text-lg text-gray-600">
                    <strong class="font-medium">Fecha de Creación:</strong> {{ $order->created_at->format('d-m-Y H:i') }}
                </p>
            </div>
        </div>

        <div class="">
            <!-- Sección de Comprobante y Método de Pago -->
            @if ($order->paymentMethod->id)
                <div class="w-1/2">
                    @if ($order->comprobante)
                        <div class="mt-4 bg-gray-200 p-4 rounded w-full sm:w-auto flex flex-col items-center">
                            <img src="{{ asset('storage/' . $order->comprobante->url) }}"
                                alt="Comprobante de pago del pedido #{{ $order->id }}"
                                class="w-full sm:w-64 h-auto object-cover rounded mb-4">

                            @if (in_array($order->orderStatus->id, [1, 2]))
                                <p class="text-sm text-gray-700 font-semibold">Pago: {{ $order->orderStatus->name }}</p>
                            @else
                                <button
                                    class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    Ver mi pedido
                                </button>
                            @endif
                        </div>
                    @else
                        <!-- Información para Transferencia -->
                        <div
                            class="mt-4 bg-white  border border-slate-700 p-6 rounded-xl w-full sm:w-auto flex flex-col items-start space-y-2">
                            <h3 class="text-gray-700 font-bold">Información para Transferencia</h3>
                            <p><strong>Alias:</strong> {{ $transferInfo->alias }}</p>
                            <p><strong>CBU:</strong> {{ $transferInfo->cbu }}</p>
                            <p><strong>Nombre:</strong> {{ $transferInfo->holder_name }}</p>

                            <form action="{{ route('comprobante.store') }}" method="post" enctype="multipart/form-data"
                                class="w-full">
                                @csrf
                                <div class="space-y-4">
                                    <!-- Carga de archivo con SVG -->
                                    <label for="file"
                                        class="w-full flex items-center justify-center border border-gray-300 rounded py-4 cursor-pointer">
                                        <!-- SVG que representa el ícono de carga de archivo -->
                                        <svg class="h-6 w-6 text-gray-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            width="1em" height="1em" viewBox="0 0 24 24">
                                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7 6h10M7 9h10m-8 8h6" />
                                                <path
                                                    d="M3 12h-.4a.6.6 0 0 0-.6.6v8.8a.6.6 0 0 0 .6.6h18.8a.6.6 0 0 0 .6-.6v-8.8a.6.6 0 0 0-.6-.6H21M3 12V2.6a.6.6 0 0 1 .6-.6h16.8a.6.6 0 0 1 .6.6V12M3 12h18" />
                                            </g>
                                        </svg>
                                        <span class="text-gray-700">Cargar archivo</span>
                                        <!-- Input hidden, el cual activará el cuadro de diálogo de carga al hacer clic en el label -->
                                        <input type="file" id="file" name="file" accept="image/*,.pdf"
                                            class="hidden" />
                                    </label>

                                    <div id="preview-container" class="mt-4 hidden">
                                        <img id="image-preview"
                                            class="w-full max-w-xs mx-auto rounded border border-gray-300" />
                                        <button id="remove-preview" type="button"
                                            class="mt-2 bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded-lg transition duration-200">
                                            Eliminar
                                        </button>
                                    </div>

                                    <!-- Input oculto con el ID del pedido -->
                                    <input type="hidden" id="order_id" name="order_id" value="{{ $order->id }}">

                                    <!-- Input para el DNI con un diseño mejorado -->
                                    <input type="number" id="dni" name="dni" placeholder="DNI en el comprobante"
                                        class="mt-2 w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                                </div>


                                <button type="submit"
                                    class="mt-4 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-xl transition duration-200 w-full">
                                    Subir Comprobante
                                </button>
                            </form>

                            <script>
                                // Manejar la carga de archivos
                                document.getElementById('file').addEventListener('change', function(event) {
                                    const file = event.target.files[0]; // Obtener el archivo seleccionado
                                    const previewContainer = document.getElementById('preview-container');
                                    const imagePreview = document.getElementById('image-preview');

                                    if (file) {
                                        const reader = new FileReader();

                                        // Leer el archivo como una URL de datos
                                        reader.onload = function(e) {
                                            // Mostrar la previsualización
                                            imagePreview.src = e.target.result;
                                            previewContainer.classList.remove('hidden');
                                        };

                                        // Verificar si el archivo es una imagen antes de intentar leerlo
                                        if (file.type.startsWith('image/')) {
                                            reader.readAsDataURL(file);
                                        } else {
                                            // Ocultar previsualización si no es una imagen
                                            previewContainer.classList.add('hidden');
                                        }
                                    }
                                });

                                // Manejar la eliminación de la imagen seleccionada
                                document.getElementById('remove-preview').addEventListener('click', function() {
                                    const fileInput = document.getElementById('file');
                                    const previewContainer = document.getElementById('preview-container');
                                    const imagePreview = document.getElementById('image-preview');

                                    // Restablecer el input de archivo
                                    fileInput.value = "";
                                    // Ocultar el contenedor de previsualización
                                    previewContainer.classList.add('hidden');
                                    // Limpiar el src de la imagen de previsualización
                                    imagePreview.src = "";
                                });
                            </script>

                        </div>
                    @endif
                </div>
            @endif

            <!-- Sección para Pactar Retiro del Pedido -->
            @if ($order->delivery_service_id === 2)
                <div class="w-1/2 mb-10 mt-12">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Pactar retiro del pedido</h2>
                    <div class="mt-4">
                        <button onclick="contactRino()"
                            class="bg-[#25D366] text-white flex items-center px-4 py-2 rounded-xl hover:bg-[#1EBE57] transition">
                            <!-- Icono de WhatsApp en SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" width="1em" height="1em"
                                viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                            </svg>
                            <p class="p-2 text-lg font-bold">Pactar retiro con Rino</p>
                        </button>
                    </div>
                </div>
            @endif
            @if ($order->delivery_service_id === 1)
                <div class="w-1/2 mb-10 mt-12">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Envío a domicilio</h2>
                    <div class="mt-4">
                        <p class="text-lg font-semibold text-gray-700">Informacion de Envio:</p>
                        @isset($order->send_number)
                            @if (is_array($tracking))
                                @foreach ($tracking as $item)
                                    <div class="p-2">
                                        <p class="text-lg font-semibold text-gray-700">Numero de seguimiento:
                                            {{ $item['NumeroEnvio'] }}</p>
                                        <p class="text-lg font-semibold text-gray-700">Estado:
                                            {{ $item['Estado'] }}</p>
                                        <p class="text-lg font-semibold text-gray-700">Fecha de envio:
                                            {{ date_format(now()->parse($item['Fecha']), 'd/m/Y') }}</p>
                                    </div>
                                @endforeach
                            @endif
                        @endisset
                    </div>
                </div>
            @endif

            <script>
                function contactRino() {
                    window.location.href =
                        "https://wa.me/5493794316606?text={{ urlencode('Hola Rino!! te contacto para retirar el pedido número ' . $order->id) }}";
                }
            </script>
        </div>

        <!-- Detalles de Productos -->
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Detalles de Productos</h3>
        <ul class="space-y-4">
            @foreach ($order->details as $detail)
                <li class="flex items-center justify-between bg-gray-100 p-4 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <img class="lg:w-12 h-8 lg:h-12 w-8 rounded-full border-gray-200 border transform hover:scale-125"
                            src="{{ url(Storage::url($detail->productItem()->images->first()->url)) }}" alt="">
                        <div>
                            <p class="text-lg font-medium text-gray-700">{{ $detail->productItem()->product->name }}</p>
                            <p class="text-sm text-gray-500">Cantidad: {{ $detail->amount }}</p>

                            <p class="text-sm text-gray-500">Talle: {{ $detail->itemVariation()->size->name }}</p>

                            <p class="text-sm text-gray-500">Color: {{ $detail->productItem()->color->name }}</p>
                        </div>
                    </div>
                    <p class="text-lg font-semibold text-gray-700">
                        ${{ number_format($detail->price / 100, 2, '.', ',') }}
                    </p>
                </li>
            @endforeach
        </ul>

        <!-- Botones de Navegación y Total -->
        <div class="justify-between mt-6 gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5">
            <div class="lg:col-span-4 w-full flex flex-col sm:flex-row sm:justify-start sm:gap-4 items-center">
                <!-- Botón "Ver lista de pedidos" -->
                <div class="w-full sm:w-3/12 mb-4 sm:mb-0">
                    <a href="{{ route('orders.index') }}"
                        class="w-full flex justify-center items-center gap-2 px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-xl font-semibold text-center transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" class="w-6 h-6"
                            viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="m4 10l-.707.707L2.586 10l.707-.707zm17 8a1 1 0 1 1-2 0zM8.293 15.707l-5-5l1.414-1.414l5 5zm-5-6.414l5-5l1.414 1.414l-5 5zM4 9h10v2H4zm17 7v2h-2v-2zm-7-7a7 7 0 0 1 7 7h-2a5 5 0 0 0-5-5z" />
                        </svg>
                        Ver lista de pedidos
                    </a>
                </div>

                <!-- Botón "Contactanos por algún problema" -->
                <div class="w-full sm:w-3/12">
                    <a href="https://wa.me/5493794316606?text={{ urlencode('Hola Rinooo!! 👋🏻 tengo un problema con el pedido número ' . $order->id) }}"
                        class="w-full flex justify-center items-center gap-2 px-6 py-2 text-white bg-[#25D366] hover:bg-[#1EBE57] rounded-xl font-semibold text-center transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" width="1em" height="1em"
                            viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                        </svg>
                        Tengo un Problema
                    </a>
                </div>
            </div>

            <!-- Total -->
            <div class="col-span-1 flex justify-center items-center sm:mt-0 mt-4">
                <p class="text-2xl font-bold text-gray-800 text-center">
                    <span class="font-semibold uppercase">Total:</span>
                    <span class="text-green-600">${{ number_format($order->total / 100, 2, ',', '.') }}</span>
                </p>
            </div>
        </div>

    </div>
@endsection
