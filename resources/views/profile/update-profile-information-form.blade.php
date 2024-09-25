<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Información del Perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualiza la información de perfil y la dirección de correo electrónico de tu cuenta.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Seleccionar una Nueva Foto') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Eliminar Foto') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Nombre') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required
                autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                    !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Tu dirección de correo electrónico no está verificada.') }}

                    <button type="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                    </p>
                @endif
            @endif
        </div>

        <!-- Phone Number -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone_number" value="{{ __('Número de Teléfono') }}" />
            <div class="relative mt-2">
                <div class="absolute top-2 left-0 flex items-center pl-3">
                    <button id="dropdownButton"
                        class="h-full text-sm flex justify-center items-center bg-transparent text-gray-700 focus:outline-none">
                        <span id="dropdownSpan">+54</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-4 w-4 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div class="h-6 border-l border-gray-200 ml-2"></div>
                    <div id="dropdownMenu"
                        class="min-w-[150px] overflow-hidden absolute left-0 w-full mt-10 hidden bg-white border border-gray-200 rounded-md shadow-lg z-10">
                        <ul id="dropdownOptions">
                            <li class="px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm cursor-pointer"
                                data-value="+54">
                                Argentina (+54)
                            </li>
                            <li class="px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm cursor-pointer"
                                data-value="+33">
                                Francia (+33)
                            </li>
                            <li class="px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm cursor-pointer"
                                data-value="+49">
                                Alemania (+49)
                            </li>
                            <li class="px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm cursor-pointer"
                                data-value="+34">
                                España (+34)
                            </li>
                            <li class="px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm cursor-pointer"
                                data-value="+1">
                                EE.UU. (+1)
                            </li>
                        </ul>
                    </div>
                </div>
                <x-input id="phone_number" type="text"
                    class="w-full h-10 pl-20 bg-transparent placeholder:text-gray-400 text-gray-700 text-sm border border-gray-300 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-gray-400 hover:border-gray-400 shadow-sm focus:shadow-md"
                    placeholder="324-456-2323" wire:model.blur="state.phone_number" />
            </div>
            <x-input-error for="phone_number" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Guardado.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-form-section>
