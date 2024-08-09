<div>
    <form method="POST" action="{{route('checkout.delivery.address')}}" class="flex flex-col">
        @method('POST')
        @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <x-checkout.text-input name="name" label="Nombre" wire:model.blur="name"></x-checkout.text-input>
        
        <x-checkout.text-input name="last_name" label="Apellido" wire:model.blur="last_name"></x-checkout.text-input>
        
        <x-checkout.text-input inputmode="numeric" name="zip_code" label="Codigo Postal" wire:model.blur="zip_code"></x-checkout.text-input>
        
        <div>
            <label for="province">Provincia</label>
            <select disabled name="province" wire:model.live="selectedProvince">
                <option value="" selected>Seleccioná una provincia...</option>
                @foreach (\App\Models\Province::all() as $province)
                <option value="{{$province->id}}">
                    {{$province->name}}
                </option>
                @endforeach
            </select>
            @error('province')
            <div>
                <span class="error">{{ $message }}</span>
            </div>
            @enderror
        </div>
        <div>
            <label for="city">Localidad</label>
            <select name="city" wire:model.live="city">
                <option value="" selected>@if ($selectedProvince == 1)
                    Seleccioná un barrio...
                @else
                Seleccioná una localidad...
                @endif
            </option>
                    @foreach ($cities as $city)
                    <option value="{{$city->id}}">
                        {{$city->name}}
                    </option>
                    @endforeach
            </select>
            @error('city')
            <div>
                <span class="error">{{ $message }}</span>
            </div>
            @enderror
        </div>
        
        {{-- <x-checkout.select-input name="city" label="Localidad" wire:model="city"></x-checkout.select-input> --}}
        
        <x-checkout.text-input name="address" label="Dirección" wire:model="address"></x-checkout.text-input>
        
        <x-checkout.text-input name="street" label="Calle" wire:model="street"></x-checkout.text-input>
        
        <x-checkout.text-input name="number" label="Altura (Número)" wire:model="number"></x-checkout.text-input>
        
        <x-checkout.text-input name="department" label="Piso/Departamento (Opcional)" wire:model="department"></x-checkout.text-input>
        
        <hr class="mt-2 mb-2">
        <p> Entre calles (Opcional)</p>
        <div class="grid grid-cols-2">
            <x-checkout.text-input name="street1" label="Calle 1" wire:model="street1"></x-checkout.text-input>
            
            <x-checkout.text-input name="street2" label="Calle 2" wire:model="street2"></x-checkout.text-input>
        </div>

        <x-checkout.textbox-input name="observation" label="Indicaciones opcionales" wire:model="observation"></x-checkout.textbox-input>
        <button type="submit" class="p-4 bg-green-400">Continuar con la compra.</button>
    </form>
</div>
