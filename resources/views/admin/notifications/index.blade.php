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
                            <div class="w-full h-screen top-0 ">
                                <div class="w-full z-10 h-full overflow-x-hidden transform translate-x-0 transition ease-in-out duration-700"
                                    id="notification">
                                    <div class="2xl:w-4/12 bg-gray-50 h-screen overflow-y-auto p-8 absolute right-0">

                                        <div class="w-full p-3 mt-8 bg-white rounded flex">
                                            <div tabindex="0" aria-label="heart icon" role="img"
                                                class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.00059 3.01934C9.56659 1.61334 11.9866 1.66 13.4953 3.17134C15.0033 4.68334 15.0553 7.09133 13.6526 8.662L7.99926 14.3233L2.34726 8.662C0.944589 7.09133 0.997256 4.67934 2.50459 3.17134C4.01459 1.662 6.42992 1.61134 8.00059 3.01934Z"
                                                        fill="#EF4444" />
                                                </svg>
                                            </div>
                                            <div class="pl-3">
                                                <p tabindex="0" class="focus:outline-none text-sm leading-none"><span
                                                        class="text-indigo-700">James Doe</span> favourited an <span
                                                        class="text-indigo-700">item</span></p>
                                                <p tabindex="0"
                                                    class="focus:outline-none text-xs leading-3 pt-1 text-gray-500">2
                                                    hours ago</p>
                                            </div>
                                        </div>

                                        <div class="w-full p-3 mt-4 bg-white rounded shadow flex flex-shrink-0">
                                            <div tabindex="0" aria-label="group icon" role="img"
                                                class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex flex-shrink-0 items-center justify-center">
                                            </div>
                                            <div class="pl-3 w-full">
                                                <div class="flex items-center justify-between w-full">
                                                    <p tabindex="0" class="focus:outline-none text-sm leading-none">
                                                        <span class="text-indigo-700">Sash</span> added you to the
                                                        group: <span class="text-indigo-700">UX Designers</span>
                                                    </p>
                                                    <div tabindex="0" aria-label="close icon" role="button"
                                                        class="focus:outline-none cursor-pointer">
                                                        <svg width="14" height="14" viewBox="0 0 14 14"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.5 3.5L3.5 10.5" stroke="#4B5563"
                                                                stroke-width="1.25" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M3.5 3.5L10.5 10.5" stroke="#4B5563"
                                                                stroke-width="1.25" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <p tabindex="0"
                                                    class="focus:outline-none text-xs leading-3 pt-1 text-gray-500">2
                                                    hours ago</p>
                                            </div>
                                        </div>

                                        <div class="w-full p-3 mt-4 bg-white rounded flex">
                                            <div tabindex="0" aria-label="post icon" role="img"
                                                class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                                            </div>
                                            <div class="pl-3">
                                                <p tabindex="0" class="focus:outline-none text-sm leading-none">
                                                    <span class="text-indigo-700">Sarah</span> posted in the thread:
                                                    <span class="text-indigo-700">Update gone wrong</span>
                                                </p>
                                                <p tabindex="0"
                                                    class="focus:outline-none text-xs leading-3 pt-1 text-gray-500">2
                                                    hours ago</p>
                                            </div>
                                        </div>

                                        <div class="w-full p-3 mt-4 bg-red-100 rounded flex items-center">
                                            <div tabindex="0" aria-label="storage icon" role="img"
                                                class="focus:outline-none w-8 h-8 border rounded-full border-red-200 flex items-center flex-shrink-0 justify-center">
                                            </div>
                                            <div class="pl-3 w-full flex items-center justify-between">
                                                <p tabindex="0"
                                                    class="focus:outline-none text-sm leading-none text-red-700">Low on
                                                    storage: 2.5/32gb remaining</p>
                                                <p tabindex="0"
                                                    class="focus:outline-none text-xs leading-3 cursor-pointer underline text-right text-red-700">
                                                    Manage</p>
                                            </div>
                                        </div>

                                        <div class="w-full p-3 mt-4 bg-white rounded flex">
                                            <div tabindex="0" aria-label="loading icon" role="img"
                                                class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                                            </div>
                                            <div class="pl-3">
                                                <p tabindex="0" class="focus:outline-none text-sm leading-none">
                                                    Shipment delayed for order<span class="text-indigo-700">
                                                        #25551</span></p>
                                                <p tabindex="0"
                                                    class="focus:outline-none text-xs leading-3 pt-1 text-gray-500">2
                                                    hours ago</p>
                                            </div>
                                        </div>

                                        <h2 tabindex="0"
                                            class="focus:outline-none text-sm leading-normal pt-8 border-b pb-2 border-gray-300 text-gray-600">
                                            YESTERDAY</h2>

                                        <div class="w-full p-3 mt-6 bg-white rounded flex">
                                            <div tabindex="0" aria-label="post icon" role="img"
                                                class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.30325 12.6667L1.33325 15V2.66667C1.33325 2.48986 1.40349 2.32029 1.52851 2.19526C1.65354 2.07024 1.82311 2 1.99992 2H13.9999C14.1767 2 14.3463 2.07024 14.4713 2.19526C14.5963 2.32029 14.6666 2.48986 14.6666 2.66667V12C14.6666 12.1768 14.5963 12.3464 14.4713 12.4714C14.3463 12.5964 14.1767 12.6667 13.9999 12.6667H4.30325ZM5.33325 6.66667V8H10.6666V6.66667H5.33325Z"
                                                        fill="#4338CA" />
                                                </svg>
                                            </div>
                                            <div class="pl-3">
                                                <p tabindex="0" class="focus:outline-none text-sm leading-none">
                                                    <span class="text-indigo-700">A new article</span> has been added
                                                    to the <span class="text-indigo-700">blog</span>
                                                </p>
                                                <p tabindex="0"
                                                    class="focus:outline-none text-xs leading-3 pt-1 text-gray-500">2
                                                    hours ago</p>
                                            </div>
                                        </div>

                                        <div class="w-full p-3 mt-4 bg-white rounded flex">
                                            <div tabindex="0" aria-label="group icon" role="img"
                                                class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7.99984 8C10.6665 8 12.6665 6 12.6665 4C12.6665 3.33333 12.0002 3 11.3335 3C10.6665 3 10.0002 3.33333 10.0002 4C10.0002 4.66667 9.33384 5 8.6665 5C8.00017 5 7.33384 4.66667 7.33384 4C7.33384 3.33333 7.99984 3 8.6665 3C9.33317 3 10.0005 3.33333 10.0005 4C10.0005 5 9.33317 6 7.99984 6C6.6665 6 5.99984 6.66667 5.99984 7.33333C5.99984 8.00067 6.6665 8.66667 8.00017 8.66667C9.33384 8.66667 10.0005 8 10.0005 8.66667C10.0005 9.33333 9.33384 10 8.00017 10C6.6665 10 5.33384 9.33333 5.33384 8C5.33384 6.66667 7.33384 6 7.99984 6C8.6665 6 9.33317 5.33333 9.33317 4C9.33317 3.33333 8.6665 3 8.00017 3C7.33384 3 6.6665 3.33333 6.6665 4C6.6665 5 7.33384 6 8.00017 6C8.6665 6 9.33317 5.33333 9.33317 4C9.33317 3.33333 8.6665 3 8.00017 3C7.33384 3 6.6665 3.33333 6.6665 4C6.6665 5 7.33384 6 8.00017 6C8.6665 6 9.33317 5.33333 9.33317 4C9.33317 3.33333 8.6665 3 8.00017 3C7.33384 3 6.6665 3.33333 6.6665 4C6.6665 5 7.33384 6 8.00017 6C8.6665 6 9.33317 5.33333 9.33317 4C9.33317 3.33333 8.6665 3 8.00017 3C7.33384 3 6.6665 3.33333 6.6665 4C6.6665 5 7.33384 6 8.00017 6C8.6665 6 9.33317 5.33333 9.33317 4C9.33317 3.33333 8.6665 3 8.00017 3C7.33384 3 6.6665 3.33333 6.6665 4C6.6665 5 7.33384 6 8.00017 6C8.6665 6 9.33317 5.33333 9.33317 4C9.33317 3.33333 8.6665 3 8.00017 3C7.33384 3 6.6665 3.33333 6.6665 4C6.6665 5 7.33384 6 8.00017 6C8.6665 6 9.33317 5.33333 9.33317 4C9.33317 3.33333 8.6665 3 8.00017 3C7.33384 3 6.6665 3.33333 6.6665 4C6.6665 5 7.33384 6 8.00017 6C8.6665 6 9.33317 5.33333 9.33317 4C9.33317 3.33333 8.6665 3 8.00017 3Z"
                                                        fill="#4338CA" />
                                                </svg>
                                            </div>
                                            <div class="pl-3">
                                                <p tabindex="0" class="focus:outline-none text-sm leading-none">A
                                                    new update has been released!</p>
                                                <p tabindex="0"
                                                    class="focus:outline-none text-xs leading-3 pt-1 text-gray-500">1
                                                    day ago</p>
                                            </div>
                                        </div>

                                        <div class="w-full p-3 mt-4 bg-white rounded flex">
                                            <div tabindex="0" aria-label="loading icon" role="img"
                                                class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                                            </div>
                                            <div class="pl-3">
                                                <p tabindex="0" class="focus:outline-none text-sm leading-none">A
                                                    new comment has been added to your post.</p>
                                                <p tabindex="0"
                                                    class="focus:outline-none text-xs leading-3 pt-1 text-gray-500">1
                                                    day ago</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </section>
        </div>

    </div>
    <!-- component -->
@endsection
