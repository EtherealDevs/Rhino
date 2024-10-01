<div class="flex flex-col w-full lg:block justify-center place-content-center bg-transparent">

    <div class="place-content-center w-full lg:w-11/12 translate-x-0 translate-y-0 lg:translate-x-2 lg:translate-y-2 rounded-none lg:rounded-3xl bg-slate-900/30"
        id="cart">
        <div class="rounded-none lg:rounded-3xl w-full bg-gradient-to-b from-[#343678] to-[#273053]">
            <div
                class="flex flex-col w-full rounded-lg shadow-lg px-4 py-6 sm:px-6 sm:py-10 lg:px-8 lg:py-20 justify-between">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine-ie11.js"
                    integrity="sha512-6m6AtgVSg7JzStQBuIpqoVuGPVSAK5Sp/ti6ySu6AjRDa1pX8mIl1TwP9QmKXU+4Mhq/73SzOk6mbNvyj9MPzQ=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

                <div class="w-full max-w-md flex flex-col mx-auto text-center" x-data="{ step: 1, selected: 'domicilio', paymentMethod: 'mercado_pago', file: null }">

                    <!-- Paso 1: Selección del método de envío -->
                    <div x-show="step === 1" class="w-full h-auto m-auto shadow-lg flex flex-col p-8 rounded-xl bg-white">
                        <h2 class="text-[#2E3366] text-3xl font-bold mb-6">Vamos a Cotizar el envio 📦</h2>
                        <!-- Botones para seleccionar envío -->
                        <div class="relative w-full mt-4 mb-2 rounded-md border h-10 p-1 bg-gray-200">
                            <div class="relative w-full h-full flex items-center">
                                <div @click="selected = 'domicilio'" class="flex-grow cursor-pointer text-center">
                                    <button
                                        :class="{ 'text-blue-600 font-semibold': selected === 'domicilio', 'text-gray-500': selected !== 'domicilio' }"
                                        class="w-full rounded-lg text-sm py-2 px-4 font-bold">
                                        Envío a Domicilio
                                    </button>
                                </div>
                                <div @click="selected = 'sucursal'" class="flex-grow cursor-pointer text-center">
                                    <button
                                        :class="{ 'text-blue-600 font-semibold': selected === 'sucursal', 'text-gray-500': selected !== 'sucursal' }"
                                        class="w-full rounded-lg text-sm py-2 px-4 font-bold">
                                        Envío a Sucursal
                                    </button>
                                </div>
                            </div>
                            <!-- Indicador de selección -->
                            <span
                                :class="{ 'left-1/2 -ml-1': selected === 'sucursal', 'left-1': selected === 'domicilio' }"
                                x-text="selected === 'domicilio' ? 'Envío a Domicilio' : 'Envío a Sucursal'"
                                class="bg-white shadow text-sm flex items-center justify-center w-1/2 rounded h-[1.88rem] transition-all duration-150 ease-linear top-[4px] absolute text-blue-700 font-semibold"></span>
                        </div>

                        <!-- Formulario de envío según selección -->
                        <div x-show="selected === 'domicilio'" class="mt-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="mb-4 col-span-1 sm:col-span-2 grid grid-cols-2 grid-rows-2">
                                    <div class="col-span-2">
                                        <x-checkout.text-input inputmode="numeric" name="zip_code" label="Código Postal"
                                            wire:model.blur="zip_code"
                                            class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />
                                    </div>

                                    <div class="col-span-1">
                                        <label for="province" class="text-xs font-semibold py-2">Provincia</label>
                                        <input name="province" type="text" readonly wire:model.live="province"
                                            class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4">
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

                                    <!-- Mostrar el precio de envío -->
                                    <div class="col-span-2">
                                        <label class="text-xs font-semibold py-2">Precio de Envío</label>
                                        <input type="text" readonly value="{{ $sendPrice }}"
                                            class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div x-show="selected === 'sucursal'" class="mt-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <x-checkout.text-input inputmode="numeric" name="zip_code" label="Código Postal"
                                        wire:model.blur="zip_code"
                                        class="w-full rounded-full px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100" />
                                </div>
                                <div>
                                    <label for="sucursal"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sucursal</label>
                                    <select id="sucursal" name="sucursal" wire:model.live="sucursal"
                                        class="w-full rounded-full px-2 py-2 bg-black/30 placeholder-gray-300 text-gray-100">
                                        <option>Sucursal D</option>
                                        <option>Sucursal E</option>
                                        <option>Sucursal F</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button @click="step = 2"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 transition rounded-lg mt-2 sm:mt-0">
                            <p class="font-josefin text-lg text-white font-bold py-1 px-4">
                                Continuar
                            </p>
                        </button>
                    </div>


                    <!-- Paso 2: Selección del método de pago -->
                    <div x-show="step === 2"
                        class="w-full h-auto m-auto shadow-lg flex flex-col p-8 rounded-xl bg-white">
                        <h2 class="text-[#2E3366] text-3xl font-bold mb-6">¿Cual será el método de pago?</h2>

                        <div class="radio-section">
                            <div class="radio-list">
                                <h1>Seleccionemoslo aquí 👇🏼</h1>

                                <!-- Radio Button Mercado Pago -->
                                <div class="radio-item">
                                    <input type="radio" id="mercado_pago" name="paymentMethod" x-model="paymentMethod"
                                        value="mercado_pago" />
                                    <label class="text-white" for="mercado_pago">Mercado Pago</label>
                                </div>

                                <!-- Radio Button Transferencia -->
                                <div class="radio-item">
                                    <input type="radio" id="transferencia" name="paymentMethod"
                                        x-model="paymentMethod" value="transferencia" />
                                    <label class="text-white" for="transferencia">Transferencia</label>
                                </div>
                            </div>
                        </div>

                        <!-- Información para Transferencia -->
                        <div x-show="paymentMethod === 'transferencia'" class="mt-4 bg-gray-200 p-4 rounded">
                            <h3 class="text-gray-700 font-bold">Información para Transferencia</h3>
                            {{-- <p><strong>Alias:</strong> {{ $alias }}</p>
                            <p><strong>CBU:</strong> {{ $cbu }}</p>
                            <p><strong>Nombre:</strong> {{ $holder_name }}</p> --}}

                            <div x-data="fileUpload()" x-init="init()">
                                <!-- Input de archivo oculto -->
                                <input type="file" x-ref="fileInput" @change="handleFileUpload" class="hidden" />

                                <!-- Botón para agregar comprobante de pago -->
                                <button @click="$refs.fileInput.click()"
                                    class="mt-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded transition duration-200">
                                    Agregar Comprobante de Pago
                                </button>

                                <!-- Mostrar el nombre del archivo seleccionado -->
                                <div x-show="file" class="mt-2 text-gray-700">
                                    Comprobante seleccionado: <span x-text="file.name"></span>
                                </div>

                                <!-- Botón para subir el comprobante -->
                                <button x-show="file" @click="submitForm()"
                                    class="mt-4 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded transition duration-200">
                                    Subir Comprobante
                                </button>
                            </div>
                        </div>

                        <!-- Botón para avanzar sin necesidad de comprobante -->
                        <button @click="step = 3"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 transition rounded-lg mt-2 sm:mt-0">
                            <p class="font-josefin text-lg text-white font-bold py-1 px-4">Continuar</p>
                        </button>
                    </div>

                    <!-- Paso 3: Confirmación -->
                    <div x-show="step === 3 || step === 4"
                        class="col-span-2 gap-4 bg-white p-6 rounded-2xl lg:mt-0 mt-6 flex flex-col items-start">
                        <!-- Información seleccionada -->
                        <div class="w-full">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">🎉 ¡Resumen de tu selección!</h2>

                            <!-- Resumen del método de envío -->
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold text-gray-700">Método de Envío:</h3>
                                <p class="text-gray-600"
                                    x-text="selected === 'domicilio' ? 'Envío a Domicilio' : 'Envío a Sucursal'"></p>

                                <!-- Mostrar detalles del envío a domicilio -->
                                <div x-show="selected === 'domicilio'" class="mt-2">
                                    <p class="text-gray-600"><strong>Provincia:</strong> <span
                                            x-text="province"></span></p>
                                    <p class="text-gray-600"><strong>Localidad:</strong> <span x-text="city"></span>
                                    </p>
                                    <p class="text-gray-600"><strong>Código Postal:</strong> <span
                                            x-text="zip_code"></span></p>
                                </div>

                                <!-- Mostrar detalles del envío a sucursal -->
                                <div x-show="selected === 'sucursal'" class="mt-2">
                                    <p class="text-gray-600"><strong>Sucursal Seleccionada:</strong> <span
                                            x-text="sucursal"></span></p>
                                    <p class="text-gray-600"><strong>Código Postal:</strong> <span
                                            x-text="zip_code"></span></p>
                                </div>
                            </div>

                            <!-- Resumen del método de pago -->
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold text-gray-700">Método de Pago:</h3>
                                <p class="text-gray-600"
                                    x-text="paymentMethod === 'mercado_pago' ? 'Mercado Pago' : 'Transferencia'"></p>

                                {{-- <!-- Mostrar detalles de la transferencia -->
                                <div x-show="paymentMethod === 'transferencia'" class="mt-2">
                                    <p class="text-gray-600"><strong>Alias:</strong> {{ $alias }}</p>
                                    <p class="text-gray-600"><strong>CBU:</strong> {{ $cbu }}</p>
                                    <p class="text-gray-600"><strong>Nombre:</strong> {{ $holder_name }}</p>

                                    <!-- Comprobante de pago -->
                                    <div x-show="file" class="mt-2">
                                        <p class="text-gray-600">Comprobante de pago: <span x-text="file.name"></span>
                                        </p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <!-- Botón para realizar la compra -->
                        <button
                            class="w-full bg-blue-600 hover:bg-blue-700 rounded-lg transition-all duration-300 shadow-lg mt-auto">
                            <a :href="paymentMethod === 'transferencia' ? '/products' : '{{ route('checkout.delivery') }}'"
                                class="flex items-center justify-center">
                                <p class="text-white text-lg font-semibold font-josefin">
                                    <span
                                        x-text="paymentMethod === 'transferencia' ? '💳 Confirmar y pagar con transferencia' : '🛒 Confirmar y pagar con Mercado Pago'"></span>
                                </p>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div>
        @livewire('resume', ['sendPrice' => $sendPrice])
    </div>


    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('checkoutForm', () => ({
                step: 1,
                selected: 'domicilio',
                paymentMethod: 'mercado_pago',
                zip_code: '',
                province: '',
                city: '',
                sucursal: '',
                file: null,

                init() {
                    // Restaurar datos del localStorage si existen
                    const storedData = JSON.parse(localStorage.getItem('checkoutForm'));
                    if (storedData) {
                        this.step = storedData.step || this
                            .step; // Mantener el valor predeterminado si es null
                        this.selected = storedData.selected || this.selected;
                        this.paymentMethod = storedData.paymentMethod || this.paymentMethod;
                        this.zip_code = storedData.zip_code || this.zip_code;
                        this.province = storedData.province || this.province;
                        this.city = storedData.city || this.city;
                        this.sucursal = storedData.sucursal || this.sucursal;
                    }
                },

                saveToLocalStorage() {
                    const data = {
                        step: this.step,
                        selected: this.selected,
                        paymentMethod: this.paymentMethod,
                        zip_code: this.zip_code,
                        province: this.province,
                        city: this.city,
                        sucursal: this.sucursal,
                    };
                    localStorage.setItem('checkoutForm', JSON.stringify(data));
                },

                handleStepChange() {
                    this.saveToLocalStorage(); // Guarda los datos en localStorage cuando cambie de paso
                }
            }));
        });

        function shippingForm() {
            return {
                selected: 'domicilio',
                provinciaOrigen: 'AR-W',
                provinciaDestino: 'AR-B',
                ciudad: '',
                direccion: '',
                codigoPostal: '3400',
                codigoPostalDestino: document.querySelector('input[name="zip_code"]')
                    .value, // Asegúrate de que este input existe
                sucursal: '',
                costoEnvio: null,

                async submitForm() {
                    const params = new URLSearchParams();
                    params.append('cpOrigen', this.codigoPostal);
                    params.append('cpDestino', this.codigoPostalDestino || this.codigoPostal);
                    params.append('provinciaOrigen', this.provinciaOrigen);
                    params.append('provinciaDestino', this.provinciaDestino); // Corrige esta línea
                    params.append('peso', 5); // Puedes ajustar el peso según tus necesidades

                    try {
                        const response = await fetch('https://correo-argentino1.p.rapidapi.com/calcularPrecio', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                                'x-rapidapi-host': 'correo-argentino1.p.rapidapi.com', // Corrige esta línea
                                'x-rapidapi-key': 'a9bb5c690fmsh972c811eb4e482dp11ea44jsna844bc397594'
                            },
                            body: params.toString()
                        });

                        const data = await response.json();
                        console.log('Costo de envío:', data.precio);
                        this.costoEnvio = data.precio;
                    } catch (error) {
                        console.error('Error al calcular el costo de envío:', error);
                    }
                }
            }
        }
    </script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Averia+Serif+Libre:wght@300;400;700&display=swap");


        .radio-section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: auto;
            /* Cambiado para que se ajuste al contenido */
            margin-bottom: 20px;
            /* Espaciado entre el título y los botones de radio */
        }

        h1 {
            margin-bottom: 20px;
        }

        .radio-item [type="radio"] {
            display: none;
        }

        .radio-item+.radio-item {
            margin-top: 15px;
        }

        .radio-item label {
            display: block;
            padding: 20px 60px;
            background: #1d1d42;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 400;
            min-width: 250px;
            white-space: nowrap;
            position: relative;
            transition: 0.4s ease-in-out 0s;
        }

        .radio-item label:after,
        .radio-item label:before {
            content: "";
            position: absolute;
            border-radius: 50%;
        }

        .radio-item label:after {
            height: 19px;
            width: 19px;
            border: 2px solid #524eee;
            left: 19px;
            top: calc(50% - 12px);
        }

        .radio-item label:before {
            background: #524eee;
            height: 20px;
            width: 20px;
            left: 21px;
            top: calc(50% - 5px);
            transform: scale(5);
            opacity: 0;
            visibility: hidden;
            transition: 0.4s ease-in-out 0s;
        }

        .radio-item [type="radio"]:checked~label {
            border-color: #524eee;
        }

        .radio-item [type="radio"]:checked~label::before {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }
    </style>

</div>
