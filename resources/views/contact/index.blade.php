@extends('layouts.app')
@section('content')
    <header>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    </header>
    <div class="absolute grid grid-cols-3 grid-rows-3 h-screen w-screen z-20">

        {{-- Primer Row --}}
        <div class="col-span-3">
            <h2
                class="font-extrabold text-[#332E6C] flex mx-auto w-full text-6xl font-blinker uppercase mt-16 justify-center">
                Pagina de <span class="text-white ml-3">Contacto</span>
            </h2>
        </div>

        {{-- Segundo Row --}}
        <div class="col-span-3 grid grid-cols-6 -translate-y-32">
            <div id="map" class="col-span-4 top-8 mx-auto z-10"></div>
            <div class="col-span-2 w-full px-10 z-20">
                <!-- component -->
                <!-- This is an example component -->
                <div class="max-w-2xl mx-auto">

                    <form>
                        <div class="relative z-0 mb-6 w-full group">
                            <input type="email" name="floating_email"
                                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-blue-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " required />
                            <label for="floating_email"
                                class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                                address</label>
                        </div>
                        <div class="grid xl:grid-cols-2 xl:gap-6">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="floating_first_name" id="floating_first_name"
                                    class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-blue-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="floating_first_name"
                                    class="absolute text-sm text-whte text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First
                                    name</label>
                            </div>
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="floating_last_name" id="floating_last_name"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-200 bg-transparent border-0 border-b-2 border-blue-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="floating_last_name"
                                    class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last
                                    name</label>
                            </div>
                        </div>
                        <div class="grid xl:grid-cols-2 xl:gap-6">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="message" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="floating_phone"
                                    id="floating_phone"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-200 bg-transparent border-0 border-b-2 border-blue-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="floating_phone"
                                    class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mensaje</label>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Tercer Row --}}
        <div class="col-span-3">
            <div class="grid grid-cols-2">
                <div class="col-span-1 mr-4">
                    <div class="w-full mb-4 flex justify-end">
                        <p class="font-bold text-xl font-josefin">Av. Rio Juramento</p>
                        <svg width="31" height="27" viewBox="0 0 31 27" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.5002 12.9375C14.6437 12.9375 13.8224 12.6412 13.2168 12.1137C12.6112 11.5863 12.271 10.8709 12.271 10.125C12.271 9.37908 12.6112 8.66371 13.2168 8.13626C13.8224 7.60882 14.6437 7.3125 15.5002 7.3125C16.3566 7.3125 17.1779 7.60882 17.7835 8.13626C18.3891 8.66371 18.7293 9.37908 18.7293 10.125C18.7293 10.4943 18.6458 10.8601 18.4835 11.2013C18.3212 11.5425 18.0834 11.8526 17.7835 12.1137C17.4837 12.3749 17.1277 12.5821 16.7359 12.7234C16.3441 12.8648 15.9242 12.9375 15.5002 12.9375ZM15.5002 2.25C13.1022 2.25 10.8024 3.07969 9.10674 4.55653C7.4111 6.03338 6.4585 8.03642 6.4585 10.125C6.4585 16.0312 15.5002 24.75 15.5002 24.75C15.5002 24.75 24.5418 16.0312 24.5418 10.125C24.5418 8.03642 23.5892 6.03338 21.8936 4.55653C20.1979 3.07969 17.8982 2.25 15.5002 2.25Z"
                                fill="#297FFF" />
                        </svg>
                    </div>
                    <div class="w-full mb-4 flex justify-end">
                        <p class="font-bold text-xl font-josefin">+54 9 379 479 8404</p>
                        <svg width="28" height="27" viewBox="0 0 28 27" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M25.3619 18.4655C25.1669 19.8946 24.439 21.2064 23.3143 22.1559C22.1895 23.1054 20.7448 23.6276 19.25 23.625C10.5656 23.625 3.50001 16.8117 3.50001 8.43753C3.49733 6.99608 4.03889 5.60298 5.02353 4.51841C6.00818 3.43385 7.36857 2.73199 8.85064 2.54394C9.22541 2.49981 9.60494 2.57374 9.93256 2.7547C10.2602 2.93566 10.5183 3.21394 10.6684 3.548L12.9784 8.52085V8.53351C13.0934 8.78922 13.1409 9.0684 13.1166 9.34612C13.0924 9.62384 12.9972 9.89144 12.8395 10.125C12.8199 10.1535 12.7991 10.1799 12.7772 10.2062L10.5 12.8092C11.3192 14.4144 13.0605 16.0787 14.747 16.8708L17.4092 14.6866C17.4354 14.6654 17.4628 14.6456 17.4913 14.6275C17.7333 14.4718 18.0118 14.3768 18.3015 14.351C18.5912 14.3252 18.883 14.3695 19.1505 14.4798L19.1647 14.4862L24.3174 16.7126C24.6644 16.8569 24.9537 17.1056 25.142 17.4215C25.3302 17.7375 25.4074 18.1037 25.3619 18.4655Z"
                                fill="#297FFF" />
                        </svg>
                    </div>
                    <div class="w-full mb-4 flex justify-end">
                        <p class="font-bold text-xl font-josefin">julia.-castillo@hotmail.com</p>
                        <svg width="27" height="23" viewBox="0 0 27 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4.5 19.1666C3.88125 19.1666 3.35175 18.9791 2.9115 18.604C2.47125 18.229 2.25075 17.7776 2.25 17.2499V5.74992C2.25 5.22284 2.4705 4.77178 2.9115 4.39675C3.3525 4.02172 3.882 3.83389 4.5 3.83325H22.5C23.1187 3.83325 23.6486 4.02109 24.0896 4.39675C24.5306 4.77242 24.7507 5.22347 24.75 5.74992V17.2499C24.75 17.777 24.5299 18.2284 24.0896 18.604C23.6494 18.9797 23.1195 19.1672 22.5 19.1666H4.5ZM13.5 12.4583L22.5 7.66659V5.74992L13.5 10.5416L4.5 5.74992V7.66659L13.5 12.4583Z"
                                fill="#297FFF" />
                        </svg>
                    </div>
                </div>
                <div class="col-span-1 ml-4">
                    <ul class="grid grid-cols-4">
                        <li class="">
                            <a href="">
                                <svg width="45" height="45" viewBox="0 0 45 45" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g filter="url(#filter0_d_351_1050)">
                                        <rect x="4" width="37" height="37" rx="13" fill="white" />
                                        <mask id="mask0_351_1050" style="mask-type:luminance" maskUnits="userSpaceOnUse"
                                            x="13" y="9" width="20" height="20">
                                            <path d="M13.5 9.5H32.5V28.5H13.5V9.5Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_351_1050)">
                                            <path
                                                d="M24.79 9.64002L24.22 9.56002C22.5069 9.31268 20.7588 9.55737 19.1795 10.2656C17.6002 10.9738 16.2548 12.1163 15.3 13.56C14.2842 14.94 13.6786 16.5788 13.553 18.2877C13.4274 19.9967 13.7868 21.7063 14.59 23.22C14.6722 23.3717 14.7234 23.5383 14.7405 23.71C14.7577 23.8817 14.7405 24.055 14.69 24.22C14.28 25.63 13.9 27.05 13.5 28.54L14 28.39C15.35 28.03 16.7 27.67 18.05 27.34C18.3349 27.2808 18.6311 27.3087 18.9 27.42C20.1112 28.0111 21.4348 28.3363 22.782 28.3738C24.1293 28.4113 25.4689 28.1601 26.7111 27.6372C27.9533 27.1144 29.0692 26.3318 29.9841 25.3421C30.899 24.3525 31.5915 23.1785 32.0153 21.8992C32.4392 20.6198 32.5844 19.2646 32.4414 17.9244C32.2983 16.5843 31.8703 15.2903 31.1859 14.1292C30.5016 12.9681 29.5769 11.9668 28.4737 11.1925C27.3706 10.4183 26.1146 9.88892 24.79 9.64002ZM27.31 22.76C26.9466 23.0854 26.5034 23.3087 26.0256 23.407C25.5478 23.5054 25.0524 23.4754 24.59 23.32C22.4946 22.73 20.6766 21.4152 19.46 19.61C18.9953 18.9715 18.6217 18.2715 18.35 17.53C18.2029 17.0998 18.1763 16.6375 18.2733 16.1933C18.3702 15.749 18.587 15.3398 18.9 15.01C19.0524 14.8155 19.2598 14.6714 19.4953 14.5965C19.7307 14.5216 19.9832 14.5194 20.22 14.59C20.42 14.64 20.56 14.93 20.74 15.15C20.886 15.563 21.057 15.967 21.25 16.36C21.3964 16.5605 21.4576 16.8108 21.4201 17.0563C21.3826 17.3017 21.2496 17.5223 21.05 17.67C20.6 18.07 20.67 18.4 20.99 18.85C21.6974 19.8692 22.6736 20.6723 23.81 21.17C24.13 21.31 24.37 21.34 24.58 21.01C24.67 20.88 24.79 20.77 24.89 20.65C25.47 19.92 25.29 19.93 26.21 20.33C26.503 20.453 26.787 20.597 27.06 20.76C27.33 20.92 27.74 21.09 27.8 21.33C27.8577 21.5904 27.8425 21.8616 27.7561 22.1139C27.6696 22.3662 27.5153 22.5898 27.31 22.76Z"
                                                fill="black" />
                                        </g>
                                    </g>
                                    <defs>
                                        <filter id="filter0_d_351_1050" x="0" y="0" width="45" height="45"
                                            filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                            <feOffset dy="4" />
                                            <feGaussianBlur stdDeviation="2" />
                                            <feComposite in2="hardAlpha" operator="out" />
                                            <feColorMatrix type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix"
                                                result="effect1_dropShadow_351_1050" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_351_1050"
                                                result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                        <li class="">
                            <a href="">
                                <svg width="45" height="45" viewBox="0 0 45 45" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g filter="url(#filter0_d_351_1039)">
                                        <rect x="4" y="0.000244141" width="37" height="37" rx="13"
                                            fill="white" />
                                        <path
                                            d="M24.0281 9C25.1531 9.003 25.7241 9.009 26.2171 9.023L26.4111 9.03C26.6351 9.038 26.8561 9.048 27.1231 9.06C28.1871 9.11 28.9131 9.278 29.5501 9.525C30.2101 9.779 30.7661 10.123 31.3221 10.678C31.8306 11.1779 32.224 11.7826 32.4751 12.45C32.7221 13.087 32.8901 13.813 32.9401 14.878C32.9521 15.144 32.9621 15.365 32.9701 15.59L32.9761 15.784C32.9911 16.276 32.9971 16.847 32.9991 17.972L33.0001 18.718V20.028C33.0025 20.7574 32.9949 21.4868 32.9771 22.216L32.9711 22.41C32.9631 22.635 32.9531 22.856 32.9411 23.122C32.8911 24.187 32.7211 24.912 32.4751 25.55C32.2248 26.2178 31.8312 26.8226 31.3221 27.322C30.8221 27.8303 30.2174 28.2238 29.5501 28.475C28.9131 28.722 28.1871 28.89 27.1231 28.94C26.8858 28.9512 26.6485 28.9612 26.4111 28.97L26.2171 28.976C25.7241 28.99 25.1531 28.997 24.0281 28.999L23.2821 29H21.9731C21.2434 29.0025 20.5136 28.9949 19.7841 28.977L19.5901 28.971C19.3527 28.962 19.1154 28.9517 18.8781 28.94C17.8141 28.89 17.0881 28.722 16.4501 28.475C15.7828 28.2244 15.1783 27.8308 14.6791 27.322C14.1701 26.8223 13.7763 26.2176 13.5251 25.55C13.2781 24.913 13.1101 24.187 13.0601 23.122C13.0489 22.8847 13.0389 22.6474 13.0301 22.41L13.0251 22.216C13.0067 21.4868 12.9983 20.7574 13.0001 20.028V17.972C12.9973 17.2426 13.0046 16.5132 13.0221 15.784L13.0291 15.59C13.0371 15.365 13.0471 15.144 13.0591 14.878C13.1091 13.813 13.2771 13.088 13.5241 12.45C13.7752 11.7819 14.1698 11.177 14.6801 10.678C15.1792 10.1695 15.7832 9.77599 16.4501 9.525C17.0881 9.278 17.8131 9.11 18.8781 9.06C19.1441 9.048 19.3661 9.038 19.5901 9.03L19.7841 9.024C20.5133 9.00623 21.2427 8.99857 21.9721 9.001L24.0281 9ZM23.0001 14C21.674 14 20.4022 14.5268 19.4646 15.4645C18.5269 16.4021 18.0001 17.6739 18.0001 19C18.0001 20.3261 18.5269 21.5979 19.4646 22.5355C20.4022 23.4732 21.674 24 23.0001 24C24.3262 24 25.5979 23.4732 26.5356 22.5355C27.4733 21.5979 28.0001 20.3261 28.0001 19C28.0001 17.6739 27.4733 16.4021 26.5356 15.4645C25.5979 14.5268 24.3262 14 23.0001 14ZM23.0001 16C23.3941 15.9999 23.7842 16.0775 24.1482 16.2282C24.5122 16.3789 24.8429 16.5998 25.1216 16.8783C25.4002 17.1569 25.6212 17.4875 25.772 17.8515C25.9229 18.2154 26.0005 18.6055 26.0006 18.9995C26.0007 19.3935 25.9231 19.7836 25.7724 20.1476C25.6217 20.5116 25.4008 20.8423 25.1223 21.121C24.8437 21.3996 24.5131 21.6206 24.1491 21.7714C23.7851 21.9223 23.3951 21.9999 23.0011 22C22.2054 22 21.4424 21.6839 20.8798 21.1213C20.3172 20.5587 20.0011 19.7956 20.0011 19C20.0011 18.2044 20.3172 17.4413 20.8798 16.8787C21.4424 16.3161 22.2054 16 23.0011 16M28.2511 12.5C27.9196 12.5 27.6016 12.6317 27.3672 12.8661C27.1328 13.1005 27.0011 13.4185 27.0011 13.75C27.0011 14.0815 27.1328 14.3995 27.3672 14.6339C27.6016 14.8683 27.9196 15 28.2511 15C28.5826 15 28.9006 14.8683 29.135 14.6339C29.3694 14.3995 29.5011 14.0815 29.5011 13.75C29.5011 13.4185 29.3694 13.1005 29.135 12.8661C28.9006 12.6317 28.5826 12.5 28.2511 12.5Z"
                                            fill="black" />
                                    </g>
                                    <defs>
                                        <filter id="filter0_d_351_1039" x="0" y="0.000244141" width="45"
                                            height="45" filterUnits="userSpaceOnUse"
                                            color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                            <feOffset dy="4" />
                                            <feGaussianBlur stdDeviation="2" />
                                            <feComposite in2="hardAlpha" operator="out" />
                                            <feColorMatrix type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix"
                                                result="effect1_dropShadow_351_1039" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_351_1039"
                                                result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                        <li class="">
                            <a href="">
                                <svg width="45" height="45" viewBox="0 0 45 45" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g filter="url(#filter0_d_351_1044)">
                                        <rect x="4" width="37" height="37" rx="13" fill="white" />
                                        <path
                                            d="M27.6002 12.82C26.9166 12.0396 26.5399 11.0374 26.5402 10H23.4502V22.4C23.4263 23.071 23.143 23.7066 22.6599 24.1729C22.1768 24.6393 21.5316 24.8999 20.8602 24.9C19.4402 24.9 18.2602 23.74 18.2602 22.3C18.2602 20.58 19.9202 19.29 21.6302 19.82V16.66C18.1802 16.2 15.1602 18.88 15.1602 22.3C15.1602 25.63 17.9202 28 20.8502 28C23.9902 28 26.5402 25.45 26.5402 22.3V16.01C27.7932 16.9099 29.2975 17.3926 30.8402 17.39V14.3C30.8402 14.3 28.9602 14.39 27.6002 12.82Z"
                                            fill="black" />
                                    </g>
                                    <defs>
                                        <filter id="filter0_d_351_1044" x="0" y="0" width="45" height="45"
                                            filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                            <feOffset dy="4" />
                                            <feGaussianBlur stdDeviation="2" />
                                            <feComposite in2="hardAlpha" operator="out" />
                                            <feColorMatrix type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix"
                                                result="effect1_dropShadow_351_1044" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_351_1044"
                                                result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                        <li class="">
                            <a href="">
                                <svg width="45" height="45" viewBox="0 0 45 45" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g filter="url(#filter0_d_351_1048)">
                                        <rect x="4" y="0.000244141" width="37" height="37" rx="13"
                                            fill="white" />
                                        <path
                                            d="M33 19C33 13.48 28.52 9 23 9C17.48 9 13 13.48 13 19C13 23.84 16.44 27.87 21 28.8V22H19V19H21V16.5C21 14.57 22.57 13 24.5 13H27V16H25C24.45 16 24 16.45 24 17V19H27V22H24V28.95C29.05 28.45 33 24.19 33 19Z"
                                            fill="black" />
                                    </g>
                                    <defs>
                                        <filter id="filter0_d_351_1048" x="0" y="0.000244141" width="45"
                                            height="45" filterUnits="userSpaceOnUse"
                                            color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                            <feOffset dy="4" />
                                            <feGaussianBlur stdDeviation="2" />
                                            <feComposite in2="hardAlpha" operator="out" />
                                            <feColorMatrix type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix"
                                                result="effect1_dropShadow_351_1048" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_351_1048"
                                                result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
    <div class="h-screen ">
        <div class="w-screen mx-auto relative">
            <div>
                <div class="grid grid-cols-2 h-screen">
                    <div class="bg-white">
                    </div>
                    <div class="bg-[#3E68FF] flex flex-col justify-center items-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-27.4712, -58.8396], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([-27.4712, -58.8396]).addTo(map);
        });
    </script>
@endsection
