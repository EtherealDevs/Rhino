<x-guest-layout>
    <div
        class="bg-blue-900 overflow-scroll absolute flex justify-center bg-gradient-to-b from-gray-900 via-gray-900 to-blue-800 bottom-0 leading-5 h-full w-full">
        <div class="grid grid-cols-6">
            <div class="col-span-6 flex justify-center">
                <img class="xl:w-46 lg:w-48 w-36 lg:h-24 mt-12" src="/img/rino-white.png" alt="Your Company">
            </div>
            <div class="col-span-6 lg:col-span-2 flex-col flex self-center lg:px-8 sm:max-w-4xl xl:max-w-md z-10">
                <div class="self-start w-11/12 justify-center flex mx-8 lg: lg:flex flex-col text-gray-300">
                    <h1 class="my-3 font-semibold text-4xl">Hola de Nuevo!!</h1>
                    <p class="pr-3 text-lg opacity-75">Nos alegra verte de nuevo en Rino. Inicia sesión para acceder a
                        todas
                        tus funcionalidades y continuar donde lo dejaste.</p>
                </div>
            </div>
            <div class="col-span-6 lg:col-span-4 flex justify-center self-center m-6 z-10">
                <div class="bg-blue-800/70 rounded-3xl h-full translate-x-3 translate-y-3">
                    <div class="p-12 -translate-x-3 -translate-y-3 bg-white mx-auto rounded-3xl w-96 ">
                        <div class="mb-7">
                            <h3 class="font-semibold text-2xl text-gray-800">Inicia Sesion</h3>
                            <p class="text-gray-400">No tienes una Cuenta? <a href="{{ route('register') }}"
                                    class="text-sm text-purple-700 hover:text-purple-700">Registrate aqui</a></p>
                        </div>
                        <div class="space-y-6">
                            @session('status')
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ $value }}
                                </div>
                            @endsession

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div>
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username" />
                                    @error('email')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-4">
                                    <x-label for="password" value="{{ __('Password') }}" />
                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                        required autocomplete="current-password" />
                                    @error('password')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="block mt-4">
                                    <label for="remember_me" class="flex items-center">
                                        <x-checkbox id="remember_me" name="remember" />
                                        <span class="ms-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                                    </label>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            href="{{ route('password.request') }}">
                                            {{ __('Olvide mi contraseña') }}
                                        </a>
                                    @endif

                                    <x-button class="ms-4">
                                        {{ __('Iniciar') }}
                                    </x-button>
                                </div>
                            </form>
                            <div class="flex items-center justify-center space-x-2 my-5">
                                <span class="h-px w-16 bg-gray-100"></span>
                                <span class="text-gray-300 font-normal">o tambien podes iniciar con</span>
                                <span class="h-px w-16 bg-gray-100"></span>
                            </div>
                            <div class="flex justify-center gap-5 w-full ">

                                <a href="{{ route('auth.redirect.google') }}"
                                    class="w-full flex items-center justify-center mb-6 md:mb-0 border border-gray-300 hover:border-gray-900 hover:bg-gray-900 text-sm text-gray-500 p-3 rounded-lg tracking-wide font-medium cursor-pointer transition ease-in duration-500">
                                    <svg class="w-4 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="#EA4335"
                                            d="M5.266 9.765A7.077 7.077 0 0 1 12 4.909c1.69 0 3.218.6 4.418 1.582L19.91 3C17.782 1.145 15.055 0 12 0 7.27 0 3.198 2.698 1.24 6.65l4.026 3.115Z" />
                                        <path fill="#34A853"
                                            d="M16.04 18.013c-1.09.703-2.474 1.078-4.04 1.078a7.077 7.077 0 0 1-6.723-4.823l-4.04 3.067A11.965 11.965 0 0 0 12 24c2.933 0 5.735-1.043 7.834-3l-3.793-2.987Z" />
                                        <path fill="#4A90E2"
                                            d="M19.834 21c2.195-2.048 3.62-5.096 3.62-9 0-.71-.109-1.473-.272-2.182H12v4.637h6.436c-.317 1.559-1.17 2.766-2.395 3.558L19.834 21Z" />
                                        <path fill="#FBBC05"
                                            d="M5.277 14.268A7.12 7.12 0 0 1 4.909 12c0-.782.125-1.533.357-2.235L1.24 6.65A11.934 11.934 0 0 0 0 12c0 1.92.445 3.73 1.237 5.335l4.04-3.067Z" />
                                    </svg>
                                    <span>Google</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
</x-guest-layout>
