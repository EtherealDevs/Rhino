@props(['productItem'])
<div class="relative flex w-11/12 lg:w-56 mb-8 mt-6 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
    <div class="relative mx-3 mt-3 h-40 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
        <img src="https://images.unsplash.com/photo-1578262825743-a4e402caab76?ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80"
            class="h-full w-full object-cover" />
        <div class="absolute top-2 left-2 bg-[#5FA878] text-white text-sm font-bold rounded-full px-2 py-1">
            {{ $productItem->product->name }}
        </div>
        <div class="absolute top-2 right-2 flex flex-col space-y-2">
            <button class="bg-black/20 text-gray-600 hover:bg-gray-600 p-2 rounded-full transition">
                <svg width="18" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.5 16L7.2675 14.849C2.89 10.7771 0 8.08283 0 4.79564C0 2.10136 2.057 0 4.675 0C6.154 0 7.5735 0.706267 8.5 1.81362C9.4265 0.706267 10.846 0 12.325 0C14.943 0 17 2.10136 17 4.79564C17 8.08283 14.11 10.7771 9.7325 14.849L8.5 16Z"
                        fill="red" />
                </svg>
            </button>
            <button class="bg-black/20 text-gray-600 hover:bg-gray-600 p-2 rounded-full transition">
                <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.2 14.4C14.1455 14.4 13.3 15.201 13.3 16.2C13.3 16.6774 13.5002 17.1352 13.8565 17.4728C14.2128 17.8104 14.6961 18 15.2 18C15.7039 18 16.1872 17.8104 16.5435 17.4728C16.8998 17.1352 17.1 16.6774 17.1 16.2C17.1 15.7226 16.8998 15.2648 16.5435 14.9272C16.1872 14.5896 15.7039 14.4 15.2 14.4ZM0 0V1.8H1.9L5.32 8.631L4.028 10.836C3.8855 11.088 3.8 11.385 3.8 11.7C3.8 12.1774 4.00018 12.6352 4.3565 12.9728C4.71282 13.3104 5.19609 13.5 5.7 13.5H17.1V11.7H6.099C6.03601 11.7 5.9756 11.6763 5.93106 11.6341C5.88652 11.5919 5.8615 11.5347 5.8615 11.475C5.8615 11.43 5.871 11.394 5.89 11.367L6.745 9.9H13.8225C14.535 9.9 15.162 9.522 15.485 8.973L18.886 3.15C18.9525 3.006 19 2.853 19 2.7C19 2.4613 18.8999 2.23239 18.7218 2.0636C18.5436 1.89482 18.302 1.8 18.05 1.8H3.9995L3.1065 0M5.7 14.4C4.6455 14.4 3.8 15.201 3.8 16.2C3.8 16.6774 4.00018 17.1352 4.3565 17.4728C4.71282 17.8104 5.19609 18 5.7 18C6.20391 18 6.68718 17.8104 7.0435 17.4728C7.39982 17.1352 7.6 16.6774 7.6 16.2C7.6 15.7226 7.39982 15.2648 7.0435 14.9272C6.68718 14.5896 6.20391 14.4 5.7 14.4Z"
                        fill="white" />
                </svg>
            </button>
        </div>
    </div>
    <div class="bg-black rounded-xl mx-3 mt-3 mb-3 p-3">
        <div class="flex flex-col items-center justify-center">
            <p class="block font-sans font-bold text-base leading-5 text-white antialiased text-center">
                Camisa a rayas adidas roja
            </p>
            <p class="block font-sans text-sm font-light leading-relaxed text-white antialiased text-center">
                Ver detalle →
            </p>
            <form method="POST" action="{{route('cart.addItem')}}">
                @csrf
                <input type="hidden" name="item" value="{{$productItem}}">
                <button type="submit">Añadir al Carrito</button>
            </form>
        </div>
    </div>
</div>
