<div x-data="{
    openInitialModal: true,
    openModal: false,
    successModal: false,
    value: null,
    reviewText: '',
    selectedProduct: null,
    products: [],

    async loadProducts() {
        try {
            const response = await fetch('/products-api');
            if (!response.ok) throw new Error('Error al cargar productos');
            this.products = await response.json();
        } catch (error) {
            console.error(error);
        }
    },

    closeInitialModal() {
        this.openInitialModal = false;
    },

    startReviewProcess() {
        this.closeInitialModal();
        this.openModal = true; // Abre el modal de reseñas
    },

    closeModal() {
        this.openModal = false;
        localStorage.setItem('review-modal-closed', Date.now() + (2 * 60 * 60 * 1000)); // Cierra por 2 horas
    },

    closeSuccessModal() {
        this.successModal = false;
    }
}" x-init="loadProducts()">

    <!-- Modal inicial de confirmación para calificar productos -->
    <div x-show="openInitialModal" @keydown.window.escape="closeInitialModal" x-transition.opacity.duration.300
        class="fixed shadow-2xl drop-shadow-xl top-28 right-2 lg:right-10 lg:top-20 z-50 flex items-center justify-center">
        <div
            class="bg-white py-6 px-12 rounded-2xl w-[25rem] shadow-lg h-auto flex flex-col items-center justify-center relative">
            <button @click="closeInitialModal"
                class="absolute text-2xl top-4 right-4 text-gray-500 hover:text-gray-800 transition-all">
                &times; <!-- Icono de cerrar -->
            </button>
            <h1 class="text-gray-800 text-lg mb-2">¿Te gustaría calificar los productos que has comprado?</h1>
            <div class="flex space-x-2">
                <!-- Botón para calificar -->
                <button @click="startReviewProcess"
                    class="w-full px-6 sym  bg-blue-500 text-white textp-2 hover:bg-blue-700 hover:shadow-lg transition-all rounded-full">
                    Okey
                </button>

                <!-- Botón para rechazar -->
                <button @click="closeModal()"
                    class="w-full px-6 py-2 bg-black text-white text-sm hover:bg-gray-700 hover:text-gray-200 hover:shadow-lg transition-all rounded-full">
                    Lo haré luego
                </button>
            </div>
        </div>
    </div>

    <!-- Modal principal de reseñas -->
    <div x-show="openModal" @keydown.window.escape="closeModal" x-transition.opacity.duration.300
        class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-xl">
        <div class="bg-white p-8 rounded-2xl w-[30rem] h-auto shadow-lg flex flex-col justify-between relative">
            <button @click="closeModal"
                class="absolute text-2xl top-4 right-4 text-gray-500 hover:text-gray-800 transition-all">
                &times; <!-- Icono de cerrar -->
            </button>

            <!-- Paso 1: Selección de producto -->
            <template x-if="!selectedProduct">
                <div class="w-full h-full flex flex-col items-center justify-center">
                    <!-- Imagen -->
                    <div class="rounded-full bg-white flex items-center justify-center p-8 mb-4">
                        <img src="/img/rino-black.png" alt="thankyou" class="w-36 h-20" />
                    </div>

                    <!-- Título -->
                    <h1 class="text-gray-800 text-2xl mb-4">¿Te gustaría hacer una reseña de los productos que
                        compraste?</h1>

                    <!-- Seleccionar producto -->
                    <select x-model="selectedProduct"
                        class="w-full h-12 mt-4 border rounded-lg p-2 focus:border-blue-500 focus:shadow-lg transition-shadow">

                        <option value="" disabled>Seleccione un producto</option>
                        <template x-for="product in products" :key="product.id">
                            <option :value="product.id" x-text="product.name"></option>
                        </template>
                    </select>

                    <!-- Botón para continuar -->
                    <button @click="if (selectedProduct) openModal = true"
                        class="mt-8 w-full h-12 uppercase bg-black hover:shadow-lg transition-all rounded-full text-white flex items-center justify-center">
                        Continuar
                    </button>
                </div>
            </template>

            <!-- Paso 2: Reseña del producto -->
            <template x-if="selectedProduct">
                <div>
                    <!-- Imagen del producto -->
                    <div class="rounded-full bg-white flex items-center justify-center p-8 mb-4">
                        <img src="/img/rino-black.png" alt="thankyou" class="w-36 h-20" />
                    </div>

                    <!-- Título y descripción -->
                    <h1 class="text-gray-800 text-2xl mb-4">¿Qué te pareció el producto?</h1>
                    <p class="text-gray-800 text-lg mb-4">
                        Por favor, háganos saber cómo fue su experiencia. ¡Agradecemos todos los comentarios!
                    </p>

                    <!-- Estrellas -->
                    <ul class="flex space-x-4 mb-4">
                        <template x-for="n in 5" :key="n">
                            <li :class="{ 'bg-yellow-400 text-white': value >= n, 'bg-gray-200 ': value < n }"
                                class="w-12 h-12 rounded-full cursor-pointer flex items-center justify-center transition-colors"
                                @click="value = n">
                                <span x-text="n"></span>
                            </li>
                        </template>
                    </ul>

                    <!-- Texto de reseña -->
                    <textarea x-model="reviewText"
                        class="w-full h-24 border rounded-lg p-2 mb-4 focus:border-blue-500 focus:shadow-lg transition-shadow"
                        placeholder="Escribe tu reseña aquí..."></textarea>

                    <!-- Botones de acción -->
                    <div class="flex space-x-4">
                        <button
                            @click="if(value && reviewText) { $wire.submitReview(selectedProduct, value, reviewText).then(() => { successModal = true; openModal = false; }) }"
                            class="w-full h-12 uppercase bg-gradient-to-r from-blue-500 to-teal-400 text-white hover:from-teal-400 hover:to-blue-500 hover:shadow-lg transition-all rounded-full">
                            Enviar reseña
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Modal de Éxito -->
    <div x-show="successModal" @keydown.window.escape="closeSuccessModal" x-transition.opacity.duration.300
        class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-xl">
        <div class="bg-white p-8 rounded-2xl w-[35rem] flex flex-col items-center space-y-4 shadow-lg relative">
            <button @click="closeSuccessModal"
                class="absolute text-2xl top-4 right-4 text-gray-500 hover:text-gray-800 transition-all">
                &times; <!-- Icono de cerrar -->
            </button>
            <img src="/img/rino-black.png" alt="thankyou" class="w-36 h-20" />
            <p class="text-blue-500 text-lg font-bold">Seleccionaste <span x-text="value"></span> de 5</p>
            <h1 class="text-gray-800 text-2xl">¡Muchas gracias por tu reseña!</h1>
            <p class="text-center text-gray-600">
                Agradecemos tu calificación. Si necesitas más soporte, ¡no dudes en contactarnos!
            </p>

            <button @click="successModal = false"
                class="mt-4 w-full h-12 rounded-full bg-blue-500 text-white hover:bg-blue-700 hover:shadow-lg transition-all">
                Listo <span>👍🏻</span>
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</div>
