<div
    class="mt-0 lg:mt-12 translate-x-0 translate-y-0 lg:translate-x-2 lg:translate-y-2 rounded-none lg:rounded-3xl bg-slate-900/30 w-full lg:w-11/12">
    <div
        class="rounded-none lg:rounded-3xl lg:-translate-x-2 lg:-translate-y-2 bg-gradient-to-b via-[#2E3366] from-[#273053] to-[#343678]">
        <div class="grid lg:grid-cols-6 grid-cols-1 p-6">
            <div class="col-span-2">
                <ul class="items-center">
                    <li class="font-josefin font-bold text-lg text-[#A3B7FF]">Productos: <span class="text-white text-lg">
                            {{ $itemCount ?? 0 }} <!-- Asegúrate de mostrar 0 si itemCount es null -->
                        </span></li>
                    <li class="font-josefin font-bold text-lg text-[#A3B7FF]">Costo de Envío: <span
                            class="text-white text-lg">
                            @if ($sendPrice)
                                ${{ number_format($sendPrice, 2, ',', '.') }}
                            @else
                                $0.00 <!-- Mostrar $0.00 si sendPrice es null -->
                            @endif
                        </span></li>
                </ul>
            </div>
            <div class="col-span-2 grid grid-rows-2 ml-2">
                <p class="font-josefin font-bold text-2xl sm:text-3xl text-white">Total</p>
                @if ($total != 0)
                    <p class="font-josefin font-bold text-2xl sm:text-3xl text-[#6BE64C]">
                        ${{ number_format($total / 100 + ($sendPrice ?? 0), 2, ',', '.') }}
                        <!-- Usar 0 si sendPrice es null -->
                    </p>
                @else
                    <p class="font-josefin font-bold text-2xl sm:text-3xl text-[#6BE64C]">NO DATA</p>
                @endif
            </div>

            <div class="col-span-2">
                <a href="{{ url()->previous() }}">
                    <button class="w-full sm:w-auto bg-blue-500 rounded-lg mt-2 sm:mt-0">
                        <p class="font-josefin text-lg text-white font-bold py-1 px-4">Volver Atrás</p>
                    </button>
                </a>
            </div>

        </div>
    </div>
</div>
