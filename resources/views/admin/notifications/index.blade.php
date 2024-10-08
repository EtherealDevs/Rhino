@extends('layouts.admin')
@section('content')
    <div class="p-6 pt-20">

        <div class="p-6 bg-white rounded-xl grid grid-cols-3 static">
            <div class="justify-start col-span-2">
                <h2 class="font-josefin font-bold italic text-2xl">
                    Notificaciones
                </h2>
            </div>

            <div class="justify-end col-span-1">
                <div class="bg-blue-300 rounded-full w- p-2">
                    <p class="font-bold text-blue-800 text-xl font-josefin">
                        24
                    </p>
                </div>
            </div>
        </div>

        <div class="p-6 mx-6 static">
            <section class="relative flex flex-col justify-center overflow-hidden antialiased">
                <div class="w-full max-w-6xl mx-auto px-4 md:px-6 ">
                    <div class="flex flex-col justify-center divide-y divide-slate-200 [&>*]:py-16">


                        <div class="w-full max-w-3xl mx-auto">

                            <!-- Vertical Timeline #3 -->
                            <div
                                class="space-y-8 sticky before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:ml-[8.75rem] md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">
                                @foreach ($notifications as $notify)
                                    @php
                                        // Inicializamos el usuario como null
                                        $user = null;

                                        // Verificamos si el 'user_id' está presente en los datos
                                        if (isset($notify->data['user_id'])) {
                                            $user = App\Models\User::where('id', $notify->data['user_id'])->first();
                                        }
                                    @endphp

                                    <!-- Notificación Pedido Nuevo -->
                                    @if ($notify->type == 'new_order')
                                        @php
                                            $order = App\Models\Order::where('id', $notify->data['order_id'])->first();
                                        @endphp
                                        <div class="relative">
                                            <div class="md:flex items-center md:space-x-4 mb-3">
                                                <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                                                    <!-- Icono Pedido -->
                                                    <div
                                                        class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                                                        <svg class="fill-emerald-500" xmlns="http://www.w3.org/2000/svg"
                                                            width="16" height="16">
                                                            <path
                                                                d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                                        </svg>
                                                    </div>
                                                    <!-- Fecha Pedido -->
                                                    <time
                                                        class="text-sm font-medium text-indigo-500 md:w-28">{{ date_format($notify->created_at, 'j M o') }}</time>
                                                </div>
                                                <!-- Título Pedido -->
                                                <div class="text-slate-500 ml-14">
                                                    <span
                                                        class="text-slate-900 font-bold">{{ $user ? $user->name : 'Usuario Desconocido' }}</span>
                                                    placed a new order
                                                </div>
                                            </div>
                                            <!-- Contenido Pedido -->
                                            <div
                                                class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">
                                                Order details: {{ $order->details }}
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Notificación Stock Bajo -->
                                    @if ($notify->type == 'App\Notifications\StockNotify')
                                        <div class="relative">
                                            <div class="md:flex items-center md:space-x-4 mb-3">
                                                <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                                                    <!-- Icono Stock Bajo -->
                                                    <div
                                                        class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                                                        <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg"
                                                            width="16" height="16">
                                                            <path
                                                                d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                                        </svg>
                                                    </div>
                                                    <!-- Fecha Stock Bajo -->
                                                    <time
                                                        class="text-sm font-medium text-red-500 md:w-28">{{ date_format($notify->created_at, 'j M o') }}</time>
                                                </div>
                                                <!-- Título Stock Bajo -->
                                                <div class="text-slate-500 ml-14">
                                                    <span
                                                        class="text-slate-900 font-bold">{{ $notify->data['name'] }}</span>
                                                    is low on stock!
                                                </div>
                                            </div>
                                            <!-- Contenido Stock Bajo -->
                                            <div
                                                class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">
                                                Only {{ $notify->data['stock'] }} units left.
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Notificación Nueva Reseña -->
                                    @if ($notify->type == 'new_review')
                                        @php
                                            $review = App\Models\Review::where(
                                                'id',
                                                $notify->data['review_id'],
                                            )->first();
                                            $product = App\Models\Product::where('id', $review->product_id)->first();
                                        @endphp
                                        <div class="relative">
                                            <div class="md:flex items-center md:space-x-4 mb-3">
                                                <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                                                    <!-- Icono Nueva Reseña -->
                                                    <div
                                                        class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                                                        <svg class="fill-yellow-500" xmlns="http://www.w3.org/2000/svg"
                                                            width="16" height="16">
                                                            <path
                                                                d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                                        </svg>
                                                    </div>
                                                    <!-- Fecha Nueva Reseña -->
                                                    <time
                                                        class="text-sm font-medium text-yellow-500 md:w-28">{{ date_format($notify->created_at, 'j M o') }}</time>
                                                </div>
                                                <!-- Título Nueva Reseña -->
                                                <div class="text-slate-500 ml-14">
                                                    <span
                                                        class="text-slate-900 font-bold">{{ $user ? $user->name : 'Usuario Desconocido' }}</span>
                                                    left a review on <span
                                                        class="text-indigo-500">{{ $product->name }}</span>
                                                </div>
                                            </div>
                                            <!-- Contenido Nueva Reseña -->
                                            <div
                                                class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">
                                                "{{ $review->content }}" - Rating: {{ $review->rating }} stars
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div
                                class="space-y-8 sticky before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:ml-[8.75rem] md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">

                                <!-- Notificación Pedido Nuevo -->
                                <div class="relative">
                                    <div class="md:flex items-center md:space-x-4 mb-3">
                                        <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                                            <!-- Icono Pedido -->
                                            <div
                                                class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                                                <svg class="fill-emerald-500" xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16">
                                                    <path
                                                        d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                                </svg>
                                            </div>
                                            <!-- Fecha Pedido -->
                                            <time class="text-sm font-medium text-indigo-500 md:w-28">15 Sep 2024</time>
                                        </div>
                                        <!-- Título Pedido -->
                                        <div class="text-slate-500 ml-14">
                                            <span class="text-slate-900 font-bold">John Doe</span> placed a new order
                                        </div>
                                    </div>
                                    <!-- Contenido Pedido -->
                                    <div
                                        class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">
                                        Order details: 3 items in the cart - Total: $250
                                    </div>
                                </div>

                                <!-- Notificación Stock Bajo -->
                                <div class="relative">
                                    <div class="md:flex items-center md:space-x-4 mb-3">
                                        <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                                            <!-- Icono Stock Bajo -->
                                            <div
                                                class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                                                <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="16"
                                                    height="16">
                                                    <path
                                                        d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                                </svg>
                                            </div>
                                            <!-- Fecha Stock Bajo -->
                                            <time class="text-sm font-medium text-red-500 md:w-28">12 Sep 2024</time>
                                        </div>
                                        <!-- Título Stock Bajo -->
                                        <div class="text-slate-500 ml-14">
                                            <span class="text-slate-900 font-bold">Product XYZ</span> is low on stock!
                                        </div>
                                    </div>
                                    <!-- Contenido Stock Bajo -->
                                    <div
                                        class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">
                                        Only 5 units left.
                                    </div>
                                </div>

                                <!-- Notificación Nueva Reseña -->
                                <div class="relative">
                                    <div class="md:flex items-center md:space-x-4 mb-3">
                                        <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                                            <!-- Icono Nueva Reseña -->
                                            <div
                                                class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                                                <svg class="fill-yellow-500" xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16">
                                                    <path
                                                        d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                                </svg>
                                            </div>
                                            <!-- Fecha Nueva Reseña -->
                                            <time class="text-sm font-medium text-yellow-500 md:w-28">10 Sep 2024</time>
                                        </div>
                                        <!-- Título Nueva Reseña -->
                                        <div class="text-slate-500 ml-14">
                                            <span class="text-slate-900 font-bold">Jane Smith</span> left a review on
                                            <span class="text-indigo-500">Product ABC</span>
                                        </div>
                                    </div>
                                    <!-- Contenido Nueva Reseña -->
                                    <div
                                        class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">
                                        "Great product, really loved it!" - Rating: 5 stars
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
