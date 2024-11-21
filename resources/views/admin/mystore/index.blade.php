@extends('layouts.admin')

@section('content')
    <div class="w-full pt-20 px-10">
        <!-- Sección de Transferencias -->
        <div class="bg-white rounded-lg p-6 mb-6 shadow-xl">
            <h3 class="text-gray-700 text-3xl font-semibold mb-4">Información para recibir Transferencias</h3>
            @if (isset($transferInfo))
                <div class="mb-4">
                    <p class="text-gray-600"><strong>Alias:</strong> {{ $transferInfo->alias }}</p>
                    <p class="text-gray-600"><strong>CBU:</strong> {{ $transferInfo->cbu }}</p>
                    <p class="text-gray-600"><strong>Nombre:</strong> {{ $transferInfo->holder_name }}</p>
                </div>
            @else
                <div class="mb-4">
                    <p class="text-gray-600">No hay información de transferencia disponible.</p>
                </div>
            @endif
            <!-- Botón para abrir el modal -->
            <button id="openModal"
                class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-xl hover:bg-blue-600 transition duration-200">
                Actualizar Información de Cobro
            </button>
        </div>

        <!-- Modal -->
        <div id="modal" class="fixed inset-0 backdrop-blur-xl hidden items-center justify-center z-50">
            <div
                class="bg-white rounded-xl p-6 w-full max-w-lg transform -translate-x-1/2 -translate-y-1/2 relative left-1/2 top-1/2">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Configurar Información de Transferencia</h2>

                <!-- Formulario -->
                <form action="{{ route('transfer-info.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Alias -->
                    <div>
                        <label for="alias" class="block text-gray-700 font-bold mb-2">Alias</label>
                        <input type="text" name="alias" id="alias"
                            class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Ej: tu.alias"
                            value="{{ $transferInfo->alias ?? old('alias') }}" required>
                    </div>

                    <!-- CBU -->
                    <div>
                        <label for="cbu" class="block text-gray-700 font-bold mb-2">CBU</label>
                        <input type="text" name="cbu" id="cbu"
                            class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Ej: 1234567890123456789012"
                            value="{{ $transferInfo->cbu ?? old('cbu') }}" required>
                    </div>

                    <!-- Nombre del Titular -->
                    <div>
                        <label for="holder_name" class="block text-gray-700 font-bold mb-2">Nombre del Titular</label>
                        <input type="text" name="holder_name" id="holder_name"
                            class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Ej: Tu Nombre"
                            value="{{ $transferInfo->holder_name ?? old('holder_name') }}" required>
                    </div>

                    <!-- Botón de Envío -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600">
                            Guardar Información
                        </button>
                    </div>
                </form>

                <!-- Botón para cerrar el modal -->
                <div class="mt-4 text-right">
                    <button id="closeModal" class="absolute top-3 right-3 text-gray-600 hover:text-gray-800">
                        X
                    </button>
                </div>
            </div>
        </div>

        <!-- Estadísticas Principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="p-6 bg-gray-50 rounded-xl shadow-lg">
                <p class="text-gray-700 text-lg font-semibold">Ventas últimos 30 días</p>
                <h3 class="text-xl text-green-500 font-bold mt-2">${{ number_format($salesLast30Days, 2) }}</h3>
            </div>
            <div class="p-6 bg-gray-50 rounded-xl shadow-lg">
                <p class="text-gray-700 text-lg font-semibold">Ventas últimos 6 meses</p>
                <h3 class="text-xl text-green-500 font-bold mt-2">${{ number_format($salesLast6Months, 2) }}</h3>
            </div>
            <div class="p-6 bg-gray-50 rounded-xl shadow-lg">
                <p class="text-gray-700 text-lg font-semibold">Productos vendidos en total</p>
                <h3 class="text-xl text-yellow-500 font-bold mt-2">{{ $totalProductsSold }}</h3>
            </div>
            <div class="p-6 bg-gray-50 rounded-xl shadow-lg">
                <p class="text-gray-700 text-xl font-semibold">Usuarios logueados</p>
                <h3 class="text-xl text-purple-500 font-bold">{{ $loggedUsers }}</h3>
            </div>
        </div>

        <!-- Gráfico de Categorías -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="col-span-2 bg-white rounded-xl p-6 shadow-xl">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Categorías</h2>
                <canvas id="myChart"></canvas>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-xl">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Ganancias por Categoría</h2>
                <div class="space-y-4">
                    @foreach ($earningsByCategory as $category)
                        <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                            <p class="text-gray-600">{{ $categories[$category->category_id]->name }}</p>
                            <h3 class="text-lg font-bold text-green-500">${{ number_format($category->total_earnings, 2) }}
                            </h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Gráfico de Ganancias por Producto -->
        <div class="bg-gray-900 rounded-3xl p-10 mt-10">
            <h1 class="text-white text-5xl mb-6 text-center">Ganancias por Producto</h1>
            <div class="grid grid-cols-4 gap-6">
                @foreach ($earningsByProduct as $product)
                    <div
                        class="bg-gradient-to-t from-blue-700 via-blue-500 to-indigo-700 rounded-3xl shadow-lg p-4 text-center">
                        <p class="text-white text-xs">{{ $product->name }}</p>
                        <h3 class="text-white font-extralight">${{ number_format($product->total_earnings, 2) }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Noto+Sans+Hatran&display=swap');

        .selected_font {
            font-family: "Inter", sans-serif;
        }
    </style>

    <script>
        document.getElementById('openModal').addEventListener('click', function() {
            document.getElementById('modal').classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });

        // Cerrar modal si se hace clic fuera del contenido
        window.onclick = function(event) {
            let modal = document.getElementById('modal');
            if (event.target == modal) {
                modal.classList.add('hidden');
            }
        }

        const ctx = document.getElementById('myChart').getContext('2d');
        const topCategories = @json($topCategories);
        const categories = @json($categories);

        const labels = topCategories.map(category => categories[category.category_id]?.name || 'Unknown');
        const data = topCategories.map(category => category.total_sold);

        new Chart(ctx, {
            type: 'pie', // Cambiado de 'bar' a 'pie'
            data: {
                labels: labels,
                datasets: [{
                    label: 'Top Categories Sold',
                    data: data,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw;
                                return `${label}: $${value.toFixed(2)}`;
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js"></script>
@endsection
