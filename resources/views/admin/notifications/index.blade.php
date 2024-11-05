@extends('layouts.admin')
@section('content')
    <div class="p-6 pt-20 sticky">

        <div class="p-6 bg-white rounded-xl grid grid-cols-3 static">
            <div class="justify-start col-span-2">
                <h2 class="font-josefin font-bold italic text-2xl">
                    Notificaciones
                </h2>
            </div>

            <div class="justify-end col-span-1">
                <p class="font-bold text-xl font-josefin">
                    24
                </p>
            </div>
        </div>

        <div class="overflow-hidden static">
            <section class="relative flex flex-col justify-center overflow-hidden antialiased">
                <div class="w-full max-w-6xl mx-auto px-4 md:px-6 ">
                    <div class="flex flex-col justify-center divide-y divide-slate-200 [&>*]:py-16">
                        <div class="w-full max-w-3xl mx-auto">
                            <!-- Vertical Timeline #3 -->
                            <div
                                class="space-y-8 sticky before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:ml-[8.75rem] md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">
                                @foreach ($notifications as $notify)
                                    @php
                                        $user = App\Models\User::where('id', $notify->data['user_id'])->first();
                                        $cart = App\Models\Cart::where('id', $notify->data['order_id'])->first();

                                    @endphp
                                    <!-- Item #1 -->
                                    <div class="relative">
                                        <div class="md:flex items-center md:space-x-4 mb-3">
                                            <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                                                <!-- Icon -->
                                                <div
                                                    class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                                                    <svg class="fill-emerald-500" xmlns="http://www.w3.org/2000/svg"
                                                        width="16" height="16">
                                                        <path
                                                            d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                                    </svg>
                                                </div>
                                                <!-- Date -->
                                                <time
                                                    class="text-sm font-medium text-indigo-500 md:w-28">{{ date_format($notify->created_at, 'j M o') }}</time>
                                            </div>
                                            <!-- Title -->
                                            <div class="text-slate-500 ml-14"><span
                                                    class="text-slate-900 font-bold">{{ $user->name }}</span> opened the
                                                request</div>
                                        </div>
                                        <!-- Card -->
                                        <div
                                            class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">
                                            {{ $cart->contents }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
    <!-- component -->
@endsection
