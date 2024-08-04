@extends('layouts.app')
@section('content')
    <div class="mt-12">
        <div class="mt-12">
            <div class="flex flex-col items-center justify-center">
                <h1 class="text-2xl font-bold text-slate-800">
                    Lista de Tu combo
                </h1>
            </div>
        </div>
        <div class="justify-center">
            <div>
                <div class="flex justify-center items-center">
                    <div
                        class="mb-3 flex w-full max-w-screen-xl transform cursor-pointer flex-col justify-between rounded-md bg-white bg-opacity-75 p-6 text-slate-800 transition duration-500 ease-in-out hover:-translate-y-1 hover:shadow-lg lg:flex-row lg:p-4">

                        <div class="flex w-full flex-row lg:w-3/12">
                            <div class="relative flex flex-col">
                                <div
                                    class="flex h-12 w-12 flex-shrink-0 flex-col justify-center rounded-full bg-slate-200 bg-opacity-50 dark:bg-slate-600">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&w=128&h=128&q=60&facepad=1.5"
                                        class="z-10 h-12 w-12 rounded-full object-cover shadow hover:shadow-xl"
                                        alt="Rocky Balboa" />
                                </div>
                            </div>

                            <div class="ml-4 self-center overflow-x-hidden">
                                <div class="w-full truncate text-xl font-extrabold leading-5 tracking-tight">
                                    caca
                                </div>
                                <div class="text-sm text-slate-500">
                                    caca
                                </div>
                            </div>
                        </div>

                        <div class="w-full self-center pt-4 lg:w-1/6 lg:pt-0">
                            <div class="ml-1">
                                <div class="text-xl text-black font-extrabold leading-5 tracking-tight">caca
                                </div>
                            </div>
                        </div>

                        <div class="w-full self-center px-1 pt-4 pb-2 lg:w-1/6 lg:px-0 lg:pt-0 lg:pb-0">
                            <div class="">

                                <a href="">
                                    <button class="bg-blue-500 rounded-xl p-2 px-4">
                                        <p class="text-white font-bold">
                                            Editar
                                        </p>
                                    </button>
                                </a>


                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="rounded-2xl bg-blue-600 grid grid-cols-3">
                <div>
                    Descuento
                </div>
                <div>
                    Precio
                </div>
                <div>
                    Total
                </div>
            </div>
        </div>
    </div>
@endsection
