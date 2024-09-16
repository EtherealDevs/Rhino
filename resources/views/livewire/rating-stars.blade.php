<div x-data="{ 
    openModal: !localStorage.getItem('review-modal-closed') || Date.now() > localStorage.getItem('review-modal-closed'),
    successModal: false,
    value: null,
    closeModal() {
        this.openModal = false;
        localStorage.setItem('review-modal-closed', Date.now() + (2 * 60 * 60 * 1000)); // Guardar la hora actual + 2 horas en milisegundos
    }
}">
    <!-- Modal -->
    <div x-show="openModal" class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-xl">
        <div class="bg-white p-16 rounded-2xl w-[45rem] h-[40rem] flex flex-col justify-between">
            <div class="card__image w-8 h-8 rounded-full bg-white flex items-center justify-center p-8">
                <img src="/img/rino-black.png" alt="star" />
            </div>
            <h1 class="text-gray-800 text-3xl">¿Qué te pareció el producto [nombre de producto]?</h1>
            <p class="text-gray-800 text-lg pr-8 leading-7">
                Por favor, háganos saber cómo fue su solicitud de soporte. ¡Agradecemos todos los comentarios para
                ayudarnos a mejorar nuestra oferta!
            </p>
            <!-- Reseña -->
            <ul class="flex space-x-12">
                <li class="list__item w-11 h-11 rounded-full cursor-pointer flex items-center justify-center bg-gray-100 text-gray-800 text-base hover:bg-gray-700 hover:text-white"
                    @click="value = 1">
                    1
                </li>
                <li class="list__item w-11 h-11 rounded-full cursor-pointer flex items-center justify-center bg-gray-100 text-gray-800 text-base hover:bg-gray-700 hover:text-white"
                    @click="value = 2">
                    2
                </li>
                <li class="list__item w-11 h-11 rounded-full cursor-pointer flex items-center justify-center bg-gray-100 text-gray-800 text-base hover:bg-gray-700 hover:text-white"
                    @click="value = 3">
                    3
                </li>
                <li class="list__item w-11 h-11 rounded-full cursor-pointer flex items-center justify-center bg-gray-100 text-gray-800 text-base hover:bg-gray-700 hover:text-white"
                    @click="value = 4">
                    4
                </li>
                <li class="list__item w-11 h-11 rounded-full cursor-pointer flex items-center justify-center bg-gray-100 text-gray-800 text-base hover:bg-gray-700 hover:text-white"
                    @click="value = 5">
                    5
                </li>
            </ul>
            <!-- Botones -->
            <div class="mt-8 flex space-x-4">
                <button @click="closeModal()"
                    class="w-full h-16 uppercase bg-black text-white hover:bg-white hover:text-blue-900 transition-colors rounded-full flex items-center justify-center">
                    Haré mi reseña luego
                </button>
                <button @click="if(value){ openModal = false; successModal = true }"
                    class="w-full h-16 uppercase bg-black text-white hover:bg-white hover:text-blue-900 transition-colors rounded-full flex items-center justify-center">
                    Calificar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal de Éxito -->
    <div x-show="successModal" class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-xl">
        <div class="bg-gray-100 p-20 rounded-2xl w-[45rem] h-[40rem] flex flex-col justify-between items-center">
            <div class="success_img">
                <img src="/img/rino-black.png" alt="thankyou" />
            </div>
            <p class="success__value bg-gray-100 text-blue-500 text-lg py-2 px-8 rounded-2xl font-bold">
                Seleccionaste <span x-text="value"></span> de 5
            </p>
            <h1 class="text-gray-800 text-3xl">¡Muchas Gracias!</h1>
            <p class="text-gray-800 text-center text-lg leading-7">
                Agradecemos que hayas tomado el tiempo para dar una calificación. Si necesitas más soporte, ¡no dudes en
                ponerte en contacto con nosotros!
            </p>

            <!-- Botón para cerrar el modal -->
            <button @click="successModal = false"
                class="mt-8 rounded-full p-3 px-6 bg-black flex items-center space-x-2 hover:bg-white transition-colors text-white hover:text-blue-900 w-full h-16 uppercase tracking-wide">
                <p>Listo <span class="">👍🏻</span></p>
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</div>
