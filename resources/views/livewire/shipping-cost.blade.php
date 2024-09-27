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
                        <h2 class="text-[#2E3366] text-3xl font-bold mb-6">¿Cual sera el metodo de pago?</h2>

                        <div class="grid grid-cols-1 gap-4">
                            <label for="payment_method" class="block mb-2 text-lg font-medium">Seleccionemoslo aqui 👇🏼</label>
                            <select id="payment_method" x-model="paymentMethod"
                                class="w-full rounded-lg bg-gray-100 text-gray-700 border border-gray-300 h-10 px-4">
                                <option value="mercado_pago">Mercado Pago</option>
                                <option value="transferencia">Transferencia</option>
                            </select>
                        </div>

                        <!-- Información para Transferencia -->
                        <div x-show="paymentMethod === 'transferencia'" class="mt-4 bg-gray-200 p-4 rounded">
                            <h3 class="text-gray-700 font-bold">Información para Transferencia</h3>
                            <p><strong>Alias:</strong> {{ $alias }}</p>
                            <p><strong>CBU:</strong> {{ $cbu }}</p>
                            <p><strong>Nombre:</strong> {{ $holder_name }}</p>


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
                            
                            <script>
                                function fileUpload() {
                                    return {
                                        file: null,
                            
                                        init() {
                                            console.log('Alpine.js inicializado');
                                        },
                            
                                        handleFileUpload(event) {
                                            this.file = event.target.files[0];
                                        },
                            
                                        submitForm() {
                                            if (!this.file) {
                                                alert("Por favor selecciona un archivo");
                                                return;
                                            }
                            
                                            // Crear un objeto FormData para enviar el archivo
                                            const formData = new FormData();
                                            formData.append('comprobante', this.file);
                            
                                            // Aquí puedes usar fetch o axios para enviar el archivo al servidor
                                            fetch('/ruta-al-servidor', {
                                                method: 'POST',
                                                body: formData,
                                                headers: {
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                }
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                alert('Comprobante subido exitosamente');
                                            })
                                            .catch(error => {
                                                alert('Hubo un error al subir el comprobante');
                                                console.error(error);
                                            });
                                        }
                                    }
                                }
                            </script>
                            
                        </div>


                        <button
                            @click="paymentMethod === 'transferencia' && !file ? alert('Por favor selecciona un comprobante') : step = 3"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 transition rounded-lg mt-2 sm:mt-0">
                            <p class="font-josefin text-lg text-white font-bold py-1 px-4">
                                Continuar
                            </p>
                        </button>
                    </div>

                    <!-- Paso 3: Confirmación -->
                    <div x-show="step === 3 || step === 4" class="col-span-2 gap-4 bg-white p-6 rounded-2xl lg:mt-0 mt-6 flex flex-col items-start">
                        <!-- Información para el envío -->
                        <div class="w-full">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">🎉 ¡Muy bien! Rellena tus datos para el envío 📦</h2>
                            <p class="text-gray-600 mb-6">Asegúrate de que la información ingresada sea correcta para procesar tu pedido rápidamente. ✍️</p>
                        </div>
                    
                        <!-- Botón para realizar la compra -->
                        <button class="w-full bg-blue-600 hover:bg-blue-700 rounded-lg transition-all duration-300 shadow-lg mt-auto">
                            <a :href="paymentMethod === 'transferencia' ? '/products' : '{{ route('checkout.delivery') }}'"
                               class="flex items-center justify-center">
                                <p class="text-white text-lg font-semibold font-josefin">
                                    <span x-text="paymentMethod === 'transferencia' ? '💳 Comprar con Transferencia' : '🛒 Comprar'"></span>
                                </p>
                            </a>
                        </button>
                    </div>
                    
                    
                </div>
            </div>
        </div>

    </div>

    <div
        class="mt-0 lg:mt-12 translate-x-0 translate-y-0 lg:translate-x-2 lg:translate-y-2 rounded-none lg:rounded-3xl bg-slate-900/30 w-full lg:w-11/12">
        <div
            class="rounded-none lg:rounded-3xl lg:-translate-x-2 lg:-translate-y-2 bg-gradient-to-b via-[#2E3366] from-[#273053] to-[#343678]">
            <div class="grid lg:grid-cols-6 grid-cols-1 p-6">
                <div class="col-span-2">
                    <ul class="items-center">
                        <li class="font-josefin font-bold text-lg text-[#A3B7FF]">Productos: <span
                                class="text-white text-lg">
                                @isset($cartItems)
                                    {{ $itemCount }}
                                @endisset
                            </span></li>
                        <li class="font-josefin font-bold text-lg text-[#A3B7FF]">Costo de
                            Envío: <span class="text-white text-lg">
                                @if ($sendPrice)
                                    ${{ number_format($sendPrice, 2, ',', '.') }}
                                @endif
                            </span></li>

                    </ul>
                </div>
                <div class="col-span-2 grid grid-rows-2 ml-2">

                    <p class="font-josefin font-bold text-2xl sm:text-3xl text-white">Total</p>
                    @isset($cartItems)
                        <p class="font-josefin font-bold text-2xl sm:text-3xl text-[#6BE64C]">
                            ${{ number_format($total, 2, ',', '.') }}</p>
                    @else
                        <p class="font-josefin font-bold text-2xl sm:text-3xl text-[#6BE64C]">NO DATA</p>
                    @endisset
                </div>

                <div class="col-span-2">
                    <form method="POST" action="{{ route('cart.dropCart') }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="w-full sm:w-auto bg-[#f84e4e] rounded-lg mt-2 sm:mt-0">
                            <p class="font-josefin text-lg text-white font-bold py-1 px-4">Eliminar Lista</p>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function shippingForm() {
            return {
                selected: 'domicilio',
                provinciaOrigen: 'AR-W',
                provinciaDestino: 'AR-B',
                ciudad: '',
                direccion: '',
                codigoPostal: '3400',
                codigoPostalDestino: document.querySelector('input[name='
                    zip_code ']').value,
                sucursal: '',
                costoEnvio: null,

                async submitForm() {
                    const params = new URLSearchParams();
                    params.append('cpOrigen', this.codigoPostal);
                    params.append('cpDestino', this.codigoPostalDestino || this.codigoPostal);
                    params.append('provinciaOrigen', this.provinciaOrigen);
                    params.append('provinciaDestino', this.provinciaOrigen);
                    params.append('peso', 5); // Puedes ajustar el peso según tus necesidades

                    try {
                        const response = await fetch('https://correo-argentino1.p.rapidapi.com/calcularPrecio', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                                'x-rapidapi-host: correo-argentino1.p.rapidapi.com',
                                'x-rapidapi-key: a9bb5c690fmsh972c811eb4e482dp11ea44jsna844bc397594'
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

</div>
