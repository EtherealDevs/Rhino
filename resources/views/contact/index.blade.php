@extends('layouts.app')
@section('content')
    <div class="h-screen flex">
        <div class="w-screen mx-auto">
            <div>
              <div>
                <h2 class="absolute flex mx-auto w-full text-3xl font-extrabold uppercase mt-12 justify-center">
                    Pagina de  <span class="text-white ml-3">Contacto</span> 
                </h2>
              </div>
                
                <div class="grid grid-cols-2 h-screen">

                    <div class="bg-white">
                        h
                    </div>

                    <div class="bg-blue-600">
                        <div class=" items-center justify-end">
                            <div class="flex mx-auto my-auto h-full w-full max-w-lg">
                                <p class="text-white mt-3">Email us at help@domain.com or message us here:</p>

                                <form action="https://api.web3forms.com/submit" class="mt-10">

                                    <input type="hidden" name="access_key" value="YOUR_ACCESS_KEY_HERE" />
                                    <div class="grid gap-6 sm:grid-cols-1">
                                        <div class="relative z-0">
                                            <input type="text" name="name"
                                                class="peer block w-full appearance-none border-0 border-b border-white bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-200 focus:outline-none focus:ring-0"
                                                placeholder=" " />
                                            <label
                                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-white duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-200">Nombre y Apellido
                                            </label>
                                        </div>
                                        <div class="relative z-0">
                                            <input type="text" name="email"
                                                class="peer block w-full appearance-none border-0 border-b border-white bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-200 focus:outline-none focus:ring-0"
                                                placeholder=" " />
                                            <label
                                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-white duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-200 peer-focus:dark:text-blue-500">Tu
                                                email</label>
                                        </div>
                                        <div class="relative z-0 col-span-1">
                                            <textarea name="message" rows="5"
                                                class="peer block w-full appearance-none border-0 border-b border-white bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-200 focus:outline-none focus:ring-0"
                                                placeholder=" "></textarea>
                                            <label
                                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-white duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-200 peer-focus:dark:text-blue-500">Tu
                                                mensaje</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="mt-5 rounded-md bg-white px-10 py-2 text-black">Enviar Mensaje</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
