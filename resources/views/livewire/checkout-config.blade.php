<div class="flex flex-col w-full lg:block justify-center place-content-center bg-transparent">
    <div class="place-content-center w-full lg:w-11/12 translate-x-0 translate-y-0 lg:translate-x-2 lg:translate-y-2 rounded-none lg:rounded-3xl bg-slate-900/30"
        id="cart">
        <div class="rounded-none lg:rounded-3xl w-full bg-gradient-to-b from-[#343678] to-[#273053]">
            <div
                class="flex flex-col w-full rounded-lg shadow-lg px-4 py-6 sm:px-6 sm:py-10 lg:px-8 lg:py-20 justify-between">


                <div class="w-full max-w-md flex flex-col mx-auto text-center bg-white rounded-xl h-[470px]" x-data="{ step: 1, selected: 'domicilio', paymentMethod: 'mercado_pago', file: null, changeSelection(selection) { this.selected = selection; Livewire.dispatch('selectionChanged', { selection: this.selected }) } }">

                    <!-- Paso 1: Selección del método de envío -->
                    <div x-show="step === 1" class="w-full h-auto m-auto flex flex-col p-8">
                        <h2 class="text-[#2E3366] text-xl lg:text-3xl font-bold mb-2 lg:mb-6">Vamos a Cotizar el envío 📦</h2>

                        <!-- Botones para seleccionar envío -->
                        <div class="relative w-full mt-4 mb-2 rounded-md border h-22 p-1 bg-gray-200">
                            <div class="relative w-full h-full flex items-center">
                                <!-- Botón Envío a Domicilio -->
                                <div @click="changeSelection('domicilio')" class="flex-grow cursor-pointer text-center">
                                    <button
                                        :class="{ 'text-blue-600 font-semibold': selected === 'domicilio', 'text-gray-500': selected !== 'domicilio' }"
                                        class="w-full rounded-lg text-sm py-2 px-4 font-bold" wire:click="$set('house',1)">
                                        Envío a Domicilio 🏠
                                    </button>
                                </div>

                                <!-- Botón Envío a Sucursal -->
                                <div @click="changeSelection('sucursal')" class="flex-grow cursor-pointer text-center">
                                    <button
                                        :class="{ 'text-blue-600 font-semibold': selected === 'sucursal', 'text-gray-500': selected !== 'sucursal' }"
                                        class="w-full rounded-lg text-sm py-2 px-4 font-bold" wire:click="$set('house',2)">
                                        Envío a Sucursal
                                    </button>
                                </div>

                                <!-- Botón Retiro yo -->
                                <div @click="changeSelection('retiro')" class="flex-grow cursor-pointer text-center">
                                    <button
                                        :class="{ 'text-blue-800 font-semibold': selected === 'retiro', 'text-gray-500': selected !== 'retiro' }"
                                        class="w-full rounded-lg text-sm py-2 px-4 font-bold" wire:click="$set('house',3)">
                                        Retiro en Tienda 🏪
                                    </button>
                                </div>
                            </div>

                            <!-- Indicador de selección -->
                            <span
                                :class="{
                                    'left-1/3 -ml-1': selected === 'sucursal',
                                    'left-2/3 -ml-1': selected === 'retiro',
                                    'left-1': selected === 'domicilio'
                                }"
                                x-text="selected === 'domicilio' ? 'Envío a Domicilio 🏠' : selected === 'sucursal' ? 'Envío a Sucursal' : 'Retiro en Tienda 🏪'"
                                class="bg-white shadow text-sm flex items-center justify-center w-1/3 px-4 rounded h-3/4 transition-all duration-150 ease-linear top-[8px] absolute text-gray-800 font-semibold"></span>
                        </div>

                        <!-- Contenido dinamico -->
                        <div class="h-[200px] p-2">
                            <!-- Envío a Domicilio -->
                            <div x-show="selected === 'domicilio'" class="mt-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-1">
                                    <!-- Código Postal -->
                                    <div class="col-span-1">
                                        <label for="province" class="text-xs font-semibold py-2">C.P.</label>
                                        <x-checkout.text-input inputmode="numeric" name="zip_code" label=""
                                            wire:model.blur="zip_code"
                                            class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />
                                    </div>

                                    <!-- Provincia -->
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

                                    <!-- Localidad -->
                                    <div class="mb-4 col-span-2">
                                        <label for="city"
                                            class="text-xs font-semibold text-gray-600 py-2">Localidad</label>
                                        <select name="city" wire:model.live="city"
                                            class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4">
                                            <option value="" selected>
                                                Tienes que incluir Codigo Postal antes de Localidad
                                            </option>
                                            @foreach ($cities as $city2)
                                                <option value="{{ $city2->id }}">{{ $city2->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('city')
                                            <div class="mt-2 text-red-500 text-xs">
                                                <span class="error">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Precio de Envío -->
                                    {{-- <div class="col-span-2">
                                        <label class="text-xs font-semibold py-2">Precio de Envío</label>
                                        <input type="text" readonly value="{{ $sendPrice }}"
                                            class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4">
                                    </div> --}}
                                </div>
                            </div>

                            <!-- Envío a Sucursal -->
                            <div x-show="selected === 'sucursal'" class="mt-4 mb-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <!-- Código Postal -->
                                    <div class="">
                                        <x-checkout.text-input inputmode="numeric" name="zip_code" label="Código Postal"
                                            wire:model.blur="zip_code"
                                            class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4" />
                                    </div>
                                    <!-- Sucursal -->
                                    <div class="col-span-1">
                                        <label for="sucursal" class="text-xs font-semibold py-2">Sucursal</label>
                                        <select id="sucursal" name="sucursal" wire:model.live="sucursal"
                                            class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg h-10 px-4">
                                            <option value="">Selecciona una sucursal</option>
                                            @isset($sucursales)
                                            @foreach ($sucursales as $sucursal)

                                            <option value="{{$sucursal['IdCentroImposicion']}}">{{$sucursal['Sucursal']}}</option>
                                            @endforeach
                                            @endisset
                                        </select>
                                        @error('sucursal')
                                            <div class="mt-2 text-red-500 text-xs">
                                                <span class="error">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Retiro yo -->
                            <div x-show="selected === 'retiro'" class="mt-4 mb-4">
                                <p class="text-gray-700 text-md">Puedes retirar tu pedido directamente de nuestro local sin
                                    costo adicional.</p>
                            </div>
                        </div>

                        <!-- Botón para continuar al siguiente paso -->
                        <button @click="async () => {
                            const canProceed = await $wire.canGoToNextStep();
                            if (canProceed) {
                                step = 2;
                            }
                        }"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 transition rounded-lg mt-2 sm:mt-0">
                            <p class="font-josefin text-lg text-white font-bold py-1 px-4">
                                Continuar
                            </p>
                        </button>
                    </div>


                    <!-- Paso 2: Selección del método de pago -->
                    <div x-show="step === 2"
                        class="w-full h-auto m-auto flex flex-col p-8">
                        <h2 class="text-[#2E3366] text-3xl font-bold mb-6">¿Cual será el método de pago? 💰</h2>

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


                        <!-- Botón para avanzar sin necesidad de comprobante -->
                        <button @click="step = 3"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 transition rounded-lg mt-2 sm:mt-0">
                            <p class="font-josefin text-lg text-white font-bold py-1 px-4">Continuar</p>
                        </button>
                    </div>

                    <!-- Paso 3: Confirmación -->
                    <div x-show="step === 3 || step === 4"
                        class="col-span-2 gap-4 p-6 justify-center items-center lg:mt-0 mt-6 flex flex-col">
                        <!-- Información seleccionada -->
                        <div class="w-full">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">🎉 ¡Resumen de tu selección!</h2>

                            <!-- Resumen del método de envío -->
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold text-gray-700">Método de Envío:</h3>
                                <p class="text-gray-600"
                                    x-text="selected === 'domicilio' ? 'Envío a Domicilio' : 'Envío a Sucursal': 'Retiro en Tienda"></p>

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
                            </div>
                        </div>

                        <!-- Botón para realizar la compra -->
                        <button wire:click="save"
                            class="w-full bg-blue-600 hover:bg-blue-700 rounded-lg transition-all duration-300 shadow-lg mt-auto bottom-4">
                            <a :href=""
                                class="flex items-center justify-center">
                                <p class="text-white text-lg font-semibold font-josefin">
                                    <span
                                        x-text="paymentMethod === 'transferencia' ? 'Rellenemos Informacion de Envio' : '🛒 Confirmar y pagar con Mercado Pago'"></span>
                                </p>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div>
        @livewire('resume', ['zip_code' => $zip_code, 'province' => $province, 'city' => $city, 'selectedMethod' => $selectedMethod])
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
