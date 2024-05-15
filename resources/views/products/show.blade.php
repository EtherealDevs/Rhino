@extends('layouts.app')
@section('content')
    <!-- component -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <div x-data="{ cartOpen: false, isOpen: false }" class="bg-white">

        <div class="container mx-auto px-6">
            <div class="md:flex md:items-center">
                <div class="w-full h-64 md:w-1/2 lg:h-96">
                    <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto"
                        src="https://images.unsplash.com/photo-1578262825743-a4e402caab76?ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80"
                        alt="Nike Air">
                </div>
                <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                    <h3 class="text-gray-700 uppercase text-lg">Nike Air</h3>
                    <span class="text-gray-500 mt-3">$125</span>
                    <hr class="my-3">
                    <div class="mt-2">
                        <label class="text-gray-700 text-sm" for="count">Count:</label>
                        <div class="flex items-center mt-1">
                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </button>
                            <span class="text-gray-700 text-lg mx-2">20</span>
                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="text-gray-700 text-sm" for="count">Color:</label>
                        <div class="flex items-center mt-1">
                            <button
                                class="h-5 w-5 rounded-full bg-blue-600 border-2 border-blue-200 mr-2 focus:outline-none"></button>
                            <button class="h-5 w-5 rounded-full bg-teal-600 mr-2 focus:outline-none"></button>
                            <button class="h-5 w-5 rounded-full bg-pink-600 mr-2 focus:outline-none"></button>
                        </div>
                    </div>
                    <div class="flex items-center mt-6">
                        <button
                            class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Order
                            Now</button>
                        <button class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="flex flex-col justify-center">
                    <div class="relative m-3 flex flex-wrap mx-auto justify-center">
            
                        <div class="relative max-w-sm min-w-[340px] bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
                            <div class="overflow-x-hidden rounded-2xl relative">
                                <img class="h-40 rounded-2xl w-full object-cover"
                                    src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg">
                                <p class="absolute right-2 top-2 bg-white rounded-full p-2 cursor-pointer group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-50 opacity-70"
                                        fill="none" viewBox="0 0 24 24" stroke="black">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </p>
                            </div>
                            <div class="mt-4 pl-2 mb-2 flex justify-between ">
                                <div>
                                    <p class="text-lg font-semibold text-gray-900 mb-0">Product Name</p>
                                    <p class="text-md text-gray-800 mt-0">$340</p>
                                </div>
                                <div class="flex flex-col-reverse mb-1 mr-4 group cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-70" fill="none"
                                        viewBox="0 0 24 24" stroke="gray">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="relative max-w-sm min-w-[340px] bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
                            <div class="overflow-x-hidden rounded-2xl relative">
                                <img class="h-40 rounded-2xl w-full object-cover"
                                    src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg">
                                <p class="absolute right-2 top-2 bg-white rounded-full p-2 cursor-pointer group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-50 opacity-70"
                                        fill="none" viewBox="0 0 24 24" stroke="black">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </p>
                            </div>
                            <div class="mt-4 pl-2 mb-2 flex justify-between ">
                                <div>
                                    <p class="text-lg font-semibold text-gray-900 mb-0">Product Name</p>
                                    <p class="text-md text-gray-800 mt-0">$340</p>
                                </div>
                                <div class="flex flex-col-reverse mb-1 mr-4 group cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-70" fill="none"
                                        viewBox="0 0 24 24" stroke="gray">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="relative max-w-sm min-w-[340px] bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
                            <div class="overflow-x-hidden rounded-2xl relative">
                                <img class="h-40 rounded-2xl w-full object-cover"
                                    src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg">
                                <p class="absolute right-2 top-2 bg-white rounded-full p-2 cursor-pointer group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-50 opacity-70"
                                        fill="none" viewBox="0 0 24 24" stroke="black">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </p>
                            </div>
                            <div class="mt-4 pl-2 mb-2 flex justify-between ">
                                <div>
                                    <p class="text-lg font-semibold text-gray-900 mb-0">Product Name</p>
                                    <p class="text-md text-gray-800 mt-0">$340</p>
                                </div>
                                <div class="flex flex-col-reverse mb-1 mr-4 group cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-70" fill="none"
                                        viewBox="0 0 24 24" stroke="gray">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="relative max-w-sm min-w-[340px] bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
                            <div class="overflow-x-hidden rounded-2xl relative">
                                <img class="h-40 rounded-2xl w-full object-cover"
                                    src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg">
                                <p class="absolute right-2 top-2 bg-white rounded-full p-2 cursor-pointer group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-50 opacity-70"
                                        fill="none" viewBox="0 0 24 24" stroke="black">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </p>
                            </div>
                            <div class="mt-4 pl-2 mb-2 flex justify-between ">
                                <div>
                                    <p class="text-lg font-semibold text-gray-900 mb-0">Product Name</p>
                                    <p class="text-md text-gray-800 mt-0">$340</p>
                                </div>
                                <div class="flex flex-col-reverse mb-1 mr-4 group cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-70" fill="none"
                                        viewBox="0 0 24 24" stroke="gray">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-gray-200">
            <div class="container mx-auto px-6 py-3 flex justify-between items-center">
                <a href="#" class="text-xl font-bold text-gray-500 hover:text-gray-400">Brand</a>
                <p class="py-2 text-gray-500 sm:py-0">All rights reserved</p>
            </div>
        </footer>
    </div>
@endsection