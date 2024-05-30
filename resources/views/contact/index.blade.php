@extends('layouts.app')
@section('content')
    <header>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    </header>
    <div class="grid grid-cols-3 grid-rows-3 h-screen relative">
        <div class="col-span-3">
            <h2
                class="absolute font-extrabold text-[#332E6C] flex mx-auto w-full text-6xl font-blinker uppercase mt-16 justify-center">
                Pagina de <span class="text-white ml-3">Contacto</span>
            </h2>
        </div>
        <div class="grid grid-cols-3 col-span-2">
            <div id="map" class="col-span-2 z-10 "></div>
            <div class="col-span-1 w-full px-10">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-white">Nombre</label>
                        <input type="text" id="name" name="name"
                            class="shadow-sm  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                    </div>
                    <div class="form-group mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-white">Correo</label>
                        <input type="email" id="email" name="email"
                            class="shadow-sm border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                    </div>
                    <div class="form-group mb-6">
                        <label for="message" class="block mb-2 text-sm font-medium text-white">Mensaje</label>
                        <textarea id="message" name="message" rows="4"
                            class="shadow-sm text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required></textarea>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-span-3">
            <div class="grid grid-cols-2">
                <div>
                    <ul>
                        <li class="w-full mb-4">
                            <p class="font-bold text-xl font-josefin">Av. Rio Juramento</p>
                            <svg width="31" height="27" viewBox="0 0 31 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.5002 12.9375C14.6437 12.9375 13.8224 12.6412 13.2168 12.1137C12.6112 11.5863 12.271 10.8709 12.271 10.125C12.271 9.37908 12.6112 8.66371 13.2168 8.13626C13.8224 7.60882 14.6437 7.3125 15.5002 7.3125C16.3566 7.3125 17.1779 7.60882 17.7835 8.13626C18.3891 8.66371 18.7293 9.37908 18.7293 10.125C18.7293 10.4943 18.6458 10.8601 18.4835 11.2013C18.3212 11.5425 18.0834 11.8526 17.7835 12.1137C17.4837 12.3749 17.1277 12.5821 16.7359 12.7234C16.3441 12.8648 15.9242 12.9375 15.5002 12.9375ZM15.5002 2.25C13.1022 2.25 10.8024 3.07969 9.10674 4.55653C7.4111 6.03338 6.4585 8.03642 6.4585 10.125C6.4585 16.0312 15.5002 24.75 15.5002 24.75C15.5002 24.75 24.5418 16.0312 24.5418 10.125C24.5418 8.03642 23.5892 6.03338 21.8936 4.55653C20.1979 3.07969 17.8982 2.25 15.5002 2.25Z"
                                    fill="#297FFF" />
                            </svg>
                        </li>
                        <li class="w-full mb-4">
                            <p class="font-bold text-xl font-josefin">+54 9 379 479 8404</p>
                            <svg width="28" height="27" viewBox="0 0 28 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M25.3619 18.4655C25.1669 19.8946 24.439 21.2064 23.3143 22.1559C22.1895 23.1054 20.7448 23.6276 19.25 23.625C10.5656 23.625 3.50001 16.8117 3.50001 8.43753C3.49733 6.99608 4.03889 5.60298 5.02353 4.51841C6.00818 3.43385 7.36857 2.73199 8.85064 2.54394C9.22541 2.49981 9.60494 2.57374 9.93256 2.7547C10.2602 2.93566 10.5183 3.21394 10.6684 3.548L12.9784 8.52085V8.53351C13.0934 8.78922 13.1409 9.0684 13.1166 9.34612C13.0924 9.62384 12.9972 9.89144 12.8395 10.125C12.8199 10.1535 12.7991 10.1799 12.7772 10.2062L10.5 12.8092C11.3192 14.4144 13.0605 16.0787 14.747 16.8708L17.4092 14.6866C17.4354 14.6654 17.4628 14.6456 17.4913 14.6275C17.7333 14.4718 18.0118 14.3768 18.3015 14.351C18.5912 14.3252 18.883 14.3695 19.1505 14.4798L19.1647 14.4862L24.3174 16.7126C24.6644 16.8569 24.9537 17.1056 25.142 17.4215C25.3302 17.7375 25.4074 18.1037 25.3619 18.4655Z"
                                    fill="#297FFF" />
                            </svg>
                        </li>
                        <li class="w-full mb-4">
                            <p class="font-bold text-xl font-josefin">julia.-castillo@hotmail.com</p>
                            <svg width="27" height="23" viewBox="0 0 27 23" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.5 19.1666C3.88125 19.1666 3.35175 18.9791 2.9115 18.604C2.47125 18.229 2.25075 17.7776 2.25 17.2499V5.74992C2.25 5.22284 2.4705 4.77178 2.9115 4.39675C3.3525 4.02172 3.882 3.83389 4.5 3.83325H22.5C23.1187 3.83325 23.6486 4.02109 24.0896 4.39675C24.5306 4.77242 24.7507 5.22347 24.75 5.74992V17.2499C24.75 17.777 24.5299 18.2284 24.0896 18.604C23.6494 18.9797 23.1195 19.1672 22.5 19.1666H4.5ZM13.5 12.4583L22.5 7.66659V5.74992L13.5 10.5416L4.5 5.74992V7.66659L13.5 12.4583Z"
                                    fill="#297FFF" />
                            </svg>
                        </li>
                    </ul>
                </div>
                <div></div>
            </div>
        </div>
    </div>
    <div class="h-screen absolute ">
        <div style="height: 400px; position: absolute; " class="z-10 align-items-center justify-center w-full">
        </div>
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
