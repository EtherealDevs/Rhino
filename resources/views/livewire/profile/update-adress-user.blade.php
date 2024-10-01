<div class="flex justify-items-start">
    <div>
        <h2 class="text-xl">
            Direcciones usadas Recientemente
        </h2>
        <p class="text-md">
            Aquí se muestran las direcciones de envío que has utilizado recientemente.
        </p>
    </div>

    <div class='flex items-center justify-center from-blue-100 via-blue-300 to-blue-500 bg-gradient-to-br'>
        <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
            <div class='max-w-md mx-auto space-y-6'>
                <div class="space-y-4">
                    <p class="text-sm font-medium text-center text-neutral-500">Selecciona una dirección</p>

                    @foreach ($addresses as $address)
                        <div class="relative">
                            <input type="radio" name="options" id="option{{ $address->id }}"
                                value="{{ $address->id }}" wire:model="selectedAddressId" class="hidden peer">
                            <label for="option{{ $address->id }}"
                                class="inline-flex items-center justify-between w-full p-5 bg-white border-2 rounded-lg cursor-pointer group border-neutral-200/70 text-neutral-600 peer-checked:border-blue-400 peer-checked:text-neutral-900 peer-checked:bg-blue-200/50 hover:text-neutral-900 hover:border-neutral-300">
                                <div class="flex items-center space-x-5">
                                    <svg class="w-16 h-auto" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M12 21.02q-3.525-3.118-5.31-5.815q-1.786-2.697-1.786-4.909q0-3.173 2.066-5.234Q9.037 3 12 3q.617 0 1.213.093t1.143.293L9.5 8.268V12.5h4.233l4.894-4.894q.225.63.347 1.292t.122 1.398q0 2.212-1.785 4.909q-1.786 2.697-5.311 5.814m-.115-10.903v-.87l5.277-5.277l.869.87l-5.277 5.276zm6.846-5.978l-.87-.869l.547-.546q.16-.16.363-.189q.204-.028.344.112l.239.238q.14.141.111.345t-.188.363z" />
                                    </svg>
                                    <div class="flex flex-col justify-start">
                                        <div class="w-full text-lg font-semibold">{{ $address->name }}
                                            {{ $address->last_name }}</div>
                                        <div class="w-full text-sm opacity-60">
                                            {{ $address->address }}, {{ $address->number }}<br>
                                            {{ $address->city->name }}, {{ $address->province->name }}<br>
                                            {{ $address->zipCode->code }}<br>
                                            Tel: {{ $address->phone_number }}
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

</div>
