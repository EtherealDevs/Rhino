<!-- Componente de Notificaciones -->

<div class="relative">
    <button @click="open = !open" class="relative">
        <!-- Icono de campana con contador de notificaciones -->
        <span class="text-red-500">{{ $notificaciones->count() }}</span>
    </button>

    <!-- Lista de notificaciones -->
    <div x-show="open" class="absolute right-0 mt-2 w-64 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-lg shadow-lg">
        @if ($notificaciones->isEmpty())
            <div class="p-2 text-gray-500 dark:text-slate-400">No hay notificaciones de stock bajo.</div>
        @else
            @foreach ($notificaciones as $notificacion)
                <div class="bg-white dark:bg-slate-900 p-3 rounded-lg shadow hover:shadow-xl mb-3 transform hover:-translate-y-1 transition duration-150 ease-in-out">
                    <div class="flex items-center justify-between">
                        <span class="font-medium text-sm text-slate-400 dark:text-slate-100">Nueva Notificación</span>
                        <button class="-mr-1 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-400 dark:text-slate-200 h-5 w-5 rounded-full flex justify-center items-center">
                            <svg class="h-2 w-2 fill-current" viewBox="0 0 20 20">
                                <path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center mt-2">
                        <div class="relative flex flex-shrink-0 items-end">
                            <img class="h-10 w-10 rounded-full" src="https://i.pravatar.cc/300">
                            <span class="absolute h-4 w-4 bg-green-400 rounded-full bottom-0 right-0 border-2 border-white dark:border-slate-900"></span>
                        </div>
                        <div class="ml-3">
                            <span class="font-semibold tracking-tight text-xs text-slate-800 dark:text-slate-200">{{ $notificacion->data['message'] }}</span>
                            <p class="text-xs leading-4 pt-2 italic text-gray-500 dark:text-slate-400">Stock restante: {{ $notificacion->data['stock_restante'] }}</p>
                            <span class="text-[10px] text-blue-500 dark:text-blue-300 font-medium">{{ $notificacion->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
