<div>

    <div
        class="relative min-h-screen flex items-center justify-center bg-center py-12 px-4 sm:px-6 lg:px-8 bg-transparent">
        <div class="absolute inset-x-0 -top-40 -z-10 lg:z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#0051ff] to-[#bb94b7] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="lg:grid lg:grid-cols-3 w-full lg:w-3/4">

            {{-- Formulario --}}
            <div
                class="max-w-xl col-span-1 lg:col-span-2 h-full space-y-8 w-full p-10 bg-transparent rounded-xl shadow-lg z-50">
                <div class="h-full">
                    <div class="">
                        {{-- Formulario de envio --}}
                        <form method="POST" action="{{ route('checkout.delivery.address') }}" class="space-y-4">
                            @method('POST')
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="selectedMethod" value="domicilio">

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <x-checkout.text-input name="name" label="Nombre" wire:model.blur="name"
                                    class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />

                                <x-checkout.text-input name="last_name" label="Apellido" wire:model.blur="last_name"
                                    class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />

                                <div class="w-full max-w-sm min-w-[200px] mt-4 sm:col-span-2">
                                    <label class="block mb-1 text-sm text-gray-800">Número de Teléfono</label>
                                    <div class="relative mt-2">
                                        <div class="absolute top-2 left-0 flex items-center pl-3">
                                            <button type="button" id="dropdownButton"
                                                class="h-full text-sm flex justify-center items-center bg-transparent text-gray-700 focus:outline-none">
                                                <span id="dropdownSpan">+54</span>
                                                <!-- Cambia el código de país según sea necesario -->
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-4 w-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                            <div class="h-6 border-l border-gray-200 ml-2"></div>
                                        </div>
                                    <input maxlength="11"
                                        class="w-full h-10 pl-20 bg-transparent placeholder:text-gray-400 text-gray-700 text-sm border border-gray-300 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-gray-400 hover:border-gray-400 shadow-sm focus:shadow-md"
                                        type="text" id="formattedPhone" placeholder="3794-895167"
                                        oninput="formatPhone(this)" wire:model.blur="formattedNumber"
                                        value="{{ $formattedNumber }}" />

                                    <!-- Hidden input to store unformatted number and bind with Livewire -->
                                    <input type="hidden" name="phone_number" id="unformattedPhone"
                                        wire:model.live="phone_number" value="{{$phone_number}}" />
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
                                        <label for="province"
                                            class="text-xs font-semibold text-gray-600 py-2">Provincia</label>
                                        <input name="province" type="text" readonly wire:model.live="province"
                                            class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4">
                                        @error('province')
                                            <div class="mt-2 text-red-500 text-xs">
                                                <span class="error">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-4 col-span-1">
                                        <label for="city"
                                            class="text-xs font-semibold text-gray-600 py-2">Localidad</label>
                                        <select name="city" wire:model.live="city"
                                            class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4">
                                            <option value="" selected>
                                                @if ($selectedProvince == 1)
                                                    Seleccioná un barrio...
                                                @else
                                                    Seleccioná una localidad...
                                                @endif
                                            </option>
                                            @foreach ($cities as $city2)
                                            @php
                                                $value = $city2->id;
                                            @endphp
                                            <option @if ($value == $city) selected @endif
                                                value="{{ $city2->id }}">
                                                {{ $city2->name }}
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

                            <x-checkout.textbox-input name="observation" label="Indicaciones opcionales"
                                wire:model="observation"
                                class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-28 px-4 py-2" />

                            <button type="submit"
                                class="w-full py-3 mt-6 bg-green-400 text-white rounded-lg hover:bg-green-500 shadow-lg">
                                Continuar con la compra.
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Resumen y Adress --}}
            <div class="col-span-1 z-40 m-0 lg:right-10 lg:top-1/4 sticky top-28">
                {{-- Selector de direccion a usar --}}
                <div id="autoFillModal" class=" lg:block hidden items-center justify-center z-50">
                    <div class="bg-transparent h-full">
                        <h2 class="text-lg font-bold">Selecciona una dirección almacenada</h2>
                        <p class="text-gray-600">Selecciona una de tus direcciones guardadas para autocompletar el
                            formulario.</p>
                        <div class="mt-4">
                            <div class="max-w-md mx-auto space-y-6">
                                <div class="space-y-4">
                                    @if ($addresses->isNotEmpty())


                                    @foreach ($addresses as $address)
                                        <div class="relative">
                                            <input wire:model.live="selectedAddressId" type="radio"
                                                name="selectedAddressId" id="option{{ $address->id }}"
                                                value="{{ $address->id }}"
                                                data-address='@json($address)' class="hidden peer">
                                            <label for="option{{ $address->id }}"
                                                class="inline-flex items-center justify-between w-full p-3 bg-transparent border-2 rounded-lg cursor-pointer group border-neutral-200/70 text-neutral-600 peer-checked:border-blue-400 peer-checked:text-neutral-900 peer-checked:bg-blue-200/50 hover:text-neutral-900 hover:border-neutral-300">
                                                <div class="flex items-center space-x-3">
                                                    <!-- Reducir el tamaño del SVG -->
                                                    <svg class="w-8 h-auto" xmlns="http://www.w3.org/2000/svg"
                                                        width="1em" height="1em" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M12 21.02q-3.525-3.118-5.31-5.815q-1.786-2.697-1.786-4.909q0-3.173 2.066-5.234Q9.037 3 12 3q.617 0 1.213.093t1.143.293L9.5 8.268V12.5h4.233l4.894-4.894q.225.63.347 1.292t.122 1.398q0 2.212-1.785 4.909q-1.786 2.697-5.311 5.814m-.115-10.903v-.87l5.277-5.277l.869.87l-5.277 5.276zm6.846-5.978l-.87-.869l.547-.546q.16-.16.363-.189q.204-.028.344.112l.239.238q.14.141.111.345t-.188.363z" />
                                                    </svg>
                                                    <div class="flex flex-col justify-start">
                                                        <!-- Reducir el tamaño de texto -->
                                                        <div class="w-full text-base font-semibold">
                                                            {{ $address->name }} {{ $address->last_name }}
                                                        </div>
                                                        <div class="w-full text-sm opacity-60">
                                                            {{ $address->address }}, {{ $address->number }}<br>
                                                            {{ $address->province->name }}<br>
                                                            {{ $address->zipCode->code }}<br>
                                                            @php

                                                                // Check if the length is greater than 4
                                                                if (strlen($address->phone_number) > 4) {
                                                                    // Insert a dash after the first 4 numbers
                                                                    $cleaned =
                                                                        substr($address->phone_number, 0, 4) .
                                                                        '-' .
                                                                        substr($address->phone_number, 4);
                                                                }
                                                            @endphp
                                                            Tel:
                                                            {{ $cleaned }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Resumen de la compra sumada al envio --}}
                <div class="w-full z-40 bottom-2">
                    <div class="justify-center">
                        @livewire('resume', ['zip_code' => $zip_code, 'province' => $province, 'city' => $city, 'selectedMethod' => $selectedMethod])
                    </div>
                </div>
            </div>


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
        function formatPhone(input) {
            // // Remove non-digit characters from the input value
            // const cleaned = input.value.replace(/\D+/g, '');

            // // Format the phone number as 1234-123456
            // if (cleaned.length >= 4) {
            //     input.value = cleaned.slice(0, 4) + '-' + cleaned.slice(4);
            // } else {
            //     input.value = cleaned; // Allow typing up to 4 digits
            // }

            // // Update the hidden Livewire model input with the unformatted phone number
            // document.getElementById('unformattedPhone').value = cleaned;

            // // Trigger a Livewire event to update the hidden input value in the backend
            // Livewire.emit('input', 'phoneNumber', cleaned);
            // Remove all non-numeric characters
            phoneNumber = input.value.replace(/\D/g, '');

            // If the input has more than 4 characters, format it with a dash after the first 4 digits
            if (phoneNumber.length > 4) {
                input.value = phoneNumber.substring(0, 4) + '-' + phoneNumber.substring(4, phoneNumber.length);
            }

            // Set the formatted value back to the input field
            document.getElementById('unformattedPhone').value = phoneNumber;
        }
        // Función para ocultar el modal
        // document.querySelectorAll('input[name="options"]').forEach((radio) => {
        //     radio.addEventListener('change', function() {
        //         // Obtener los datos de la dirección desde el radio seleccionado
        //         const addressData = JSON.parse(this.getAttribute('data-address'));

        //         console.log(addressData);


        //         // Asignar los valores de la dirección a los campos del formulario
        //         document.querySelector('input[name="name"]').value = addressData.name;
        //         document.querySelector('input[name="last_name"]').value = addressData.last_name;
        //         document.querySelector('input[name="phone_number"]').value = addressData.phone_number;
        //         document.querySelector('input[name="zip_code"]').value = addressData.zip_code.code;
        //         document.querySelector('input[name="province"]').value = addressData.province.name;
        //         document.querySelector('select[name="city"]').value = addressData.city.id;
        //         document.querySelector('input[name="address"]').value = addressData.address;
        //         document.querySelector('input[name="street"]').value = addressData.street;
        //         document.querySelector('input[name="number"]').value = addressData.number;
        //         document.querySelector('input[name="department"]').value = addressData.department || '';
        //         document.querySelector('input[name="street1"]').value = addressData.street1 || '';
        //         document.querySelector('input[name="street2"]').value = addressData.street2 || '';
        //         document.querySelector('textarea[name="observation"]').value = addressData.observation ||
        //         '';
        //     });
        // });
    </script>
</div>
