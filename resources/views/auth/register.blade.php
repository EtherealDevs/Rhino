<x-guest-layout>
    <div
        class="bg-blue-900 absolute flex justify-center top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-blue-800 bottom-0 leading-5 h-full w-full overflow-hidden">
        <div>
            <img class=" flex xl:ml-2 lg:ml-2 lg:px-8 xl:w-48 2xl:w-48 lg:w-48 w-24 mt-12" src="/img/rino-white.png"
                alt="Your Company">
        </div>
    </div>
    <div
        class="mt-32 lg:mt-12 relative min-h-screen sm:flex sm:flex-row justify-center bg-transparent rounded-3xl shadow-xl">
        <div class="flex-col flex self-center lg:px-8 sm:max-w-4xl xl:max-w-md z-10">
            <div class="self-start hidden lg:flex flex-col text-gray-300">
                <h1 class="my-3 font-semibold text-4xl">¡Bienvenido a Rino Indumentaria!</h1>
                <p class="pr-3 text-lg opacity-75">Nos alegra que hayas decidido unirte a nuestra Tienda. Completa el
                    formulario a continuación para crear tu cuenta y comenzar a disfrutar de todas los productos que
                    ofrecemos.</p>
            </div>
        </div>
        <div class="flex justify-center self-center z-10">
            <div class="bg-blue-800/70 rounded-3xl h-full translate-x-3 translate-y-3">
                <div class="p-12 -translate-x-3 -translate-y-3 bg-white mx-auto rounded-3xl w-96 ">
                    <div class="mb-7">
                        <h3 class="font-semibold text-2xl text-gray-800">Registrate</h3>
                        <p class="text-gray-400">ya tienes una Cuenta? <a href="{{ route('login') }}"
                                class="text-sm text-purple-700 hover:text-purple-700">Inicia Sesion</a></p>
                    </div>
                    <div class="space-y-6">
                        @session('status')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ $value }}
                            </div>
                        @endsession

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div>
                                <x-label for="name" value="{{ __('Nombre') }}" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus autocomplete="name" />
                            </div>
                            
                            <div>
                                <x-label for="last_name" value="{{ __('Apellido') }}" />
                                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                    :value="old('last_name')" required autofocus autocomplete="last_name" />
                            </div>

                            <div class="mt-4">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" required autocomplete="username" />
                            </div>

                            <div class="mt-4">
                                <x-label for="password" value="{{ __('Contraseña') }}" />
                                <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    required autocomplete="new-password" />
                            </div>

                            <div class="mt-4">
                                <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-label for="terms">
                                        <div class="flex items-center">
                                            <x-checkbox name="terms" id="terms" required />

                                            <div class="ms-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                    'terms_of_service' =>
                                                        '<a target="_blank" href="' .
                                                        route('terms.show') .
                                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                        __('Terms of Service') .
                                                        '</a>',
                                                    'privacy_policy' =>
                                                        '<a target="_blank" href="' .
                                                        route('policy.show') .
                                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                        __('Privacy Policy') .
                                                        '</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-label>
                                </div>
                            @endif

                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    href="{{ route('login') }}">
                                    {{ __('Ya estoy registrado') }}
                                </a>

                                <x-button class="ms-4">
                                    {{ __('Registrar') }}
                                </x-button>
                            </div>
                        </form>
                        <div class="flex items-center justify-center space-x-2 my-5">
                            <span class="h-px w-16 bg-gray-100"></span>
                            <span class="text-gray-300 font-normal">o tambien podes hacerlo con</span>
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

                            <a href="{{ route('auth.redirect.facebook') }}"
                                class="w-full flex items-center justify-center mb-6 md:mb-0 border border-gray-300 hover:border-gray-900 hover:bg-gray-900 text-sm text-gray-500 p-3  rounded-lg tracking-wide font-medium  cursor-pointer transition ease-in duration-500 px-">
                                <svg class="w-4 mr-2" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100"
                                    xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                    {{-- <style>
                                        .st0 {
                                            fill: #fff
                                        }

                                        .st1 {
                                            fill: #f5bb41
                                        }

                                        .st2 {
                                            fill: #2167d1
                                        }

                                        .st3 {
                                            fill: #3d84f3
                                        }

                                        .st4 {
                                            fill: #4ca853
                                        }

                                        .st5 {
                                            fill: #398039
                                        }

                                        .st6 {
                                            fill: #d74f3f
                                        }

                                        .st7 {
                                            fill: #d43c89
                                        }

                                        .st8 {
                                            fill: #b2005f
                                        }

                                        .st9 {
                                            stroke: #000
                                        }

                                        .st10,
                                        .st11,
                                        .st9 {
                                            fill: none;
                                            stroke-width: 3;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-miterlimit: 10
                                        }

                                        .st10 {
                                            fill-rule: evenodd;
                                            clip-rule: evenodd;
                                            stroke: #000
                                        }

                                        .st11 {
                                            stroke: #040404
                                        }

                                        .st11,
                                        .st12,
                                        .st13 {
                                            fill-rule: evenodd;
                                            clip-rule: evenodd
                                        }

                                        .st13 {
                                            fill: #040404
                                        }

                                        .st14 {
                                            fill: url(#SVGID_1_)
                                        }

                                        .st15 {
                                            fill: url(#SVGID_2_)
                                        }

                                        .st16 {
                                            fill: url(#SVGID_3_)
                                        }

                                        .st17 {
                                            fill: url(#SVGID_4_)
                                        }

                                        .st18 {
                                            fill: url(#SVGID_5_)
                                        }

                                        .st19 {
                                            fill: url(#SVGID_6_)
                                        }

                                        .st20 {
                                            fill: url(#SVGID_7_)
                                        }

                                        .st21 {
                                            fill: url(#SVGID_8_)
                                        }

                                        .st22 {
                                            fill: url(#SVGID_9_)
                                        }

                                        .st23 {
                                            fill: url(#SVGID_10_)
                                        }

                                        .st24 {
                                            fill: url(#SVGID_11_)
                                        }

                                        .st25 {
                                            fill: url(#SVGID_12_)
                                        }

                                        .st26 {
                                            fill: url(#SVGID_13_)
                                        }

                                        .st27 {
                                            fill: url(#SVGID_14_)
                                        }

                                        .st28 {
                                            fill: url(#SVGID_15_)
                                        }

                                        .st29 {
                                            fill: url(#SVGID_16_)
                                        }

                                        .st30 {
                                            fill: url(#SVGID_17_)
                                        }

                                        .st31 {
                                            fill: url(#SVGID_18_)
                                        }

                                        .st32 {
                                            fill: url(#SVGID_19_)
                                        }

                                        .st33 {
                                            fill: url(#SVGID_20_)
                                        }

                                        .st34 {
                                            fill: url(#SVGID_21_)
                                        }

                                        .st35 {
                                            fill: url(#SVGID_22_)
                                        }

                                        .st36 {
                                            fill: url(#SVGID_23_)
                                        }

                                        .st37 {
                                            fill: url(#SVGID_24_)
                                        }

                                        .st38 {
                                            fill: url(#SVGID_25_)
                                        }

                                        .st39 {
                                            fill: url(#SVGID_26_)
                                        }

                                        .st40 {
                                            fill: url(#SVGID_27_)
                                        }

                                        .st41 {
                                            fill: url(#SVGID_28_)
                                        }

                                        .st42 {
                                            fill: url(#SVGID_29_)
                                        }

                                        .st43 {
                                            fill: url(#SVGID_30_)
                                        }

                                        .st44 {
                                            fill: url(#SVGID_31_)
                                        }

                                        .st45 {
                                            fill: url(#SVGID_32_)
                                        }

                                        .st46 {
                                            fill: url(#SVGID_33_)
                                        }

                                        .st47 {
                                            fill: url(#SVGID_34_)
                                        }

                                        .st48 {
                                            fill: url(#SVGID_35_)
                                        }

                                        .st49 {
                                            fill: url(#SVGID_36_)
                                        }

                                        .st50 {
                                            fill: url(#SVGID_37_)
                                        }

                                        .st51 {
                                            fill: url(#SVGID_38_)
                                        }

                                        .st52 {
                                            fill: url(#SVGID_39_)
                                        }

                                        .st53 {
                                            fill: url(#SVGID_40_)
                                        }

                                        .st54 {
                                            fill: url(#SVGID_41_)
                                        }

                                        .st55 {
                                            fill: url(#SVGID_42_)
                                        }

                                        .st56 {
                                            fill: url(#SVGID_43_)
                                        }

                                        .st57 {
                                            fill: url(#SVGID_44_)
                                        }

                                        .st58 {
                                            fill: url(#SVGID_45_)
                                        }

                                        .st59 {
                                            fill: #040404
                                        }

                                        .st60 {
                                            fill: url(#SVGID_46_)
                                        }

                                        .st61 {
                                            fill: url(#SVGID_47_)
                                        }

                                        .st62 {
                                            fill: url(#SVGID_48_)
                                        }

                                        .st63 {
                                            fill: url(#SVGID_49_)
                                        }

                                        .st64 {
                                            fill: url(#SVGID_50_)
                                        }

                                        .st65 {
                                            fill: url(#SVGID_51_)
                                        }

                                        .st66 {
                                            fill: url(#SVGID_52_)
                                        }

                                        .st67 {
                                            fill: url(#SVGID_53_)
                                        }

                                        .st68 {
                                            fill: url(#SVGID_54_)
                                        }

                                        .st69 {
                                            fill: url(#SVGID_55_)
                                        }

                                        .st70 {
                                            fill: url(#SVGID_56_)
                                        }

                                        .st71 {
                                            fill: url(#SVGID_57_)
                                        }

                                        .st72 {
                                            fill: url(#SVGID_58_)
                                        }

                                        .st73 {
                                            fill: url(#SVGID_59_)
                                        }

                                        .st74 {
                                            fill: url(#SVGID_60_)
                                        }

                                        .st75 {
                                            fill: url(#SVGID_61_)
                                        }

                                        .st76 {
                                            fill: url(#SVGID_62_)
                                        }

                                        .st77,
                                        .st78 {
                                            fill: none;
                                            stroke-miterlimit: 10
                                        }

                                        .st77 {
                                            stroke: #000;
                                            stroke-width: 3
                                        }

                                        .st78 {
                                            stroke: #fff
                                        }

                                        .st79 {
                                            fill: #4bc9ff
                                        }

                                        .st80 {
                                            fill: #50d
                                        }

                                        .st81 {
                                            fill: #ff3a00
                                        }

                                        .st82 {
                                            fill: #e6162d
                                        }

                                        .st84 {
                                            fill: #f93
                                        }

                                        .st85 {
                                            fill: #b92b27
                                        }

                                        .st86 {
                                            fill: #00aced
                                        }

                                        .st87 {
                                            fill: #bd2125
                                        }

                                        .st89 {
                                            fill: #6665d2
                                        }

                                        .st90 {
                                            fill: #ce3056
                                        }

                                        .st91 {
                                            fill: #5bb381
                                        }

                                        .st92 {
                                            fill: #61c3ec
                                        }

                                        .st93 {
                                            fill: #e4b34b
                                        }

                                        .st94 {
                                            fill: #181ef2
                                        }

                                        .st95 {
                                            fill: red
                                        }

                                        .st96 {
                                            fill: #fe466c
                                        }

                                        .st97 {
                                            fill: #fa4778
                                        }

                                        .st98 {
                                            fill: #f70
                                        }

                                        .st99 {
                                            fill-rule: evenodd;
                                            clip-rule: evenodd;
                                            fill: #1f6bf6
                                        }

                                        .st100 {
                                            fill: #520094
                                        }

                                        .st101 {
                                            fill: #4477e8
                                        }

                                        .st102 {
                                            fill: #3d1d1c
                                        }

                                        .st103 {
                                            fill: #ffe812
                                        }

                                        .st104 {
                                            fill: #344356
                                        }

                                        .st105 {
                                            fill: #00cc76
                                        }

                                        .st106 {
                                            fill-rule: evenodd;
                                            clip-rule: evenodd;
                                            fill: #345e90
                                        }

                                        .st107 {
                                            fill: #1f65d8
                                        }

                                        .st108 {
                                            fill: #eb3587
                                        }

                                        .st109 {
                                            fill-rule: evenodd;
                                            clip-rule: evenodd;
                                            fill: #603a88
                                        }

                                        .st110 {
                                            fill: #e3ce99
                                        }

                                        .st111 {
                                            fill: #783af9
                                        }

                                        .st112 {
                                            fill: #ff515e
                                        }

                                        .st113 {
                                            fill: #ff4906
                                        }

                                        .st114 {
                                            fill: #503227
                                        }

                                        .st115 {
                                            fill: #4c7bd9
                                        }

                                        .st116 {
                                            fill: #69c9d0
                                        }

                                        .st117 {
                                            fill: #1b92d1
                                        }

                                        .st118 {
                                            fill: #eb4f4a
                                        }

                                        .st119 {
                                            fill: #513728
                                        }

                                        .st120 {
                                            fill: #f60
                                        }

                                        .st121 {
                                            fill-rule: evenodd;
                                            clip-rule: evenodd;
                                            fill: #b61438
                                        }

                                        .st122 {
                                            fill: #fffc00
                                        }

                                        .st123 {
                                            fill: #141414
                                        }

                                        .st124 {
                                            fill: #94d137
                                        }

                                        .st125,
                                        .st126 {
                                            fill-rule: evenodd;
                                            clip-rule: evenodd;
                                            fill: #f1f1f1
                                        }

                                        .st126 {
                                            fill: #66e066
                                        }

                                        .st127 {
                                            fill: #2d8cff
                                        }

                                        .st128 {
                                            fill: #f1a300
                                        }

                                        .st129 {
                                            fill: #4ba2f2
                                        }

                                        .st130 {
                                            fill: #1a5099
                                        }

                                        .st131 {
                                            fill: #ee6060
                                        }

                                        .st132 {
                                            fill-rule: evenodd;
                                            clip-rule: evenodd;
                                            fill: #f48120
                                        }

                                        .st133 {
                                            fill: #222
                                        }

                                        .st134 {
                                            fill: url(#SVGID_63_)
                                        }

                                        .st135 {
                                            fill: #0077b5
                                        }

                                        .st136 {
                                            fill: #fc0
                                        }

                                        .st137 {
                                            fill: #eb3352
                                        }

                                        .st138 {
                                            fill: #f9d265
                                        }

                                        .st139 {
                                            fill: #f5b955
                                        }

                                        .st140 {
                                            fill: #dd2a7b
                                        }

                                        .st141 {
                                            fill: #66e066
                                        }

                                        .st142 {
                                            fill: #eb4e00
                                        }

                                        .st143 {
                                            fill: #ffc794
                                        }

                                        .st144 {
                                            fill: #b5332a
                                        }

                                        .st145 {
                                            fill: #4e85eb
                                        }

                                        .st146 {
                                            fill: #58a45c
                                        }

                                        .st147 {
                                            fill: #f2bc42
                                        }

                                        .st148 {
                                            fill: #d85040
                                        }

                                        .st149 {
                                            fill: #464eb8
                                        }

                                        .st150 {
                                            fill: #7b83eb
                                        }
                                    </style> --}}
                                    <g id="Layer_1" />
                                    <g id="Layer_2">
                                        <path
                                            d="M50 2.5c-58.892 1.725-64.898 84.363-7.46 95h14.92c57.451-10.647 51.419-93.281-7.46-95z"
                                            style="fill:#1877f2" />
                                        <path
                                            d="M57.46 64.104h11.125l2.117-13.814H57.46v-8.965c0-3.779 1.85-7.463 7.781-7.463h6.021V22.101c-12.894-2.323-28.385-1.616-28.722 17.66V50.29H30.417v13.814H42.54V97.5h14.92V64.104z"
                                            style="fill:#f1f1f1" />
                                    </g>
                                </svg>
                                <span>Facebook</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
</x-guest-layout>
