@extends('layouts.paid')
@section('content')
    <section>
        <div class="relative h-full isolate px-6 lg:px-8">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-xl sm:-top-80" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#47af80] to-[#00ff1e]] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
            <div class=" text-black font-sans antialiased py-8">
                <div class="container mx-auto flex flex-col items-center ">
                    <div class="overflow-y-auto sm:p-0 pt-4 pr-4 pb-20 pl-4 ">
                        <div class="flex justify-center items-end text-center min-h-screen sm:block">
                            <div class="bg-gray-500 transition-opacity bg-opacity-75"></div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">​</span>
                            <div
                                class= "inline-block text-left bg-slate-200 rounded-lg overflow-hidden align-bottom transition-all transform shadow-2xl sm:my-8 sm:align-middle sm:max-w-xl sm:w-full">
                                <div class="items-center w-full mr-auto ml-auto relative max-w-7xl md:px-12 lg:px-24">
                                    <div class="grid grid-cols-1">
                                        <div class="mt-4 mr-auto mb-4 ml-auto  max-w-lg">
                                            <div class="flex flex-col items-center pt-6 pr-6 pb-6 pl-6">
                                                <img src="https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;w=500"
                                                    class="flex-shrink-0 object-cover object-center btn- flex w-16 h-16 mr-auto -mb-8 ml-auto border border-green-500 rounded-full shadow-xl">
                                                <p
                                                    class="mt-8 text-2xl font-semibold leading-none text-slate-950 tracking-tighter lg:text-3xl">
                                                    El pago fue exitoso</p>
                                                <p class="mt-3 text-base leading-relaxed text-center text-slate-950 ">Lorem
                                                    ipsum dolor sit, amet consectetur adipisicing elit. Fugit, in vel.
                                                    Facilis cumque esse sequi minima optio, amet cupiditate doloremque,
                                                    maxime nemo voluptatum veniam asperiores totam, quas a vitae similique.s
                                                </p>
                                                <div class="w-full mt-6">
                                                    <a href="{{ url('/') }}"
                                                        class="flex text-center items-center justify-center w-full pt-4 pr-10 pb-4 pl-10 text-base
                                                        font-medium text-white bg-indigo-600 rounded-xl transition duration-500 ease-in-out transform hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Seguir
                                                        comprando</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr  from-[#47af80] to-[#00ff1e] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>
    </section>
@endsection
