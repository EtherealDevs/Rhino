<div id="modalBanner" class="hidden">
    <div id="modalContent"
        class="max-w-screen-lg mx-auto fixed z-50 bg-white inset-x-5 p-5 bottom-5 lg:bottom-10 rounded-lg drop-shadow-2xl flex gap-4 flex-wrap md:flex-nowrap text-center md:text-left items-center justify-center md:justify-between">

        @auth
            <div class="w-full">
                ¡Bienvenido! Explora nuestras promociones y disfruta de descuentos especiales en nuestros productos.
                <a href="/promos" class="text-indigo-600 whitespace-nowrap hover:underline">Ver Promociones</a>
            </div>
        @else
            <div class="w-full">
                Inicia sesión para acceder a ofertas exclusivas y descuentos especiales en nuestros productos.
                <a href="#" class="text-indigo-600 whitespace-nowrap hover:underline">¿Olvidaste tu contraseña?</a>
            </div>
        @endauth

        <div class="flex gap-4 items-center flex-shrink-0">
            @auth
                <button id="closeModalButton" 
                    class="font-bold px-4 rounded-xl py-1.5 bg-gray-300 text-gray-700 hover:bg-gray-400 transition duration-300 ease-in-out">
                    Cerrar
                </button>
            @else
                <a href="{{ route('login') }}">
                    <button class="bg-indigo-500 px-5 py-2 text-white rounded-md hover:bg-indigo-700 focus:outline-none">
                        Iniciar Sesión
                    </button>
                </a>
                <button id="closeModalButton" 
                    class="font-bold px-4 rounded-xl py-1.5 bg-gray-300 text-gray-700 hover:bg-gray-400 transition duration-300 ease-in-out">
                    Cerrar
                </button>
            @endauth
        </div>
    </div>
</div>

<script>
    // Verificar si el modal fue cerrado recientemente
    const closeModalTimestamp = localStorage.getItem('modalClosedAt');
    const currentTime = Date.now();
    const twoHours = 7200000; //2 horas

    // Si fue cerrado en el último minuto, agregar la clase hidden
    if (closeModalTimestamp && (currentTime - closeModalTimestamp < oneMinute)) {
        document.getElementById('modalBanner').classList.add('hidden');
    } else {
        // Función para abrir el modal después de 500ms
        setTimeout(() => {
            const modal = document.getElementById('modalBanner');
            modal.classList.remove('hidden');
            modal.classList.add('block');
        }, 1000);
    }

    // Cerrar el modal al hacer click en cualquier botón de cerrar
    const closeButtons = document.querySelectorAll('#closeModalButton');
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('modalBanner').classList.add('hidden');
            localStorage.setItem('modalClosedAt', Date.now()); // Guardar el tiempo de cierre
        });
    });

    // Cerrar el modal con la tecla "Esc"
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.getElementById('modalBanner').classList.add('hidden');
            localStorage.setItem('modalClosedAt', Date.now()); // Guardar el tiempo de cierre
        }
    });
</script>
