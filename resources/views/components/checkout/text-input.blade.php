@props(['name', 'label'])
 <div>
     <label for="{{ $name }}">{{ $label }}</label>
     <input type="text" name="{{ $name }}" {{ $attributes }}>
     @error($name)
     <div>
          <span class="error text-red-500 text-xs">{{ $message }}</span>
     </div>
     @enderror
 </div>
