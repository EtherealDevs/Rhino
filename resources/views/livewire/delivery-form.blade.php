<div>
    <div id="autoFillModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold">¿Quieres rellenar con tus datos?</h2>
            <p class="text-gray-600">Podemos rellenar los campos con la información que ya tenemos guardada.</p>
            <div class="mt-4 flex justify-end space-x-4">
                <button id="autoFillNo" class="bg-red-400 text-white px-4 py-2 rounded-lg">No</button>
                <button id="autoFillYes" class="bg-green-400 text-white px-4 py-2 rounded-lg">Sí</button>
            </div>
        </div>
    </div>
    <div
        class="relative min-h-screen flex items-center justify-center bg-center py-12 px-4 sm:px-6 lg:px-8 bg-transparent">
        <div class="absolute inset-x-0 -top-40 z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#0051ff] to-[#bb94b7] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="absolute bg-transparent inset-0 z-0"></div>
        <div class="max-w-md w-full space-y-8 p-10 bg-transparent rounded-xl shadow-lg z-30">
            <form method="POST" action="{{ route('checkout.delivery.address') }}" class="space-y-4">
                @method('POST')
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-checkout.text-input name="name" label="Nombre" wire:model.blur="name"
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />

                    <x-checkout.text-input name="last_name" label="Apellido" wire:model.blur="last_name"
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />

                    <div class="w-full max-w-sm min-w-[200px] mt-4 sm:col-span-2">
                        <label class="block mb-1 text-sm text-gray-800">Número de Teléfono</label>
                        <div class="relative mt-2">
                            <div class="absolute top-2 left-0 flex items-center pl-3">
                                <button id="dropdownButton"
                                    class="h-full text-sm flex justify-center items-center bg-transparent text-gray-700 focus:outline-none">
                                    <span id="dropdownSpan">+54</span>
                                    <!-- Cambia el código de país según sea necesario -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-4 w-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                                <div class="h-6 border-l border-gray-200 ml-2"></div>
                            </div>
                            <input type="text" name="phone_number" wire:model.blur="phone_number"
                                class="w-full h-10 pl-20 bg-transparent placeholder:text-gray-400 text-gray-700 text-sm border border-gray-300 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-gray-400 hover:border-gray-400 shadow-sm focus:shadow-md"
                                placeholder="324-456-2323" />
                        </div>
                        @error('phone_number')
                            <div class="mt-2 text-red-500 text-xs">
                                <span class="error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>


                    <div class="mb-4 col-span-1 sm:col-span-2 grid grid-cols-2 grid-rows-2">
                        <div class="col-span-2">
                            <x-checkout.text-input inputmode="numeric" name="zip_code" label="Código Postal"
                                wire:model.blur="zip_code"
                                class="appearance-none  block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />
                        </div>
                        <div class="col-span-1">
                            <label for="province" class="text-xs font-semibold text-gray-600 py-2">Provincia</label>
                            <input name="province" type="text" readonly wire:model.live="province"
                                class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4">
                            @error('province')
                                <div class="mt-2 text-red-500 text-xs">
                                    <span class="error">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-span-1">
                            <label for="city" class="text-xs font-semibold text-gray-600 py-2">Localidad</label>
                            <select name="city" wire:model.live="city"
                                class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4">
                                <option value="" selected>
                                    @if ($selectedProvince == 1)
                                        Seleccioná un barrio...
                                    @else
                                        Seleccioná una localidad...
                                    @endif
                                </option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('city')
                                <div class="mt-2 text-red-500 text-xs">
                                    <span class="error">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <x-checkout.text-input name="address" label="Dirección" wire:model="address"
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />

                    <x-checkout.text-input name="street" label="Calle" wire:model="street"
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />

                    <x-checkout.text-input name="number" label="Altura (Número)" wire:model="number"
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />

                    <x-checkout.text-input name="department" label="Piso/Departamento (Opcional)"
                        wire:model="department"
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />
                </div>

                <hr class="mt-4 mb-4">
                <p class="text-sm font-semibold text-gray-600">Entre calles (Opcional)</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-checkout.text-input name="street1" label="Calle 1" wire:model="street1"
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />

                    <x-checkout.text-input name="street2" label="Calle 2" wire:model="street2"
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />
                </div>

                <x-checkout.textbox-input name="observation" label="Indicaciones opcionales" wire:model="observation"
                    class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-28 px-4 py-2" />

                <button type="submit"
                    class="w-full py-3 mt-6 bg-green-400 text-white rounded-lg hover:bg-green-500 shadow-lg">
                    Continuar con la compra.
                </button>
            </form>

        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
            aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#004cff] to-[#0e0953] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>


    </div>
    <!-- JavaScript para manejar el modal y rellenar los datos -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const autoFillModal = document.getElementById('autoFillModal');
            const autoFillYes = document.getElementById('autoFillYes');
            const autoFillNo = document.getElementById('autoFillNo');

            // Mostrar el modal al cargar la página
            autoFillModal.classList.remove('hidden');

            // Si elige "Sí", rellenar los campos
            autoFillYes.addEventListener('click', function() {
                document.querySelector('input[name="name"]').value = "{{ $user->name }}";
                document.querySelector('input[name="last_name"]').value = "{{ $user->last_name }}";
                document.querySelector('input[name="phone_number"]').value = "{{ $user->phone_number }}";
                document.querySelector('input[name="zip_code"]').value = "{{ $user->zip_code }}";
                document.querySelector('input[name="province"]').value = "{{ $user->province }}";
                document.querySelector('select[name="city"]').value = "{{ $user->city_id }}";
                document.querySelector('input[name="address"]').value = "{{ $user->address }}";
                document.querySelector('input[name="street"]').value = "{{ $user->street }}";
                document.querySelector('input[name="number"]').value = "{{ $user->number }}";
                document.querySelector('input[name="department"]').value = "{{ $user->department }}";

                autoFillModal.classList.add('hidden'); // Cerrar el modal
            });

            // Si elige "No", cerrar el modal
            autoFillNo.addEventListener('click', function() {
                autoFillModal.classList.add('hidden');
            });
        });
    </script>
</div>
