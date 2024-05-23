@extends('layouts.app')
@section('content')
    <header>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    </header>
    <div class="h-screen flex">
        <div class="w-screen mx-auto">
            <div>
                <div>
                    <h2
                        class="absolute text-[#332E6C] flex mx-auto w-full text-6xl font-blinker uppercase mt-16 justify-center">
                        Pagina de <span class="text-white ml-3">Contacto</span>
                    </h2>
                </div>
                <div class="grid grid-cols-2 h-screen">
                    <div class="bg-white">
                    </div>
                    <div class="bg-[#3E68FF]">
                        <div class="items-center justify-end grid grid-cols-2 ">
                            {{-- <div id="map">
                            </div> --}}
                            <div>
                                <ul>
                                    <li class="w-full">
                                        <p class="font-bold text-xl  font-josefin ">Av. Rio juramento</p>
                                        <svg width="31" height="27" viewBox="0 0 31 27" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.5002 12.9375C14.6437 12.9375 13.8224 12.6412 13.2168 12.1137C12.6112 11.5863 12.271 10.8709 12.271 10.125C12.271 9.37908 12.6112 8.66371 13.2168 8.13626C13.8224 7.60882 14.6437 7.3125 15.5002 7.3125C16.3566 7.3125 17.1779 7.60882 17.7835 8.13626C18.3891 8.66371 18.7293 9.37908 18.7293 10.125C18.7293 10.4943 18.6458 10.8601 18.4835 11.2013C18.3212 11.5425 18.0834 11.8526 17.7835 12.1137C17.4837 12.3749 17.1277 12.5821 16.7359 12.7234C16.3441 12.8648 15.9242 12.9375 15.5002 12.9375ZM15.5002 2.25C13.1022 2.25 10.8024 3.07969 9.10674 4.55653C7.4111 6.03338 6.4585 8.03642 6.4585 10.125C6.4585 16.0312 15.5002 24.75 15.5002 24.75C15.5002 24.75 24.5418 16.0312 24.5418 10.125C24.5418 8.03642 23.5892 6.03338 21.8936 4.55653C20.1979 3.07969 17.8982 2.25 15.5002 2.25Z"
                                                fill="#297FFF" />
                                        </svg>
                                    </li>
                                    <li class="w-full">
                                        <p class="font-bold text-xl  font-josefin ">+54 9 379 479 8404</p>
                                        <svg width="28" height="27" viewBox="0 0 28 27" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M25.3619 18.4655C25.1669 19.8946 24.439 21.2064 23.3143 22.1559C22.1895 23.1054 20.7448 23.6276 19.25 23.625C10.5656 23.625 3.50001 16.8117 3.50001 8.43753C3.49733 6.99608 4.03889 5.60298 5.02353 4.51841C6.00818 3.43385 7.36857 2.73199 8.85064 2.54394C9.22541 2.49981 9.60494 2.57374 9.93256 2.7547C10.2602 2.93566 10.5183 3.21394 10.6684 3.548L12.9784 8.52085V8.53351C13.0934 8.78922 13.1409 9.0684 13.1166 9.34612C13.0924 9.62384 12.9972 9.89144 12.8395 10.125C12.8199 10.1535 12.7991 10.1799 12.7772 10.2062L10.5 12.8092C11.3192 14.4144 13.0605 16.0787 14.747 16.8708L17.4092 14.6866C17.4354 14.6654 17.4628 14.6456 17.4913 14.6275C17.7333 14.4718 18.0118 14.3768 18.3015 14.351C18.5912 14.3252 18.883 14.3695 19.1505 14.4798L19.1647 14.4862L24.3174 16.7126C24.6644 16.8569 24.9537 17.1056 25.142 17.4215C25.3302 17.7375 25.4074 18.1037 25.3619 18.4655Z"
                                                fill="#297FFF" />
                                        </svg>

                                    </li>
                                    <li class="w-full">
                                        <p class="font-bold text-xl  font-josefin ">julia.-castillo@hotmail.com</p>
                                        <svg width="27" height="23" viewBox="0 0 27 23" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4.5 19.1666C3.88125 19.1666 3.35175 18.9791 2.9115 18.604C2.47125 18.229 2.25075 17.7776 2.25 17.2499V5.74992C2.25 5.22284 2.4705 4.77178 2.9115 4.39675C3.3525 4.02172 3.882 3.83389 4.5 3.83325H22.5C23.1187 3.83325 23.6486 4.02109 24.0896 4.39675C24.5306 4.77242 24.7507 5.22347 24.75 5.74992V17.2499C24.75 17.777 24.5299 18.2284 24.0896 18.604C23.6494 18.9797 23.1195 19.1672 22.5 19.1666H4.5ZM13.5 12.4583L22.5 7.66659V5.74992L13.5 10.5416L4.5 5.74992V7.66659L13.5 12.4583Z"
                                                fill="#297FFF" />
                                        </svg>

                                    </li>
                                </ul>
                            </div>
                            <div class="flex mx-auto my-auto h-full w-full place-content-center max-w-lg">
                                <form action="https://api.web3forms.com/submit" class="mt-10">
                                    <input type="hidden" name="access_key" value="YOUR_ACCESS_KEY_HERE" />
                                    <div class="grid gap-6 sm:grid-cols-1">
                                        <div class="relative z-0">
                                            <label
                                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform font-bold text-xl text-[#B7D4FF] duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-200">Nombre
                                                y Apellido
                                            </label>
                                            <input type="text" name="name"
                                                class="peer block w-full appearance-none border-0 border-b border-white bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-200 focus:outline-none focus:ring-0"
                                                placeholder=" " />
                                        </div>
                                        <div class="relative z-0">
                                            <label
                                                class="absolute top-3 z-10 origin-[0] -translate-y-6 scale-75 font-bold transform text-xl text-[#B7D4FF] duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-200 peer-focus:dark:text-blue-500">Tu
                                                email</label>
                                        </div>
                                        <input type="text" name="email"
                                            class="peer block w-full appearance-none border-0 border-b border-white bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-200 focus:outline-none focus:ring-0"
                                            placeholder=" " />
                                        <div class="relative z-0 col-span-1">
                                            <label
                                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 text-xl font-bold scale-75 transform text-[#B7D4FF] duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-200 peer-focus:dark:text-blue-500">Tu
                                                mensaje</label>
                                            <textarea name="message" rows="5"
                                                class="peer block w-full appearance-none border-0 border-b border-white bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-200 focus:outline-none focus:ring-0"
                                                placeholder=" "></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="mt-5 rounded-md bg-white px-10 py-2 text-black">Enviar
                                        Mensaje</button>
                                </form>
                                <div class="flex mt-8 space-x-6 text-gray-100">
                                    <a class="p-1 bg-gray-50 text-black rounded-full"
                                        href="https://www.facebook.com/andreacacer/" target="_blank" rel="noreferrer">
                                        <span class="sr-only"> Facebook </span>
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fillRule="evenodd"
                                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                                clipRule="evenodd" />
                                        </svg>
                                    </a>
                                    <a class="p-1 bg-gray-50 text-black rounded-full"
                                        href="https://www.instagram.com/rino.indumentaria/" target="_blank"
                                        rel="noreferrer">
                                        <span class="sr-only "> Instagram </span>
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fillRule="evenodd"
                                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                                clipRule="evenodd" />
                                        </svg>
                                    </a>
                                    <a class="p-1 bg-gray-50 text-black rounded-full"
                                        href="https://www.whatsapp.com/catalog/5493794316606" target="_blank"
                                        rel="noreferrer">
                                        <span class="sr-only text-gray-100"> X </span>
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <mask id="mask0_351_1032" style="mask-type:luminance"
                                                    maskUnits="userSpaceOnUse" x="2" y="2" width="20" height="20">
                                                    <path d="M2.5 2.5H21.5V21.5H2.5V2.5Z" fill="white" />
                                                </mask>
                                                <g mask="url(#mask0_351_1032)">
                                                    <path
                                                        d="M13.79 2.64002L13.22 2.56002C11.5069 2.31268 9.75885 2.55737 8.17954 3.26558C6.60023 3.97379 5.25476 5.11634 4.3 6.56002C3.28416 7.94 2.67859 9.57876 2.55298 11.2877C2.42737 12.9967 2.78684 14.7063 3.59 16.22C3.6722 16.3717 3.72337 16.5383 3.74054 16.71C3.75771 16.8817 3.74053 17.055 3.69 17.22C3.28 18.63 2.9 20.05 2.5 21.54L3 21.39C4.35 21.03 5.7 20.67 7.05 20.34C7.33494 20.2808 7.63112 20.3087 7.9 20.42C9.1112 21.0111 10.4348 21.3363 11.782 21.3738C13.1293 21.4113 14.4689 21.1601 15.7111 20.6372C16.9533 20.1144 18.0692 19.3318 18.9841 18.3421C19.899 17.3525 20.5915 16.1785 21.0153 14.8992C21.4392 13.6198 21.5844 12.2646 21.4414 10.9244C21.2983 9.58429 20.8703 8.29026 20.1859 7.12917C19.5016 5.96809 18.5769 4.96681 17.4737 4.19254C16.3706 3.41827 15.1146 2.88892 13.79 2.64002ZM16.31 15.76C15.9466 16.0854 15.5034 16.3087 15.0256 16.407C14.5478 16.5054 14.0524 16.4754 13.59 16.32C11.4946 15.73 9.67661 14.4152 8.46 12.61C7.99529 11.9715 7.6217 11.2715 7.35 10.53C7.20285 10.0998 7.17632 9.63749 7.27327 9.19325C7.37023 8.74902 7.58698 8.33981 7.9 8.01002C8.05239 7.81553 8.25981 7.67145 8.49526 7.59654C8.7307 7.52162 8.98325 7.51935 9.22 7.59002C9.42 7.64002 9.56 7.93002 9.74 8.15002C9.886 8.56302 10.057 8.96702 10.25 9.36002C10.3964 9.56053 10.4576 9.81082 10.4201 10.0563C10.3826 10.3017 10.2496 10.5223 10.05 10.67C9.6 11.07 9.67 11.4 9.99 11.85C10.6974 12.8692 11.6736 13.6723 12.81 14.17C13.13 14.31 13.37 14.34 13.58 14.01C13.67 13.88 13.79 13.77 13.89 13.65C14.47 12.92 14.29 12.93 15.21 13.33C15.503 13.453 15.787 13.597 16.06 13.76C16.33 13.92 16.74 14.09 16.8 14.33C16.8577 14.5904 16.8425 14.8616 16.7561 15.1139C16.6696 15.3662 16.5153 15.5898 16.31 15.76Z"
                                                        fill="black" />
                                                </g>
                                            </svg>
                                    </a>
                                    <a class="p-1 bg-gray-50 text-black rounded-full" href target="_blank"
                                        rel="noreferrer">
                                        <span class="sr-only text-gray-100"> TikTok </span>
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.6002 5.82C15.9166 5.03962 15.5399 4.03743 15.5402 3H12.4502V15.4C12.4263 16.071 12.143 16.7066 11.6599 17.1729C11.1768 17.6393 10.5316 17.8999 9.86016 17.9C8.44016 17.9 7.26016 16.74 7.26016 15.3C7.26016 13.58 8.92016 12.29 10.6302 12.82V9.66C7.18016 9.2 4.16016 11.88 4.16016 15.3C4.16016 18.63 6.92016 21 9.85016 21C12.9902 21 15.5402 18.45 15.5402 15.3V9.01C16.7932 9.90985 18.2975 10.3926 19.8402 10.39V7.3C19.8402 7.3 17.9602 7.39 16.6002 5.82Z"
                                                fill="black" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/prism.min.js"
        integrity="sha512-axJX7DJduStuBB8ePC8ryGzacZPr3rdLaIDZitiEgWWk2gsXxEFlm4UW0iNzj2h3wp5mOylgHAzBzM4nRSvTZA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let icon = L.icon({
            iconUrl: 'img/location.png',
            iconSize: [43, 55], // size of the icon
        });

        let map = L.map('map', {
                scrollWheelZoom: false
            })
            .setView([-27.4758916, -58.8192536], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 200,
        }).addTo(map);
    </script> --}}
@endsection
