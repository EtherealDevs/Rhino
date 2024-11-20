<div x-data="{
    openModal: true,
    successModal: false,
    value: 0,
    reviewText: '',
}">
    <!-- Modal principal de reseñas -->
    <div x-show="openModal" @keydown.window.escape="openModal = false" x-transition.opacity.duration.300
        class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-xl">
        <form method="POST" action="{{ route('reviews.store') }}"
            class="bg-white p-8 rounded-2xl w-3/4 shadow-lg flex flex-col justify-between relative">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}" />
            <button @click="openModal = false"
                class="absolute text-2xl top-4 right-4 text-gray-500 hover:text-gray-800 transition-all">
                &times;
            </button>

            <h2 class="text-gray-800 text-2xl mb-4 font-josefin font-bold">¿Qué te pareció el producto?</h2>
            <h3 class="text-gray-800 text-lg mb-4 font-josefin font-medium">La calificacion se vera proyectada en estrellas</h3>
            <div x-data="{ value: 0 }">
                <!-- Única instancia para las estrellas -->
                <ul class="flex space-x-4 mb-4">
                    <template x-for="n in [1, 2, 3, 4, 5]" :key="n">
                        <li :class="{ 'bg-yellow-400 text-white': value >= n, 'bg-gray-200': value < n }"
                            class="w-12 h-12 rounded-full cursor-pointer flex items-center justify-center transition-colors"
                            @click="value = n; $refs.rating.value = n">
                            <span x-text="n"></span>
                        </li>
                    </template>
                </ul>
                <input type="hidden" name="rating" x-ref="rating" :value="value">
            </div>


            <!-- Reseña -->
            <textarea name="content" x-model="reviewText"
                class="w-full h-24 border rounded-lg p-2 mb-4 focus:border-blue-500 focus:shadow-lg transition-shadow"
                placeholder="Escribe tu reseña aquí..." required></textarea>

            <!-- Botón para enviar -->
            <button type="submit"
                class="w-full h-12 bg-gradient-to-r from-blue-500 to-blue-300 text-white hover:to-blue-600 hover:from-blue-500 hover:shadow-lg transition rounded-full">
                Enviar reseña
            </button>
        </form>
    </div>

    <!-- Modal de Éxito -->
    <div x-show="successModal" @keydown.window.escape="successModal = false" x-transition.opacity.duration.300
        class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-xl">
        <div class="bg-white p-8 rounded-2xl w-[35rem] flex flex-col items-center space-y-4 shadow-lg relative">
            <button @click="successModal = false"
                class="absolute text-2xl top-4 right-4 text-gray-500 hover:text-gray-800 transition-all">
                &times;
            </button>
            <h1 class="text-gray-800 text-2xl">¡Muchas gracias por tu reseña!</h1>
            <p class="text-blue-500 text-lg font-bold">Usaremos la informacion brindada para mejorar.</p>
        </div>
    </div>
</div>
